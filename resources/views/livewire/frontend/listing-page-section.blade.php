<?php

use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\Category;
use App\Models\Product;
use Livewire\Volt\Component;

new class extends Component {

    use WithPagination;

    #[Url] 
    public $sub_category_name = '';
    public $search;

    public function with(): array
    {
        return [
            'categories' => $this->loadCategories(),
            'products' => $this->loadProducts(),
        ];
    }

    public function loadCategories()
    {
        return Category::with('subCategories')
            ->get();
    }

    public function loadProducts()
    {
        $query = Product::with('subCategory')
            ->where(function ($query) {
                $query->orderByRaw('RAND('.mt_rand().')');
            })
            ->whereRaw('DATEDIFF(NOW(), created_at) > 7')
            ->orWhereHas('subCategory', function ($subQuery) {
                $subQuery->where('name', 'like', '%' . $this->sub_category_name . '%');
            })
            ->paginate(15);

        return $query;
    }



    function resetData($data)
    {
        $this->reset($data);
    }
}; ?>

<div class="space-y-8">
    @dump($search)
    <div>
    <h2 class=" text-4xl text-gray-800">Listing Page</h2>
    </div>
    <div class="space-y-10">
        <livewire:frontend.sponsored-listing>
        <div class="max-h-80 p-4 bg-white mx-auto shadow-md rounded-xl space-y-4 overflow-y-auto">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-medium text-gray-700">Sort by categories</h2>
                <button class="text-sm text-gray-600 hover:text-gray-900 hover:underline focus:outline-none" type="button" wire:click="resetData(['sub_category_name'])">Reset</button>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($categories as $category)
                    <div class="p-4 bg-gray-100 rounded-lg shadow-md">
                        <h3 class="text-lg font-medium text-gray-700 mb-2">{{ $category->name }}</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($category->subCategories as $sub_category)
                                <label class="inline-flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" value="{{ $sub_category->name }}" class="form-radio text-blue-600 h-5 w-5"  wire:model.change="sub_category_name">
                                    <span class="text-gray-600">{{ $sub_category->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 2xl:grid-cols-4 gap-8">
            @if($products->isEmpty())
                <p>No products to show.</p>
            @else
                @foreach($products as $product)
                    <a href="{{ route('listing-page-item', $product->id) }}" class="block mb-6 hover:no-underline">
                        <div class="bg-white border border-gray-200 shadow-md rounded-lg overflow-hidden transition duration-300 hover:border-blue-400">
                            @php
                                $images = explode(',', $product->file_name);
                                $firstImage = trim($images[0]);
                            @endphp

                            <img class="h-56 w-full object-cover" src="{{ asset('storage/photos/listing-item/'.$firstImage) }}" alt="{{ $product->name }}">
                            <div class="p-4">
                                <p class="text-lg font-semibold text-gray-800 mb-2">{{ $product->name }}</p>
                                <p class="text-gray-700 mb-2">{{ $product->description }}</p>
                                <p class="text-green-600 font-semibold">${{ $product->price }}</p>
                                <div class="flex items-center space-x-2 mt-2">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $product->subCategory->name }}</span>
                                </div>
                                <p class="text-gray-500 text-sm mt-2">Available: <span class="text-gray-700 font-medium">{{ $product->qty }}</span></p>
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
        {{ $products->links() }}
    </div>
</div>
