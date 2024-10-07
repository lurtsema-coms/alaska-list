<?php

use App\Models\Advertisement;
use App\Models\AdvertisingPlan;
use App\Models\Product;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Intervention\Image\Facades\Image as Image;
use App\Traits\ListingOption;
use Livewire\Volt\Component;

new class extends Component {
    
    use WithFileUploads;
    use ListingOption;

    public $advertising_plan_id = '';
    public $from_date = '';
    public $to_date = '';
    public $file_name = '';
    public $photo = '';
    public $inc = 1;
    public $addAdvertisement = false;
    public $promo_item_code = '';

    public function with(): array
    {
        return [
            'plans' => $this->loadAdvertisingPlans(),
        ];
    }

    public function loadAdvertisingPlans(){
        return AdvertisingPlan::get();
    }

    public function addAds()
    {
        $product_plan = AdvertisingPlan::find($this->advertising_plan_id);
        $productPriceId = $product_plan->price_id;
        $photo = $this->photo;
        $user = auth()->user();

        $photo_img = Image::make($photo->getRealPath());
        $photo_height = $photo_img->getHeight();
        $photo_width = $photo_img->getWidth();

        if (empty($photo)) {
            $this->dispatch('error');
            return;
        }

        if ($photo_width != 320 || $photo_height != 600) {
            $this->addError('image_constraint', 'The image width must be 320 pixels, and the height must be 600 pixels.');
            return;
        }

        if ($this->promo_item_code) {
            $product = Product::where('created_by', auth()->user()->id)->where('uuid', $this->promo_item_code)->first();
            if (is_null($product)) {
                $this->addError('product_constraint', 'Item Code not found.');
                return;
            }
            $product_id = $product->id;
        } else {
            $product_id = null;
        }

        // Move the file to temporary storage and store the path in the session
        $photo_temp_path = $photo->store('temp_photos');

        session()->put('checkout_data', [
            'advertising_plan_id' => $this->advertising_plan_id,
            'product_id' => $product_id,
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
            'photo_path' => $photo_temp_path, // Store path, not the file
        ]);

        return $user->checkout([$productPriceId], [
            'success_url' => route('checkout-success-ad'),
            'cancel_url' => route('checkout-cancel-ad'),
        ]);

        $this->resetData(['advertising_plan_id', 'from_date', 'to_date', 'photo', 'promo_item_code']);
        $this->addAdvertisement = false;
        $this->inc++;
    }


    public function resetData($data)
    {
        $this->reset($data);
    }
}; ?>

