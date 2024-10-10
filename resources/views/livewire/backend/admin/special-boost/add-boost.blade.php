<?php

use App\Traits\ListingOption;
use App\Models\AdvertisingPlan;
use App\Models\SpecialBoost;
use App\Models\Advertisement;
use App\Models\Product;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Intervention\Image\Facades\Image as Image;
use Livewire\Volt\Component;

new class extends Component {
    
    use ListingOption;
    use WithFileUploads;

    public $item_code = '';
    public $advertising_plan_id = '';
    public $from_date = '';
    public $to_date = '';
    public $file_name = '';
    public $photo = '';
    public $inc = 1;
    public $add_boost_modal = false;

    public function mount()
    {
        $checkoutData = session('checkout_data');
        if ($checkoutData) {
            $this->item_code = $checkoutData['item_code'] ?? '';
            $this->advertising_plan_id = $checkoutData['advertising_plan_id'] ?? '';
            $this->from_date = $checkoutData['from_date'] ?? '';
            $this->to_date = $checkoutData['to_date'] ?? '';
            $this->add_boost_modal = $checkoutData['add_boost_modal'] ?? '';
        }
    }

    public function with(): array
    {
        return [
            'products' => $this->loadProducts()['products'],
            'disabledProductIds' => $this->loadProducts()['disabledProductIds'],
            'plans' => $this->loadAdvertisingPlans(),
        ];
    }

    public function loadProducts()
    {
        // Get all products belonging to the authenticated user
        $products = Product::belongsToUser(auth()->user()->id)->get();

        // Get the IDs of products boosted in the Special Boost module
        $boostedProductIds = SpecialBoost::where('from_date', '<=', now())
            ->where('to_date', '>=', now())
            ->pluck('product_id')
            ->toArray();

        // Get the IDs of products boosted in the Advertisement module
        $boostedAdProductIds = Advertisement::where('from_date', '<=', now())
            ->where('to_date', '>=', now())
            ->pluck('product_id')
            ->toArray();

        // Merge both boosted IDs
        $disabledProductIds = array_merge($boostedProductIds, $boostedAdProductIds);

        // Pass products and the combined boosted IDs to the view
        return compact('products', 'disabledProductIds');
    }

    public function loadAdvertisingPlans(){
        return AdvertisingPlan::get();
    }

    public function addSpecialBoost()
    {
    // Ensure $this->item_code contains a valid product ID
    $product = Product::where('id', $this->item_code)->first();  // Retrieve a single product

    if (!$product) {
        // Handle the case where the product doesn't exist
        $this->dispatch('alert-error', 'Product not found.');
        return;
    }

    $product_plan = AdvertisingPlan::find($this->advertising_plan_id);

    if (!$product_plan) {
        // Handle missing plan scenario
        $this->dispatch('alert-error', 'Advertising plan not found.');
        return;
    }

    $productPriceId = $product_plan->price_id;
    $user = auth()->user();

    // Store checkout data
    session()->put('checkout_data', [
        'item_code' => $this->item_code,
        'product_id' => $product->id,
        'advertising_plan_id' => $this->advertising_plan_id,
        'from_date' => $this->from_date,
        'to_date' => $this->to_date,
        'add_boost_modal' => $this->add_boost_modal,
    ]);

    // Redirect user to checkout
    return $user->checkout([$productPriceId], [
        'success_url' => route('checkout-success'),
        'cancel_url' => route('checkout-cancel'),
    ]);
}
    public function clearCheckoutData()
    {
        session()->forget('checkout_data');
    }

    public function resetData($data)
    {
        $this->reset($data);
    }
}; ?>

