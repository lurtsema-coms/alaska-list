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
        return Product::get();
    }

    public function loadAdvertisingPlans(){
        return AdvertisingPlan::get();
    }

    public function addSpecialBoost()
    {
        $photo = $this->photo;

        if(empty($photo)){
            $this->resetData(['advertising_plan', 'item_code', 'from_date', 'to_date', 'photo']);
            return $this->dispatch('alert-error');
        }

        $product = Product::find($this->item_code);

        $sp = SpecialBoost::create([
            'product_id' => $product->id,
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
            'created_by' => auth()->user()->id
        ]);
        
        // Upload Photo
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

        $this->resetData(['advertising_plan', 'item_code', 'from_date', 'to_date', 'photo']);
        $this->add_boost_modal = false;
        $this->inc++;
        $this->dispatch('alert-success');
    }

    public function computePlanDate()
    {
        // Fetch the advertising plan by name
        $ap = AdvertisingPlan::find($this->advertising_plan);

        // Check if $ap is not null and has a duration_day property
        if ($ap && $ap->duration_days) {
            
            $current_date = Carbon::now();
            $this->from_date = $current_date->toDateString();
            // Calculate the to_date by adding the duration_day to the current date
            $to_date = $current_date->copy()->addDays($ap->duration_days);
            // Set the to_date to the computed date
            $this->to_date = $to_date->toDateString(); // Format as a string
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
    <button class="bg-blue-400 text-sm text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-500"
    @click="add_boost_modal=true">
        Add Boost
    </button>
    
    <div class="position fixed h-full w-full top-0 left-0 bg-black bg-opacity-30 z-10 overflow-auto"
        x-show="add_boost_modal"
        x-transition
        x-cloak>
        <div class="h-full flex p-5">
            <div class="bg-white w-full max-w-xl m-auto rounded-2xl shadow-lg overflow-hidden"
            @click.outside="add_boost_modal=false; $wire.call('resetData', ['advertising_plan', 'item_code', 'from_date', 'to_date', 'photo']); $('#item-code').selectize()[0].selectize.clear(); $('#advertising-plan').selectize()[0].selectize.clear();">
                <div class="p-10 max-h-[35rem] overflow-auto">
                    <form wire:submit="addSpecialBoost">
                        <p class="font-bold text-lg text-slate-700 tracking-wide mb-6 pointer-events-none">Add Boost</p>
                        <div class="space-y-4">
                            <div class="flex flex-col gap-4 sm:flex-row">
                                <div class="flex-1 space-y-2" wire:ignore>
                                    <p class="font-medium text-slate-700">Item Code</p>
                                    <select class="selectize-select" id="item-code" wire:model="item_code" required>
                                        <option value="" disabled></option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->uuid }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex-1 space-y-2" wire:ignore>
                                    <p class="font-medium text-slate-700">Advertising Plan</p>
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
                                    <p class="font-medium text-slate-700">From Date</p>
                                    <input class="text-base w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" required wire:model="from_date" readonly required>
                                </div>
                                <div class="flex-1 space-y-2">
                                    <p class="font-medium text-slate-700">To Date</p>
                                        <input class="text-base w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" required wire:model="to_date" readonly required>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="font-medium text-slate-700">Upload Photos</label>
                                <input class="text-md w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="file" wire:model="photo" id="upload-{{ $inc }}" required>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm mb-2">
                                    Requirement: For best quality in advertising, the image should be exactly 300px in height and 600px in width.
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-8">
                            <button class="text-slate-600 shadow py-2 px-4 rounded-lg hover:opacity-70" type="button"
                                @click="add_boost_modal=false; $wire.call('resetData', ['advertising_plan', 'item_code', 'from_date', 'to_date', 'photo']); $('#item-code').selectize()[0].selectize.clear(); $('#advertising-plan').selectize()[0].selectize.clear();">
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