<div 
    x-data="{ addAdvertisement: $wire.entangle('addAdvertisement') }" x-init="$watch('addAdvertisement', value => {
        if (value) {
            document.body.classList.add('overflow-hidden');
        } else {
            document.body.classList.remove('overflow-hidden');
        }
    })">
    <button class="px-4 py-2 text-sm text-white bg-blue-400 rounded-lg shadow-md hover:bg-blue-500"
    @click="addAdvertisement=true">
        Add Featured Listing
    </button>
    
    <div class="fixed top-0 left-0 z-10 w-full h-full overflow-auto bg-black position bg-opacity-30"
        x-show="addAdvertisement"
        x-transition
        x-cloak>
        <div class="flex h-full p-5">
            <div class="w-full max-w-xl m-auto overflow-hidden bg-white shadow-lg rounded-2xl"
            @click.outside="addAdvertisement=false; $wire.call('resetData', ['advertising_plan_id', 'from_date', 'to_date', 'photo', 'promo_item_code']); $('#advertising-plan, #from-date, #to-date').val('');">
                <div class="p-10 max-h-[35rem] overflow-auto">
                    <form wire:submit="addAds">
                        <p class="mb-6 text-lg font-bold tracking-wide pointer-events-none text-slate-700">Add</p>
                        <div class="space-y-4">
                            <div class="flex flex-col gap-4 sm:flex-row">
                                <div class="flex-1 space-y-2" wire:ignore>
                                    <p class="font-medium text-slate-700">Advertising Plan <span class="text-red-400">*</span></p>
                                    <select class="w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" id="advertising-plan" required>
                                        <option value="" disabled selected>Choose Plan</option>
                                        @foreach ($plans as $plan)
                                            <option value="{{ $plan->duration_days }}" data-advertising-id="{{ $plan->id }}">{{ $plan->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="flex flex-col gap-4 sm:flex-row">
                                <div class="flex-1 space-y-2">
                                    <p class="font-medium text-slate-700">From Date <span class="text-red-400">*</span></p>
                                    <input 
                                        class="text-base w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" 
                                        id="from-date"
                                        type="datetime-local"  
                                        {{-- min="<?=date('Y-m-d\Th:i')?>" --}}
                                        required
                                    >
                                </div>
                                <div class="flex-1 space-y-2">
                                    <p class="font-medium text-slate-700">To Date</p>
                                    <input 
                                        class="text-base w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" 
                                        id="to-date"
                                        type="text"
                                        readonly 
                                        required
                                    >
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="font-medium text-slate-700">Upload Photo <span class="text-red-400">*</span></label>
                                <input class="text-md w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="file" required wire:model="photo" id="upload-{{ $inc }}">
                            </div>
                            @error('image_constraint')                                 
                                <div>
                                    <p class="mb-2 text-sm text-red-600">
                                        Note: {{ $message }}
                                    </p>
                                </div>
                            @enderror
                            <div>
                                <p class="mb-2 text-sm text-gray-600">
                                    For best quality in advertising, the image should have a height of 600 and a width of 320px
                                </p>
                            </div>
                            <div x-data="{ promoPackage: false }">
                                <input 
                                    type="checkbox" 
                                    class="relative top-[-1px] mr-2" 
                                    id="promo-package" 
                                    @change="promoPackage = !promoPackage"
                                >
                                <label class="text-sm font-medium text-orange-600 select-none" for="promo-package">
                                    Boost my listing for an additional $1.00 (includes featured and boosted listing)
                                </label>

                                <div x-show="promoPackage" class="mt-4 space-y-2">
                                    <label class="font-medium text-slate-700">Listing Item Code <span class="text-red-400">*</span></label>
                                    <input 
                                        class="text-base w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]"
                                        type="text"
                                        wire:model="promo_item_code" 
                                        placeholder="Item-Code-XXXXXXX"
                                        :required="promoPackage"
                                    >
                                </div>
                                @error('product_constraint')                                 
                                    <div class="mt-4">
                                        <p class="mb-2 text-sm text-red-600">
                                            Note: {{ $message }}
                                        </p>
                                    </div>
                                @enderror
                            </div>
                            {{-- Loading Animation --}}
                            <div class="w-full text-center" wire:loading>
                                <div class="flex items-center justify-center gap-2">
                                    <svg class="animate-spin h-5 w-5 text-[#1F4B55]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 2.042.777 3.908 2.05 5.334l1.95-2.043z"></path>
                                    </svg>
                                    <span class="font-medium text-md text-slate-600">Saving post...</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-8">
                            <button class="px-4 py-2 rounded-lg shadow text-slate-600 hover:opacity-70" type="button"
                                @click="addAdvertisement=false; $wire.call('resetData', ['advertising_plan_id', 'from_date', 'to_date', 'photo', 'promo_item_code']); $('#advertising-plan, #from-date, #to-date').val('');"
                                wire:loading.attr="disabled"
                            >
                                Cancel
                            </button>
                            <button class="text-white bg-[#1F4B55] shadow py-2 px-4 rounded-lg hover:opacity-70" type="submit">Checkout</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@script
<script data-navigate-once>
    $(document).ready(function() {

        let component = @this;

        let min = new Date().toISOString().slice(0, 16);
        $('#from-date').attr('min', min);


        $('#advertising-plan, #from-date').on('change', function(){
            component.advertising_plan_id = $('#advertising-plan').find('option:selected').data('advertising-id');
            computedPlanDate();
        })
        
        function computedPlanDate() {
            const duration = parseInt($('#advertising-plan').val(), 10);
            const fromDate = $('#from-date').val();

            if (fromDate === '' || isNaN(duration)) return;

            const fromDateISO = new Date(fromDate);
            
            // Calculate the new date by adding the duration
            const toDateISO = new Date(fromDateISO);
            toDateISO.setDate(toDateISO.getDate() + duration);

            // Format the to_date as YYYY-MM-DD for display
            const toDateFormatted = toDateISO.toISOString().split('T')[0];

            // Update the component and the display
            component.from_date = fromDateISO.toISOString();
            component.to_date = toDateISO.toISOString();
            
            $('#to-date').val(toDateFormatted);
        }
    });
</script>
@endscript