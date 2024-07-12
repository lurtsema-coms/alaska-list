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
                <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg space-y-4 hover:border-blue-400">
                    <img class="w-full object-cover cursor-pointer" src="https://picsum.photos/seed/1/576/300" alt="Image 1">
                    <p class="text-lg font-semibold">Product 1</p>
                    <div class="space-y-2">
                        <p class="text-gray-700">This is a brief description of Product 1. It highlights the key features and benefits of the product.</p>
                        <p class="text-green-600 font-semibold">$19.99</p>
                        <div class="flex items-center space-x-2">
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Electronics</span>
                        </div>
                        <p class="text-gray-500 text-sm">In Stock: <span class="text-gray-700 font-medium">25</span></p>
                    </div>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        View Details
                    </button>
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
