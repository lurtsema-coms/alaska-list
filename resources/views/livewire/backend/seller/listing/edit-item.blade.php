<?php

use App\Models\Category;
use App\Models\Product;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On; 
use Livewire\Volt\Component;

new class extends Component {

    use WithFileUploads;

    public $product_id;
    public $sub_category = '';
    public $title_name = '';
    public $price = '';
    public $qty = '';
    public $location = '';
    public $description = '';
    public $additional_information = '';
    #[Validate(['photos.*' => 'image|max:5120'])]
    public $photos = [];
    public $photos_file = [];
    public $inc = 1;
    public $status;


    public function mount()
    {
        $user_id = auth()->user()->id;
        
        $product_id = request()->route('id');
        $product = Product::withTrashed()->with('subCategory')->find($product_id);
        
        // Check if the product exists and if the authenticated user is the owner
        if (!$product || $product->created_by !== $user_id) {
            abort(404); // or redirect with an error message
        }

        $this->product_id = $product->id;
        $this->sub_category = $product->subCategory->id;
        $this->title_name = $product->name;
        $this->price = $product->price;
        $this->qty = $product->qty;
        $this->location = $product->location;
        $this->description = $product->description;
        $this->additional_information = $product->additional_information;
        $this->status = $product->status;

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

    public function saveItem()
    {
        $this->validate();

        if(count($this->photos) == 0 && count($this->photos_file) == 0){
            $this->addError('no_photo', 'At least one photo');  
            return;
        }

        if(count($this->photos_file) + count($this->photos) > 4){
            $this->addError('count_photo', 'No more than 4 photos');  
            return;
        }

        $user_id = auth()->user()->id;

        $save_photo_names = [];
        $save_photo_paths = [];
        $photo_names = [];
        $photo_paths = [];

        // Collect file_names from $this->photos_file
        foreach ($this->photos_file as $photo) {
            $save_photo_names[] = $photo['file_names'];
            $save_photo_paths[] = $photo['file_paths'];
        }

        // Directory path where files are stored
        $directory = storage_path("app/public/photos/listing-item/$user_id/$this->product_id");

        // Get all files in the directory
        $files = scandir($directory);

        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            if (!in_array($file, $save_photo_names)) {
                unlink("$directory/$file");
            }
        }

        if(!empty($this->photos)){
            foreach ($this->photos as $photo) {
                $uuid = substr(Str::uuid()->toString(), 0, 8);
                    $file_name = $user_id . "-" . $uuid . "." . $photo->getClientOriginalExtension();
    
                $path = $photo->storeAs(
                    path: "public/photos/listing-item/$user_id/$this->product_id",
                    name: $file_name
                );

                // Optimize image
                $file_path = storage_path("app/" . $path);
                $image = Image::make($file_path);
                $image->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save($file_path, 80);
    
                $photo_names[] = $file_name;
                $photo_paths[] = "storage/photos/listing-item/$user_id/$this->product_id/$file_name";
            }
        }

        $merged_names = array_merge($save_photo_names, $photo_names);
        $merged_paths = array_merge($save_photo_paths, $photo_paths);

        $product = Product::find($this->product_id)
            ->update([
                'sub_category_id' => (int)$this->sub_category,
                'name' => $this->title_name,
                'price' => $this->price,
                'qty' => $this->qty,
                'location' => $this->location,
                'description' => $this->description,
                'additional_information' => $this->additional_information,
                'file_name' => implode(",", $merged_names) ?: null,
                'file_path' => implode(",", $merged_paths) ?: null,
                'updated_by' => $user_id,
            ]);

        // Reset Data
        $this->inc++;
        $this->resetData(['photos']);

        $count = count($merged_names);

        for ($i = 0; $i < $count; $i++) {
            $this->photos_file[$i] = [
                'file_names' => $merged_names[$i],
                'file_paths' => $merged_paths[$i],
            ];
        }

        $this->dispatch('new-img');
        
        session()->flash('alert-success', 'Item Successfully added');
        $this->redirect(route('seller-listing'), navigate: true);
    }

    public function deleteItem(){
        $product = Product::find($this->product_id);
        $product->update([
            'status' => 'DELETED',
            'updated_by' => auth()->user()->id,
        ]);
        $product->delete();

        $this->dispatch('alert-success', route: route('seller-listing'));
    }

    public function loadCategories()
    {
        return Category::with('subCategories')
            ->get();
    }

    public function deleteImg($index)
    {
        unset($this->photos_file[$index]);
        $this->photos_file = array_values($this->photos_file);
        $this->dispatch('new-img');
    }

    public function deleteTempImg($index)
    {
        unset($this->photos[$index]);
        $this->photos = array_values($this->photos);
        $this->dispatch('new-img');
    }

    public function resetData($data)
    {
        $this->reset($data);
    }
}; ?>

