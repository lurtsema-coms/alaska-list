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
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    
    use WithFileUploads;

    public $sponsor;
    public $sponsor_id;
    public $item_code = '';
    public $advertising_plan = '';
    public $from_date = '';
    public $to_date = '';
    public $file_name = '';
    public $file_path;
    public $photo = '';
    public $inc = 1;
    public $deleted_at;
    public $edit_boost = false;

    public function mount($sponsor)
    {
        $this->sponsor_id = $sponsor->id;
        $this->item_code = $sponsor->product->uuid;
        $this->advertising_plan = $sponsor->product_id;
        $this->from_date = $sponsor->from_date;
        $this->to_date = $sponsor->to_date;
        $this->file_path = $sponsor->file_path;
    }

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

    public function editSpecialBoost()
    {
        $photo = $this->photo;

        $sp = SpecialBoost::find($this->sponsor_id);
        
        $sp->update([
            'to_date' => $this->to_date,
            'updated_by' => auth()->user()->id
        ]);

        if(!empty($photo)) {
            // Upload Photo
            $file_name = $sp->file_name;
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
        }

        $this->resetData(['photo']);
        $this->edit_boost = false;
        $this->inc++;
        $this->dispatch('alert-success');
    }

    public function computePlanDate()
    {
        // Fetch the advertising plan by name
        $ap = AdvertisingPlan::find($this->advertising_plan);

        // Check if $ap is not null and has a duration_days property
        if ($ap && $ap->duration_days) {
            // If from_date is not set, use the current date
            $start_date = $this->from_date ? Carbon::parse($this->from_date) : Carbon::now();
            
            // Calculate the to_date by adding the duration_days to the start_date
            $to_date = $start_date->copy()->addDays($ap->duration_days);

            // Set the to_date to the computed date
            $this->to_date = $to_date->toDateString(); // Format as a string
        } else {
            // Handle the case where $ap is null or duration_days is not set
            $this->to_date = null;
        }
    }

    public function deletedAt(){
        $this->deleted_at = $this->sponsor->deleted_at;
    }

    public function resetData($data)
    {
        $this->reset($data);
    }
}; ?>

<div style="font-size: 16px;"
    x-data="{ edit_boost: $wire.entangle('edit_boost') }" x-init="$watch('edit_boost', value => {
        if (value) {
            document.body.classList.add('overflow-hidden');
        } else {
            document.body.classList.remove('overflow-hidden');
        }
    })">
    <button class="bg-blue-400 text-sm text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-500"
    @click="edit_boost=true; $wire.deletedAt()">
        EDIT
    </button>
    
    <div class="position fixed h-full w-full top-0 left-0 bg-black bg-opacity-30 z-10 overflow-auto"
        x-show="edit_boost"
        x-transition
        x-cloak>
        <div class="h-full flex p-5">
            <div class="bg-white w-full max-w-xl m-auto rounded-2xl shadow-lg overflow-hidden"
            @click.outside="edit_boost=false; $wire.call('resetData', ['photo'])">
                <div class="p-10 max-h-[35rem] overflow-auto">
                    <form wire:submit="editSpecialBoost">
                        <p class="font-bold text-lg text-slate-700 tracking-wide mb-6 pointer-events-none">Edit Boost</p>
                        <div class="space-y-4">
                            <div class="flex flex-col gap-4 sm:flex-row">
                                <div class="flex-1 space-y-2" wire:ignore>
                                    <p class="font-medium text-slate-700">Item Code</p>
                                    <input class="text-base w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" wire:model="item_code" readonly>
                                </div>
                                <div class="flex-1 space-y-2" wire:ignore>
                                    <p class="font-medium text-slate-700">Advertising Plan</p>
                                    <select class="text-base w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" wire:model="advertising_plan" wire:change="computePlanDate" required>
                                        <option value="" disabled selected>Select at least one</option>
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
                            <div class="flex flex-col space-y-2">
                                <label class="font-medium text-slate-700">Current Image</label>
                                    <img class="h-56 w-full object-contain"
                                        src="{{ asset($file_path) }}?v={{ md5_file(public_path($file_path)) }}"
                                        alt="Image">
                            </div>
                            <div class="flex flex-col space-y-2">
                                <label class="font-medium text-slate-700">Replace New Photo</label>
                                <input class="text-md w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="file" wire:model="photo" id="upload-{{ $inc }}">
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-8">
                            <button class="text-slate-600 shadow py-2 px-4 rounded-lg hover:opacity-70" type="button"
                                @click="edit_boost=false; $wire.call('resetData', ['photo'])">
                                Cancel
                            </button>
                            @if (!$sponsor->deleted_at)                                
                                <button class="text-white bg-[#1F4B55] shadow py-2 px-4 rounded-lg hover:opacity-70" type="submit">Save</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
