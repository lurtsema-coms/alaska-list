<?php

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new class extends Component {

    public $update_listing_modal = false;
    public $product_id;
    public $sub_category = '';
    public $title_name = '';
    public $price = '';
    public $qty = '';
    public $description = '';
    public $additional_information = '';
    public $photos = [];
    public $photos_file = [];
    public $status;

    public function mount($id)
    {
        $product = Product::withTrashed()
            ->with('subCategory')
            ->find($id);

        $this->product_id = $product->id;
        $this->sub_category = $product->subCategory->id;
        $this->title_name = $product->name;
        $this->price = $product->price;
        $this->qty = $product->qty;
        $this->description = $product->description;
        $this->additional_information = $product->additional_information;
        $this->status = $product->status;
        $this->update_listing_modal = false;

        if(!empty($product->file_name)){
            $file_names = explode(',', $product->file_name);
            $file_paths = explode(',', $product->file_path);
            $count = count($file_names);

            for ($i = 0; $i < $count; $i++) {
                $this->photos_file[$i] = [
                    'file_names' => $file_names[$i],
                    'file_paths' => $file_paths[$i],
                ];
            }
        }
    }

    
    public function with(): array
    {
        return [
            'categories' => $this->loadCategories(),
        ];
    }

    public function activeListing()
    {
        $product = Product::withTrashed()
            ->find($this->product_id);
            
        $product->update([
            'status' => 'ACTIVE',
            'approved_by' => auth()->user()->id,
            'approved_at' => date('Y-m-d H:i:s'),
        ]);

        $product->restore();

        $this->update_listing_modal = false;
        $this->status = 'ACTIVE';
        $this->dispatch('alert-success');
    }

    public function deleteListing()
    {
        $product = Product::withTrashed()
            ->find($this->product_id);
        
        $product->update([
            'status' => 'DELETED',
            'approved_by' => auth()->user()->id,
            'approved_at' => date('Y-m-d H:i:s')
        ]);

        $product->delete();

        $this->update_listing_modal = false;
        $this->status = 'DELETED';
        $this->dispatch('alert-success');
    }

    public function loadCategories()
    {
        return Category::with('subCategories')
            ->get();
    }
}; ?>

<div 
    x-data="{ update_listing_modal: $wire.entangle('update_listing_modal') }" x-init="$watch('update_listing_modal', value => {
        if (value) {
            document.body.classList.add('overflow-hidden');
        } else {
            document.body.classList.remove('overflow-hidden');
        }
    })">
    <button class="px-4 py-2 text-sm text-white bg-blue-400 rounded-lg shadow-md hover:bg-blue-500"
    @click="update_listing_modal=true">
        Update
    </button>
    
    <div class="fixed top-0 left-0 z-10 w-full h-full overflow-auto bg-black position bg-opacity-30"
        x-show="update_listing_modal"
        x-transition
        x-cloak>
        <div class="flex h-full p-5">
            <div class="w-full max-w-6xl m-auto overflow-hidden bg-white shadow-lg rounded-2xl"
            @click.outside="update_listing_modal=false;">
                <div class="p-10 max-h-[42rem] overflow-auto">
                    <div class="max-w-4xl m-auto space-y-4">
                        <p class="mb-6 text-lg font-bold tracking-wide pointer-events-none text-slate-700">Approve Listing</p>
                        <p>
                            <span class="font-bold {{ $status == 'ACTIVE' ? 'text-green-500' : 'text-red-500' }}">
                                {{ $status }}
                            </span>
                        </p>
                        <div class="flex flex-col gap-4 sm:flex-row">
                            <div class="flex-1 space-y-2">
                                <p class="font-medium text-slate-700">Category</p>
                                <select class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" name="" id="" required wire:model="sub_category" disabled>
                                    <option value="" disabled selected>Select a sub category...</option>
                                    @foreach ($categories as $category)
                                        <option class="font-medium text-sky-600" value="_" disabled>{{ $category->name }}</option>
                                        @foreach ($category->subCategories as $subCategory)
                                            <option value="{{ $subCategory->id }}" style="color: #333;"> &ndash; {{ $subCategory->name }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex-1 space-y-2">
                                <div class="space-y-2">
                                    <p class="font-medium text-slate-700">Title Name</p>
                                    <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" required wire:model="title_name" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4 sm:flex-row">
                            <div class="flex-1 space-y-2">
                                <div class="space-y-2">
                                    <p class="font-medium text-slate-700">Price</p>
                                    <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="number" required wire:model="price" disabled>
                                </div>
                            </div>
                            <div class="flex-1 space-y-2">
                                <div class="space-y-2">
                                    <p class="font-medium text-slate-700">Qty</p>
                                    <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="number" required wire:model="qty" wire:model="qty" min="0" disabled>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex-1 space-y-2">
                                <p class="font-medium text-slate-700">Description</p>
                                <textarea class="text-md w-full py-4 px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" name="" id="" cols="50" rows="5" required wire:model="description" disabled></textarea>
                            </div>
                        </div>
                        <div>
                            <div class="flex-1 space-y-2">
                                <p class="font-medium text-slate-700">Additional Information</p>
                                <textarea class="text-md w-full py-4 px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" name="" id="" cols="50" rows="5" required wire:model="additional_information" disabled></textarea>
                            </div>
                        </div>
                        <div class="p-4 border rounded-lg border-slate-300">
                            <div class="flex items-center gap-4 overflow-x-auto" id="lightgallery">
                                @if (!empty($photos_file))
                                    @foreach ($photos_file as $index => $file)
                                    <div class="relative space-y-2" wire:key="present-img-{{ $index }}">
                                        <div class="item-img" data-src="{{ asset($file['file_paths']) }}">
                                            <img class="object-contain h-56 cursor-pointer max-w-96"
                                            src="{{ asset($file['file_paths']) }}"
                                            alt="Image {{ $index }}">
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="!mt-8 text-right space-x-2">
                            <button class="px-4 py-2 rounded-lg shadow text-slate-600 hover:opacity-70" type="button" @click="update_listing_modal=false">
                                Cancel
                            </button>
                            @if ($status == 'ACTIVE')                            
                                <button class="px-4 py-2 text-white bg-red-500 rounded-lg shadow hover:opacity-70" type="button" wire:click="deleteListing">DELETE</button>
                            @else
                                <button class="px-4 py-2 text-white bg-green-500 rounded-lg shadow hover:opacity-70" wire:click="activeListing" type="button">ACTIVE</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