<div class="py-8">
    <div class="px-4 py-8 mx-auto space-y-8 bg-white shadow sm:container sm:rounded-lg sm:px-6 lg:px-8">
        <a class="inline-block mb-4 font-medium text-sky-600" href="{{ route('seller-listing') }}" wire:navigate>
            <span class="flex items-center space-x-2 cursor-pointer hover:opacity-70">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span>Back to Listing page</span>
            </span>
        </a>
        <div class="pb-8">
            <form action="post" wire:submit="saveItem" enctype="multipart/form-data">
                <div class="max-w-4xl m-auto space-y-4">
                    <div class="p-4 text-yellow-800 bg-yellow-100 border border-yellow-300 rounded-lg shadow-md">
                        <div class="text-lg font-semibold">
                            Note:
                        </div>
                        <p class="mt-2">
                            If this post has already been deleted, it cannot be edited.
                        </p>
                    </div>
                    <div class="flex flex-col gap-4 sm:flex-row">
                        <div class="flex-1 space-y-2">
                            <p class="font-medium text-slate-700">Category <span class="text-red-400">*</span></p>
                            <select class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" name="" id="" required wire:model="sub_category" {{ $status == 'DELETED' ? 'disabled' : '' }}>
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
                                <p class="font-medium text-slate-700">Title Name <span class="text-red-400">*</span></p>
                                <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" required wire:model="title_name" {{ $status == 'DELETED' ? 'disabled' : '' }} placeholder="Enter the title name here">
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 sm:flex-row">
                        <div class="flex-1 space-y-2">
                            <div class="space-y-2">
                                <p class="font-medium text-slate-700">Location <span class="text-red-400">*</span></p>
                                <select class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" name="" id="" required wire:model="location">
                                    <option value="" disabled selected>Select one</option>
                                    @foreach (config('global.us_states') as $location)
                                        <option value="{{ $location }}" wire:key="edit-location-{{ $location }}">{{ $location }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex-1 space-y-2">
                            <div class="space-y-2">
                                <p class="font-medium text-slate-700">Price <span class="text-red-400">*</span></p>
                                <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="number" step="0.01" required wire:model="price" {{ $status == 'DELETED' ? 'disabled' : '' }}placeholder="Enter price">
                            </div>
                        </div>
                        <div class="flex-1 space-y-2">
                            <div class="space-y-2">
                                <p class="font-medium text-slate-700">Quantity</p>
                                <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" wire:model="qty" wire:model="qty" {{ $status == 'DELETED' ? 'disabled' : '' }} placeholder="Leave blank if not applicable">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex-1 space-y-2">
                            <p class="font-medium text-slate-700">Description <span class="text-red-400">*</span></p>
                            <textarea class="text-md w-full py-4 px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" name="" id="" cols="50" rows="5" required wire:model="description" {{ $status == 'DELETED' ? 'disabled' : '' }} placeholder="Provide a detailed description"></textarea>
                        </div>
                    </div>
                    <div>
                        <div class="flex-1 space-y-2">
                            <p class="font-medium text-slate-700">Additional Information</p>
                            <textarea class="text-md w-full py-4 px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" name="" id="" cols="50" rows="5" wire:model="additional_information" {{ $status == 'DELETED' ? 'disabled' : '' }} placeholder="Add any additional information here"></textarea>
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
                                    <button class="text-red-600 hover:text-red-700" type="button" wire:click="deleteImg({{ $index }})" {{ $status == 'DELETED' ? 'disabled' : '' }}>
                                        Delete
                                    </button>
                                </div>
                                @endforeach
                            @endif
                            @if ($photos)
                                @foreach (array_reverse($photos) as $index => $photo)
                                    <div class="relative space-y-2" wire:key="uploaded-img-{{ $index }}">                                   
                                        <div class="item-img" data-src="{{ $photo->temporaryUrl() }}">
                                            <img class="object-contain h-56 cursor-pointer max-w-96" src="{{ $photo->temporaryUrl() }}">
                                        </div>
                                        <button class="text-red-600 hover:text-red-700" type="button" wire:click="deleteTempImg({{ $index }})">
                                            Delete
                                        </button>                                
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        @error('photos.*') <span class="text-red-500">{{ $message }}</span> @enderror
                        @error('count_photo') <span class="text-red-500">{{ $message }}</span> @enderror
                        @error('no_photo') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="space-y-2">
                        <div class="space-y-2">
                            <label class="block font-medium text-slate-700">Upload Photos</label>
                            <input type="file" multiple wire:model="photos" @change="$dispatch('new-img')" x-ref="fileInput" class="hidden" {{ $status == 'DELETED' ? 'disabled' : '' }} accept="image/*">
                            <!-- Custom Button -->
                            <button type="button"
                                    class="block text-md px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55] text-slate-600 hover:bg-[#246567] hover:text-white cursor-pointer"
                                    x-on:click="$refs.fileInput.click()">
                                Upload Photos
                            </button>
                        </div>
                        
                        <ul class="mt-2">
                            @foreach(array_reverse($photos) as $index => $photo)
                                <li wire:key="{{ $index }}" class="text-slate-700">
                                    {{ $photo->getClientOriginalName() }}
                                </li>
                            @endforeach
                        </ul>
                        @error('photos.*') <div class="mt-4">{{ $message }}</div>@enderror
                    </div>
                    <div class="w-full text-center" wire:loading>
                        <div class="flex items-center justify-center gap-2">
                            <svg class="animate-spin h-5 w-5 text-[#1F4B55]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 2.042.777 3.908 2.05 5.334l1.95-2.043z"></path>
                            </svg>
                            <span class="font-medium text-md text-slate-600">Saving post...</span>
                        </div>
                    </div>
                    <div class="!mt-8 text-right space-x-2">
                        @if ($status != 'DELETED')                            
                            <button class="px-4 py-2 text-white bg-red-500 rounded-lg shadow hover:opacity-70" 
                            type="button" 
                            wire:click="deleteItem"
                            wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE">Delete</button>
                            <button class="text-white bg-[#1F4B55] shadow py-2 px-4 rounded-lg hover:opacity-70" type="submit" {{ $status == 'DELETED' ? 'disabled' : '' }}>Save</button>
                        @endif
                    </div>
                    <livewire:component.alert-messages />
                </div>
            </form>
        </div>
    </div>
</div>

@script
<script>
    let lightGalleryInstance = null;

    // Function to initialize lightGallery
    function initializeLightGallery() {
        if (typeof lightGallery !== 'undefined' && document.getElementById('lightgallery')) {
            lightGalleryInstance = lightGallery(document.getElementById('lightgallery'), {
                selector: '.item-img',
                speed: 500,
                plugins: [lgThumbnail],
                enableDrag: false,
                enableSwipe: false
            });
        }
    }

    // Function to destroy lightGallery instance
    function destroyLightGallery() {
        if (lightGalleryInstance) {
            lightGalleryInstance.destroy();
            lightGalleryInstance = null;
        }
    }

    // Initial setup
    document.addEventListener('DOMContentLoaded', function() {
        initializeLightGallery();
    });

    // Reinitialize lightGallery on Livewire navigations
    document.addEventListener('livewire:navigated', function () {
        destroyLightGallery();
        initializeLightGallery();
    });

    // Example of how to handle 'new-img' event
    $wire.on('new-img', (event) => {
        destroyLightGallery();
        setTimeout(function() {
            initializeLightGallery();
        }, 1500);
    });

    // Destroy lightGallery on Livewire navigating (before navigation)
    document.addEventListener('livewire:navigating', () => {
        destroyLightGallery();
    });
</script>
@endscript
