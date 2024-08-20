<?php

use App\Models\AdvertisingPlan;
use App\Models\SpecialBoost;
use App\Models\Product;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Intervention\Image\Facades\Image as Image;
use Livewire\Volt\Component;

new class extends Component {
    
    use WithFileUploads;

    public $item_code = '';
    public $advertising_plan = '';
    public $from_date = '';
    public $to_date = '';
    public $to_date_computed = '';
    public $file_name = '';
    public $photo = '';
    public $inc = 1;
    public $add_boost_modal = false;

    public function with(): array
    {
        return [
            'products' => $this->loadProducts(),
            'plans' => $this->loadAdvertisingPlans(),
        ];
    }

    public function loadProducts(){
        return Product::where('status', 'ACTIVE')->get();
    }

    public function loadAdvertisingPlans(){
        return AdvertisingPlan::get();
    }

    public function addSpecialBoost()
    {
        $photo = $this->photo;

        // if(empty($this->photo)){
        //     return $this->dispatch('alert-error');
        // }

        $product = Product::find($this->item_code);

        $sp = SpecialBoost::create([
            'product_id' => $product->id,
            'advertising_plan_id' => $this->advertising_plan,
            'from_date' => $this->from_date,
            'to_date' => $this->to_date_computed,
            'created_by' => auth()->user()->id
        ]);

        // Upload Photo
        if(!empty($photo)){
            $uuid = substr(Str::uuid()->toString(), 0, 8);
            $file_name = $product->uuid . "-$uuid" . "." . $photo->getClientOriginalExtension();
            // Store the file in the public disk
            $path = $photo->storeAs(
                path: "public/photos/product-boost",
                name: $file_name
            );

            // Optimize image
            $file_path = storage_path("app/" . $path);
            $image = Image::make($file_path);
            $image->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save($file_path, 80);

            $f_path = "storage/photos/product-boost/$file_name";

            $sp->update([
                'file_name' => $file_name,
                'file_path' => $f_path,
            ]);
        }

        $this->resetData(['advertising_plan', 'item_code', 'from_date', 'to_date', 'photo']);
        $this->add_boost_modal = false;
        $this->inc++;
        $this->dispatch('alert-success');
    }

    public function computePlanDate()
    {
        $ap = AdvertisingPlan::find($this->advertising_plan);

        // Check if $ap is not null and has a duration_day property
        if ($ap && $ap->duration_days) {

            if($this->from_date == ''){
                $from_date = Carbon::now();
            }else{
                $from_date = Carbon::parse($this->from_date);
            }
            
            $to_date = $from_date->copy()->addDays($ap->duration_days);
            
            $this->from_date = $from_date->format('Y-m-d\TH:i');
            $this->to_date = $to_date->toDateString();
            $this->to_date_computed = $to_date->format('Y-m-d\TH:i');
        } else {
            $this->from_date = null;
            $this->to_date = null;
        }
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
        x-cloak>
        <div class="flex h-full p-5">
            <div class="w-full max-w-xl m-auto overflow-hidden bg-white shadow-lg rounded-2xl"
            @click.outside="add_boost_modal=false; $wire.call('resetData', ['advertising_plan', 'item_code', 'from_date', 'to_date', 'to_date_computed', 'photo']); $('#item-code').selectize()[0].selectize.clear(); $('#advertising-plan').selectize()[0].selectize.clear();">
                <div class="p-10 max-h-[35rem] overflow-auto">
                    <form wire:submit="addSpecialBoost">
                        <p class="mb-6 text-lg font-bold tracking-wide pointer-events-none text-slate-700">Add Boost</p>
                        <div class="space-y-4">
                            <div class="flex flex-col gap-4 sm:flex-row">
                                <div class="flex-1 space-y-2" wire:ignore>
                                    <p class="font-medium text-slate-700">Item Code <span class="text-red-400">*</span></p>
                                    <select class="selectize-select" id="item-code" wire:model="item_code" required>
                                        <option value="" disabled></option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->uuid }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex-1 space-y-2" wire:ignore>
                                    <p class="font-medium text-slate-700">Advertising Plan <span class="text-red-400">*</span></p>
                                    <select class="selectize-select" id="advertising-plan" required>
                                        <option value="" disabled selected></option>
                                        @foreach ($plans as $plan)
                                            <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="flex flex-col gap-4 sm:flex-row">
                                <div class="flex-1 space-y-2">
                                    <p class="font-medium text-slate-700">From Date <span class="text-red-400">*</span></p>
                                    <input class="text-base w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55] datetime-input" type="datetime-local" required wire:change="computePlanDate" wire:model="from_date" required wire:ignore>
                                </div>
                                <div class="flex-1 space-y-2">
                                    <p class="font-medium text-slate-700">To Date</p>
                                        <input class="text-base w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" required wire:model="to_date" readonly required>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="font-medium text-slate-700">Upload Photos</label>
                                <input class="text-md w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="file" wire:model="photo" id="upload-{{ $inc }}">
                            </div>
                            <div>
                                <p class="mb-2 text-sm text-gray-600">
                                    Requirement: For best quality in advertising, the image should be exactly 300px in height and 600px in width.
                                </p>
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
                                @click="add_boost_modal=false; $wire.call('resetData', ['advertising_plan', 'item_code', 'from_date', 'to_date', 'to_date_computed', 'photo']); $('#item-code').selectize()[0].selectize.clear(); $('#advertising-plan').selectize()[0].selectize.clear();">
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
        $('#advertising-plan').selectize();

        $('#item-code').on('change', function(){
            component.item_code = $(this).val();
        })

        $('#advertising-plan').on('change', function(){
            component.advertising_plan = $(this).val();
            component.call('computePlanDate');
        })

        $wire.on('alert-success', function() {
            $('#item-code').selectize()[0].selectize.clear();
            $('#advertising-plan').selectize()[0].selectize.clear();
        })

        $wire.on('alert-error', function() {
            $('#item-code').selectize()[0].selectize.clear();
            $('#advertising-plan').selectize()[0].selectize.clear();
        })
    });
</script>
@endscript