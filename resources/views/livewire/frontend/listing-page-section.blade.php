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
    public $sc_names = [];
    #[Url] 
    public $search;
    public $pagination = 10;

    public function updated()
    {
        $this->dispatch('load-time-ago');
    }

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
                // Apply the status filter
                $query->where('status', 'ACTIVE');
                // Apply the search filter
                $query->where(function ($searchQuery) {
                    $searchQuery
                        ->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                        ->orWhere('price', 'like', '%' . $this->search . '%');
                });
            })
            ->orderByRaw('
                CASE
                    WHEN created_at >= NOW() - INTERVAL 7 DAY THEN 1
                    ELSE RAND()
                END,
                created_at DESC
            ');

        // Apply sub-category filter if there are selected sub-categories
        if (!empty($this->sc_names)) {
            $query->whereHas('subCategory', function ($subQuery) {
                $subQuery->whereIn('name', $this->sc_names);
            });
        } else {
            // Handle cases where sub-category filter is not applied
            $query->whereHas('subCategory', function ($subQuery) {
                $subQuery->orWhere('name', 'like', '%' . $this->search . '%');
            });
        }

        return $query->paginate($this->pagination);
    }

    public function dispatchTimeAgo(){
        $this->dispatch('load-time-ago');
        $this->resetData(['sc_names']);
    }

    public function resetData($data)
    {
        $this->reset($data);
    }
}; ?>

<div class="space-y-8">
    <div>
    <h2 class="text-4xl font-bold text-gray-800">Listing Page</h2>
    </div>
    <div class="space-y-10">
        <livewire:frontend.sponsored-listing>
        <div class="p-4 mx-auto space-y-4 overflow-y-auto bg-white border max-h-80 rounded-2xl">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-medium text-gray-700">Filter by categories</h2>
                <button class="text-sm text-gray-600 hover:text-gray-900 hover:underline focus:outline-none" type="button" wire:click="dispatchTimeAgo">Reset</button>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($categories as $category)
                    <div class="p-4 bg-gray-100 rounded-lg shadow-md" wire:key="{{ 'category-listing-'.$category->id }}">
                        <h3 class="mb-2 text-lg font-medium text-gray-700">{{ $category->name }}</h3>
                        <div class="flex flex-wrap gap-2">
                        @foreach($category->subCategories as $sub_category)
                            <label class="inline-flex items-center space-x-2 cursor-pointer" wire:key="{{ 'sub-categ-listing-'.$sub_category->id }}">
                                <input type="checkbox"
                                    class="w-5 h-5 text-blue-600 "
                                    wire:model.change="sc_names"
                                    value="{{ $sub_category->name }}">
                                <span class="text-gray-600">{{ $sub_category->name }}</span>
                            </label>
                        @endforeach

                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex flex-wrap items-center justify-end gap-4">
            <div>
                <select class="h-12 border border-gray-300 rounded-lg" name="" id="" wire:model.change="pagination">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="relative w-full p-1 overflow-hidden max-w-60 md:max-w-96 ">
                <div class="relative w-full">
                    <input
                        class="h-12 text-md w-full px-4 pr-10 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]"
                        type="seaerch"
                        placeholder="Search..."
                        wire:model.live.debounce.200ms="search"
                        required>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>                    
                    </div>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 2xl:grid-cols-4">
            @if($products->isEmpty())
                <p>No products to show.</p>
            @else
                @foreach($products as $product)
                    <a href="{{ route('listing-page-item', $product->id) }}" class="block mb-8 hover:no-underline" wire:navigate wire:key="{{ 'product-item-listing-'.$product->id }}">
                        <div class="overflow-hidden transition duration-300 bg-white border border-gray-200 shadow-md rounded-2xl hover:border-blue-400">
                            @php
                                $images = explode(',', $product->file_path);
                                $firstImage = trim($images[0]);
                            @endphp 

                            <img class="object-cover w-full h-56" src="{{ asset($firstImage) }}" alt="{{ $product->name }}">
                            <div class="p-6">
                                <p class="mb-4 text-lg font-semibold text-gray-800">{{ $product->name }}</p>
                                <p class="mb-4 text-gray-600">{{ Str::limit($product->description, 200) }}</p>
                                <p class="mb-4 font-semibold text-gray-800">${{ $product->price }}</p>
                                <div class="flex items-center mt-4 mb-4 space-x-2">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $product->subCategory->name }}</span>
                                </div>
                                <p class="text-sm text-gray-500">Available: <span class="text-gray-500">{{ $product->qty }}</span></p>
                            </div>
                            <div class="p-6 border-t border-gray-200">
                                <p class="mb-4 font-bold text-green-500 timeago text-md" datetime="{{ $product->created_at }} {{ config('app.timezone') }}"></p>
                                <button class="px-4 py-2 font-bold text-white rounded bg-sky-600 hover:bg-blue-700">
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

@script
<script >
    let timeagoInstance;
    document.addEventListener('livewire:navigated', () => {

        if(timeagoInstance){
            timeagoInstance = undefined;
        }

        function initializeTimeago() {
            const timeagoNodes = document.querySelectorAll('.timeago');
            if (timeagoNodes.length) {
                timeagoInstance = timeago.render(timeagoNodes);
            }
        }

        Livewire.on('load-time-ago', function(){
            setTimeout(() => {
                initializeTimeago();
            }, 100);
        });

        initializeTimeago();

    });

    document.addEventListener('livewire:navigating', () => {
        if (timeagoInstance) {
            chart = undefined;
        }
    });
</script>
@endscript