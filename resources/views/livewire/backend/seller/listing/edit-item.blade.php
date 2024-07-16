<?php

use App\Models\Category;
use Livewire\Volt\Component;

new class extends Component {

    public function mount(){
        $id = request()->route('id');
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
}; ?>

<div class="py-8">
    <div class="sm:container bg-white py-8 px-4 sm:rounded-lg mx-auto space-y-8 shadow sm:px-6 lg:px-8">
        <a class="inline-block font-medium text-sky-600 mb-4" href="{{ route('seller-listing') }}" wire:navigate>
            <span class="flex items-center space-x-2 hover:opacity-70 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span>Back to Listing page</span>
            </span>
        </a>
        <div class="pb-8">
            <form action="post" wire:submit="addItem" enctype="multipart/form-data">
                <div class="max-w-4xl space-y-4 m-auto">
                    <div class="flex flex-col gap-4 sm:flex-row">
                        <div class="flex-1 space-y-2">
                            <p class="font-medium text-slate-700">Category</p>
                            <select class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" name="" id="" required wire:model="sub_category">
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
                                <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" required wire:model="title_name">
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 sm:flex-row">
                        <div class="flex-1 space-y-2">
                            <div class="space-y-2">
                                <p class="font-medium text-slate-700">Price</p>
                                <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" required wire:model="price">
                            </div>
                        </div>
                        <div class="flex-1 space-y-2">
                            <div class="space-y-2">
                                <p class="font-medium text-slate-700">Qty</p>
                                <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" required wire:model="qty" wire:model="qty">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex-1 space-y-2">
                            <p class="font-medium text-slate-700">Description</p>
                            <textarea class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" name="" id="" cols="50" rows="5" required wire:model="description"></textarea>
                        </div>
                    </div>
                    <div>
                        <div class="flex-1 space-y-2">
                            <p class="font-medium text-slate-700">Additional Information</p>
                            <textarea class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" name="" id="" cols="50" rows="5" required wire:model="additional_information"></textarea>
                        </div>
                    </div>
                    <div class="space-y-2" x-data="{ files: [] }">
                        <label class="font-medium text-slate-700">Upload Photos</label>
                        <input class="text-md w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="file" multiple wire:model="photos" @click="files=[];" @close="files=[];" @change="files = Array.from($event.target.files).map(file => file.name)" required>
                        
                        <ul class="mt-2">
                            <template x-for="file in files" :key="file">
                                <li x-text="file" class="text-slate-700"></li>
                            </template>
                        </ul>
                        @error('photos.*') <div class="mt-4">{{ $message }}</div>@enderror
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