<div 
    x-data="{ add_boost_modal: $wire.entangle('add_boost_modal') }" x-init="$watch('add_boost_modal', value => {
        if (value) {
            document.body.classList.add('overflow-hidden');
        } else {
            document.body.classList.remove('overflow-hidden');
        }
    })">
    <button class="px-4 py-2 text-sm text-white bg-blue-400 rounded-lg shadow-md hover:bg-blue-500"
    @click="add_boost_modal=true">
        Add Boost
    </button>
    
    <div class="fixed top-0 left-0 z-10 w-full h-full overflow-auto bg-black position bg-opacity-30"
        x-show="add_boost_modal"
        x-transition
        x-cloak
    >
        <div class="flex h-full p-5">
            <div 
                class="w-full max-w-xl m-auto overflow-hidden bg-white shadow-lg rounded-2xl"
                @click.outside="
                    add_boost_modal=false; 
                    $wire.call('resetData', ['item_code', 'from_date', 'to_date', 'photo']); 
                    $('#item-code').selectize()[0].selectize.clear();
                    $('#from-date').val('');
                    $('#to-date').val('');
                    $('#advertising-plan').val('');
                "
                wire:click="clearCheckoutData"    
            >
                <div class="p-10 max-h-[35rem] overflow-auto">
                    <form wire:submit="addSpecialBoost">
                        <p class="mb-6 text-lg font-bold tracking-wide pointer-events-none text-slate-700">Add Boost</p>
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="" wire:ignore>
                                    <p class="font-medium text-slate-700">Item Code <span class="text-red-400">*</span></p>
                                    <select class="selectize-select" id="item-code" wire:model="item_code" required>
                                        <option value="" disabled>Select a product</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" 
                                                @if(in_array($product->id, $disabledProductIds)) disabled @endif>
                                                {{ $product->uuid }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div 
                                    class="" 
                                    wire:ignore
                                    x-data="
                                        {
                                            advertising_plan_id: '{{ $advertising_plan_id }}'
                                        }
                                    "
                                >
                                    <p class="font-medium text-slate-700">Advertising Plan <span class="text-red-400">*</span></p>
                                    <select 
                                        class="w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" 
                                        id="advertising-plan" 
                                        x-model="advertising_plan_id"
                                        required
                                    >
                                            <option value="" disabled selected>Choose Plan</option>
                                            @foreach ($plans as $plan)
                                                <option value="{{ $plan->duration_days }}" data-advertising-id="{{ $plan->id }}">{{ $plan->name }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div x-data="{ 
                                        from_date: '',
                                        formatted_date: '',
                                        init() {
                                            // Set from_date based on the session variable
                                            this.from_date = '{{ $from_date }}';
                                            this.formatted_date = this.from_date ? moment(moment.utc(this.from_date).toDate()).format('YYYY-MM-DDTHH:mm') : '';
                                        }
                                    }" 
                                    x-init="init()"
                                >
                                    <p class="font-medium text-slate-700">From Date</p>
                                    
                                    <input 
                                        class="text-base w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]"
                                        id="from-date" 
                                        type="datetime-local" 
                                        x-bind:value="formatted_date" 
                                        required 
                                        min="2024-10-03T09:48"
                                    >   
                                </div>
                                <div 
                                    x-data="{ 
                                        to_date: '',
                                        formatted_date: '',
                                        init() {
                                            // Set to_date based on the session variable
                                            this.to_date = '{{ $to_date }}';
                                            this.formatted_date = this.to_date ? moment(moment.utc(this.to_date).toDate()).format('YYYY-MM-DD') : '';
                                        }
                                    }" 
                                    x-init="init()"
                                >
                                    <p class="font-medium text-slate-700">To Date</p>
                                    <input 
                                        class="text-base w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]"
                                        id="to-date"
                                        type="text"
                                        x-bind:value="formatted_date" 
                                        readonly 
                                        required
                                    >
                                </div>
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
                            <button 
                                class="px-4 py-2 rounded-lg shadow text-slate-600 hover:opacity-70" type="button"
                                @click="
                                    add_boost_modal=false; 
                                    $wire.call('resetData', ['item_code', 'from_date', 'to_date', 'photo']); 
                                    $('#item-code').selectize()[0].selectize.clear();
                                    $('#from-date').val('');
                                    $('#to-date').val('');
                                    $('#advertising-plan').val('');
                                "
                                wire:click="clearCheckoutData"    
                            >
                                Cancel
                            </button>
                            <button class="text-white bg-[#1F4B55] shadow py-2 px-4 rounded-lg hover:opacity-70" type="submit">Submit</button>
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

        $('#item-code').selectize();
        
        component.item_code = $('#item-code').val();
        
        $('#item-code').on('change', function(){
            component.item_code = $(this).val();
        })

        $wire.on('alert-success', function() {
            $('#item-code').selectize()[0].selectize.clear();
        })

        $wire.on('alert-error', function() {
            $('#item-code').selectize()[0].selectize.clear();
        })

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

            // Format the to_date as DD-MM-YYYY for display
            const toDateFormatted = `${String(toDateISO.getMonth() + 1).padStart(2, '0')}/${String(toDateISO.getDate()).padStart(2, '0')}/${toDateISO.getFullYear()}`;

            // Update the component and the display
            component.from_date = fromDateISO.toISOString();
            component.to_date = toDateISO.toISOString();
            
            $('#to-date').val(toDateFormatted);
        }
    });
</script>
@endscript