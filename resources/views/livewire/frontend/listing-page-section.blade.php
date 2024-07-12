<?php

use App\Models\Category;
use Livewire\Volt\Component;

new class extends Component {

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

<div class="space-y-8">
    <div>
    <h2 class=" text-4xl text-gray-800">Listing Page</h2>
    </div>
    <div class="space-y-10">
        <livewire:frontend.sponsored-listing>
        <div class="max-h-80 p-4 bg-white w-full mx-auto shadow-md rounded-xl space-y-4 overflow-y-auto">
            <p class="text-xl font-medium text-gray-700 mb-4">Sort by categories</p>
            <div class="flex flex-wrap -mx-2">
                @foreach ($categories as $category)
                    <div class="flex-grow basis-1/3 px-2 mb-4">
                        {{-- Category name --}}
                        <p class="text-lg font-medium text-gray-700 mb-2">{{ $category->name }}</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Radio buttons from database -->
                            @foreach($category->subCategories as $sub_category)
                                <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-100 rounded-lg p-2 transition-all">
                                    <input type="radio" name="" value="option1" class="form-radio text-blue-600 h-5 w-5">
                                    <span class="text-gray-600">{{ $sub_category->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 2xl:grid-cols-4 gap-4">
            <!-- Replace with your product cards or items -->
            <a class="" href="{{ route('listing-page-item') }}" wire:navigate>
                <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg hover:border-blue-400">
                    <p>Product 1</p>
                    <p>Product 1</p>
                </div>
            </a>
            <a class="" href="{{ route('listing-page-item') }}" wire:navigate>
                <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg hover:border-blue-400">
                    <p>Product 1</p>
                </div>            
            </a>
            <a class="" href="{{ route('listing-page-item') }}" wire:navigate>
                <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg hover:border-blue-400">
                    <p>Product 1</p>
                </div>            
            </a>
            <a class="" href="{{ route('listing-page-item') }}" wire:navigate>
                <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg hover:border-blue-400">
                    <p>Product 1</p>
                </div>            
            </a>
            <a class="" href="{{ route('listing-page-item') }}" wire:navigate>
                <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg hover:border-blue-400">
                    <p>Product 1</p>
                </div>            
            </a>
            <a class="" href="{{ route('listing-page-item') }}" wire:navigate>
                <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg hover:border-blue-400">
                    <p>Product 1</p>
                </div>            
            </a>
            <a class="" href="{{ route('listing-page-item') }}" wire:navigate>
                <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg hover:border-blue-400">
                    <p>Product 1</p>
                </div>            
            </a>
            <a class="" href="{{ route('listing-page-item') }}" wire:navigate>
                <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg hover:border-blue-400">
                    <p>Product 1</p>
                </div>            
            </a>
            <a class="" href="{{ route('listing-page-item') }}" wire:navigate>
                <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg hover:border-blue-400">
                    <p>Product 1</p>
                </div>            
            </a>
            <a class="" href="{{ route('listing-page-item') }}" wire:navigate>
                <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg hover:border-blue-400">
                    <p>Product 1</p>
                </div>            
            </a>
            <a class="" href="{{ route('listing-page-item') }}" wire:navigate>
                <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg hover:border-blue-400">
                    <p>Product 1</p>
                </div>            
            </a>
        </div>
    </div>
</div>
