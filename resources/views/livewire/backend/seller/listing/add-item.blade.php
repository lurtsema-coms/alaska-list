<?php

use App\Models\Category;
use App\Models\Product;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Intervention\Image\Facades\Image as Image;
use Livewire\Volt\Component;

new class extends Component {

    use WithFileUploads;

    #[Validate('required')]
    public $sub_category = '';
    #[Validate('required')]
    public $title_name = '';
    #[Validate('required')]
    public $location = '';
    #[Validate('required')]
    public $price = '';
    public $qty = '';
    #[Validate('required')]
    public $description = '';
    public $additional_information = '';
    #[Validate(['photos' => 'required|array|max:4', 'photos.*' => 'image|max:5120'])]
    public $photos = [];
    public $inc = 1;

    public function addItem()
    {
        $this->validate();
        
        $user_id = auth()->user()->id;

        $photo_names = [];
        $photo_paths = [];
        $uuid = '';

        if(empty($this->photos)){
            return $this->dispatch('alert-error');
        }

        $product = Product::create([
            'status' => 'ACTIVE',
            'uuid' => 'Item-Code-'.substr(Str::uuid()->toString(), 0, 10),
            'sub_category_id' => (int)$this->sub_category,
            'name' => $this->title_name,
            'price' => $this->price,
            'qty' => $this->qty,
            'location' => $this->location,
            'description' => $this->description,
            'additional_information' => $this->additional_information,
            'created_by' => $user_id
        ]);

        foreach ($this->photos as $photo) {
            $uuid = substr(Str::uuid()->toString(), 0, 8);
            $file_name = $user_id . "-" . $uuid . "." . $photo->getClientOriginalExtension();

            // Store the file in the public disk
            $path = $photo->storeAs(
                path: "public/photos/listing-item/$user_id/$product->id",
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
            $photo_paths[] = "storage/photos/listing-item/$user_id/$product->id/$file_name";
        }


        $product->update([
            'file_name' => implode(",", $photo_names),
            'file_path' => implode(",", $photo_paths),
        ]);

        $this->reset(['photos', 'sub_category', 'title_name', 'price', 'qty', 'description', 'additional_information']);
        $this->inc++;
        $this->dispatch('alert-success', route: route('seller-listing'));
    }
    
    public function with(): array
    {
        return [
            'categories' => $this->loadCategories(),
        ];
    }

    public function loadCategories()
    {
        return Category::with('subCategories')
            ->get();
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
            <form action="post" wire:submit="addItem" enctype="multipart/form-data">
                <div class="max-w-4xl m-auto space-y-4">
                    <div class="flex flex-col gap-4 sm:flex-row">
                        <div class="flex-1 space-y-2">
                            <p class="font-medium text-slate-700">Category <span class="text-red-400">*</span></p>
                            <select class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" name="" id="" required wire:model="sub_category">
                                <option value="" disabled selected>Select a sub category...</option>
                                @foreach ($categories as $category)
                                    <option class="font-medium text-sky-600" value="_" disabled>{{ $category->name }}</option>
                                    @foreach ($category->subCategories as $subCategory)
                                        <option value="{{ $subCategory->id }}" style="color: #333;"> &ndash; {{ $subCategory->name }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                            @error('sub_category')<span class="mt-1 text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="flex-1 space-y-2">
                            <div class="space-y-2">
                                <p class="font-medium text-slate-700">Title Name <span class="text-red-400">*</span></p>
                                <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" required wire:model="title_name" placeholder="Enter the title name here">
                                @error('title_name')<span class="mt-1 text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 sm:flex-row">
                        <div class="flex-1 space-y-2">
                            <div class="space-y-2">
                                <p class="font-medium text-slate-700">Location <span class="text-red-400">*</span></p>
                                <select class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" name="" id="" required wire:model="location">
                                    <option value="" disabled selected>Select one</option>
                                    @foreach (config('global.us_states') as $key => $location)
                                        <option value="{{ $key }}" wire:key="{{ $location }}-{{ $key }}">{{ $location }} ({{ $key }})</option>
                                    @endforeach
                                </select>
                                @error('location')<span class="mt-1 text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="flex-1 space-y-2">
                            <div class="space-y-2">
                                <p class="font-medium text-slate-700">Price <span class="text-red-400">*</span></p>
                                <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="number" step="0.01" required wire:model="price" placeholder="Enter price">
                                @error('price')<span class="mt-1 text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="flex-1 space-y-2">
                            <div class="space-y-2">
                                <p class="font-medium text-slate-700">Quantity</p>
                                <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" wire:model="qty" placeholder="Leave blank if not applicable">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex-1 space-y-2">
                            <p class="font-medium text-slate-700">Description <span class="text-red-400">*</span></p>
                            <textarea class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" name="" id="" cols="50" rows="5" wire:model="description" placeholder="Provide a detailed description"></textarea>
                            @error('description')<span class="mt-1 text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div>
                        <div class="flex-1 space-y-2">
                            <p class="font-medium text-slate-700">Additional Information</p>
                            <textarea class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" name="" id="" cols="50" rows="5" wire:model="additional_information" placeholder="Add any additional information here"></textarea>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="font-medium text-slate-700">Upload Photos <span class="text-red-400">*</span></label>
                        <input class="text-md w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="file" multiple wire:model="photos" wire:click="resetData(['photos'])" id="upload{{ $inc }}" accept="image/*" required>
                        <p class="text-gray-600">Note: Maximum of 4 photos</p>
                        <ul class="mt-2">
                            @foreach(array_reverse($photos) as $index => $photo)
                                <li wire:key="{{ $index }}" class="text-slate-700">
                                    {{ $photo->getClientOriginalName() }}
                                </li>
                            @endforeach
                        </ul>
                        @error('photos') <span class="text-red-500">{{ $message }}</span> @enderror
                        @error('photos.*') <span class="text-red-500">{{ $message }}</span> @enderror
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
                    <div class="!mt-8 text-right">
                        <button class="text-white bg-[#1F4B55] shadow py-2 px-4 rounded-lg hover:opacity-70" type="submit">Submit</button>
                    </div>
                    <livewire:component.alert-messages />
                </div>
            </form>
        </div>
    </div>
</div>
