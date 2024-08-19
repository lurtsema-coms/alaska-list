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
    public $to_date_computed = '';
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
        return AdvertisingPlan::withTrashed()->get();
    }

    public function editSpecialBoost()
    {
        $photo = $this->photo;

        $sp = SpecialBoost::with('product')->find($this->sponsor_id);
        
        $sp->update([
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
            'updated_by' => auth()->user()->id
        ]);

        if(!empty($photo)) {

            if(!$sp->file_name){
                $uuid = substr(Str::uuid()->toString(), 0, 8);
                $file_name = $sp->product->uuid . "-$uuid" . "." . $photo->getClientOriginalExtension();
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

                $this->file_path = $f_path;
            }else{
                // Replace Photo
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

        }

        $this->resetData(['photo']);
        $this->edit_boost = false;
        $this->inc++;
        $this->dispatch('alert-success');
    }

    public function computePlanDate()
    {
        $ap = AdvertisingPlan::find($this->advertising_plan);
        
        // Check if $ap is not null and has a duration_day property
        if ($ap && $ap->duration_days) {
            
            $from_date = Carbon::parse($this->from_date);
            
            $to_date = $from_date->copy()->addDays($ap->duration_days);
            
            $this->from_date = $from_date->format('Y-m-d\TH:i');
            $this->to_date = $to_date->toDateTimeString();
        } else {
            $this->from_date = null;
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
    <button class="px-4 py-2 text-sm text-white bg-blue-400 rounded-lg shadow-md hover:bg-blue-500"
    @click="edit_boost=true; $wire.deletedAt()">
        EDIT
    </button>
    
    <div class="fixed top-0 left-0 z-10 w-full h-full overflow-auto bg-black position bg-opacity-30"
        x-show="edit_boost"
        x-transition
        x-cloak>
        <div class="flex h-full p-5">
            <div class="w-full max-w-xl m-auto overflow-hidden bg-white shadow-lg rounded-2xl"
            @click.outside="edit_boost=false; $wire.call('resetData', ['photo'])">
                <div class="p-10 max-h-[35rem] overflow-auto">
                    <form wire:submit="editSpecialBoost">
                        <p class="mb-6 text-lg font-bold tracking-wide pointer-events-none text-slate-700">Edit Boost</p>
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
                                    <input class="text-base w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55] datetime-input" type="datetime-local" wire:change="computePlanDate" wire:model="from_date" required wire:ignore>
                                </div>
                                <div class="flex-1 space-y-2">
                                    <p class="font-medium text-slate-700">To Date</p>
                                        <input class="text-base w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" required wire:model="to_date" readonly required>
                                </div>
                            </div>
                            @if (!empty($file_path))                                
                                <div class="flex flex-col space-y-2">
                                    <label class="font-medium text-slate-700">Current Image</label>
                                    <img class="object-contain w-full h-56"
                                            src="{{ asset($file_path) }}?v={{ md5_file(public_path($file_path)) }}"
                                            alt="Image">
                                </div>
                            @endif
                            <div class="flex flex-col space-y-2">
                                <label class="font-medium text-slate-700">{{ $file_path ? "Replace New Photo" : "Add Photo"}}</label>
                                <input class="text-md w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="file" wire:model="photo" id="upload-{{ $inc }}">
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
