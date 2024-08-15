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
    public $location;
    public $price_range;
    public $sort_by = "";
    public $pagination = 3;

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
        return Category::withCount('subCategories')
            ->orderBy('sub_categories_count', 'asc')
            ->get();
    }

    public function loadProducts()
    {
        $today = now()->toDateTimeString();

        $query = Product::with([
                    'subCategory'
                ])
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
            });

        if(!empty($this->location)) {
            $query->where('location', $this->location);
        }

        // Apply the price range filter
        if (!empty($this->price_range)) {
            $priceRange = explode('-', $this->price_range);

            if (count($priceRange) === 1) {
                // If a single value is entered
                $minPrice = (float)$priceRange[0];
                
                if ($this->sort_by == 'low') {
                    // When sorting from low to high, filter for prices less than or equal to the entered value
                    $query->where('price', '<=', $minPrice);
                } else {
                    // When sorting from high to low, filter for prices greater than or equal to the entered value
                    $query->where('price', '>=', $minPrice);
                }
            } elseif (count($priceRange) === 2) {
                // If two values are entered, use them as min and max price
                $minPrice = (float)$priceRange[0];
                $maxPrice = (float)$priceRange[1];
                $query->whereBetween('price', [$minPrice, $maxPrice]);
            } else {
                // Default case, don't apply any filter
            }
        }

        // Apply sorting by price if set
        if ($this->sort_by == 'low') {
            $query->orderBy('price', 'asc');
        } elseif ($this->sort_by == 'high') {
            $query->orderBy('price', 'desc');
        } else {
            // Apply default sorting logic
            $query->orderByRaw('
                CASE
                    WHEN EXISTS (
                        SELECT 1 FROM special_boosts
                        WHERE special_boosts.product_id = products.id
                        AND special_boosts.from_date <= ?
                        AND special_boosts.to_date >= ?
                    ) THEN 1
                    ELSE 0
                END DESC,
                CASE
                    WHEN EXISTS (
                        SELECT 1 FROM special_boosts
                        WHERE special_boosts.product_id = products.id
                        AND special_boosts.from_date <= ?
                        AND special_boosts.to_date >= ?
                    ) THEN RAND()
                    ELSE created_at
                END DESC
            ', [$today, $today, $today, $today]);
        }

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
        $this->resetData(['sc_names', 'price_range', 'sort_by', 'location']);
    }

    public function resetData($data)
    {
        $this->reset($data);
    }
}; ?>

<div class="relative space-y-8">
    <div class="">
        <h2 class="text-4xl font-bold text-white">Listing Page</h2>
    </div>
    <div class="space-y-10">
        <div class="p-4 mx-auto bg-white border max-w-8xl rounded-2xl">
            <div class="p-4 space-y-4 overflow-y-auto max-h-80 ">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-medium text-gray-700">Filter by categories</h2>
                    <button class="text-sm text-gray-600 hover:text-gray-900 hover:underline focus:outline-none" type="button" wire:click="dispatchTimeAgo">Reset</button>
                </div>

                <div class="flex flex-wrap gap-6">
                    <div>
                        <h3 class="mb-2">Location</h3>
                        <select name="" id="" class="h-12 border border-gray-300 rounded-lg" wire:model.change="location">
                            <option value="" selected>All Location</option>
                            @foreach (config('global.us_states') as $key => $location)
                                <option value="{{ $key }}" wire:key="{{ $location }}-{{ $key }}">{{ $location }} ({{ $key }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <h3 class="mb-2">Sort By:</h3>
                        <select name="" id="" class="h-12 border border-gray-300 rounded-lg" wire:model.change="sort_by">
                            <option value="" disabled>Select Sorting</option>
                            <option value="low">Price low to high</option>
                            <option value="high">Price high to low</option>
                        </select>
                    </div>
                    <div>
                        <h3 class="mb-2">Price Range:</h3>
                        <input name="" id="" class="h-12 border border-gray-300 rounded-lg" placeholder="e.g. 100-500"
                            wire:model.live.debounce.500ms="price_range"
                        />
                    </div>
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
                        class="w-full h-12 px-4 pr-10 border rounded-lg text-md border-slate-300"
                        type="seaerch"
                        placeholder="Search..."
                        wire:model.live.debounce.500ms="search"
                        required>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>                    
                    </div>
                </div>
            </div>
        </div>
        
        <div class="flex flex-col gap-8 md:flex-row">
            <div class="flex-1">
                <div class="grid grid-cols-1 gap-8 xl:grid-cols-2 2xl:grid-cols-3">
                    @if($products->isEmpty())
                        <p>No products to show.</p>
                    @else
                        @foreach($products as $product)
                            @if ($product->ActiveSpecialBoostCount)
                                <a href="{{ route('listing-page-item', $product->id) }}" class="block mb-8 overflow-hidden transition duration-300 bg-white border-4 shadow-lg border-yellow-50 rounded-2xl hover:border-yellow-200 hover:no-underline" wire:navigate wire:key="{{ 'product-item-listing-'.$product->id }}">
                                    <div class="flex flex-col h-full">
                                        @php
                                            $images = explode(',', $product->file_path);
                                            $firstImage = trim($images[0]);
                                        @endphp 
        
                                        <div class="relative">
                                            <img class="object-cover w-full h-56 rounded-t-xl" src="{{ asset($firstImage) }}" alt="{{ $product->name }}">
                                            <div class="absolute px-3 py-1 text-xs font-bold text-white bg-yellow-500 rounded-full top-4 left-4">Boosted</div>
                                        </div>
                                        
                                        <div class="flex-1 p-6 bg-gradient-to-b from-yellow-50 to-white">
                                            <p class="mb-2 text-lg font-semibold text-gray-800">{{ $product->name }}</p>
                                            <p class="mb-2 text-sm text-gray-600">{{ Str::limit($product->description, 150) }}</p>
                                            @if ($product->price)
                                                <p class="mb-4 text-lg font-semibold text-yellow-600">${{ $product->price }}</p>
                                            @endif
                                            <div class="flex items-center my-4 space-x-2">
                                                <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $product->subCategory->name }}</span>
                                            </div>
                                            @if ($product->qty)
                                                <p class="text-sm text-gray-600">Available: <span class="text-gray-500">{{ $product->qty }}</span></p>
                                            @endif
                                        </div>
                                        
                                        <div class="p-6 border-t border-yellow-200 bg-yellow-50 rounded-b-xl">
                                            <div class="flex flex-wrap items-center justify-between gap-4 mb-4">
                                                <p class="font-bold text-green-500 timeago text-md" datetime="{{ $product->created_at }} {{ config('app.timezone') }}"></p>
                                                <p class="text-gray-600">{{ $product->location ? config('global.us_states')[$product->location] : '' }}</p>
                                            </div>
                                            <button class="px-4 py-2 font-bold text-white bg-yellow-500 rounded-xl hover:bg-yellow-600">
                                                View Details
                                            </button>
                                        </div>
                                    </div>
                                </a>
                                @else
                                    <a href="{{ route('listing-page-item', $product->id) }}" class="block mb-8 overflow-hidden transition duration-300 bg-white border border-gray-200 shadow-md rounded-2xl hover:border-blue-400 hover:no-underline" wire:navigate wire:key="{{ 'product-item-listing-'.$product->id }}">
                                        <div class="flex flex-col h-full">
                                            @php
                                                $images = explode(',', $product->file_path);
                                                $firstImage = trim($images[0]);
                                            @endphp 
        
                                            <img class="object-cover w-full h-56" src="{{ asset($firstImage) }}" alt="{{ $product->name }}">
                                            <div class="flex-1 p-6">
                                                <p class="mb-4 text-lg font-semibold text-gray-800">{{ $product->name }}</p>
                                                <p class="mb-4 text-sm text-gray-600">{{ Str::limit($product->description, 150) }}</p>
                                                @if ($product->price)
                                                    <p class="mb-4 font-semibold text-blue-600">${{ $product->price }}</p>
                                                @endif
                                                <div class="flex items-center my-4 space-x-2">
                                                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $product->subCategory->name }}</span>
                                                </div>
                                                @if ($product->qty)
                                                    <p class="text-sm text-gray-600">Available: <span class="text-gray-500">{{ $product->qty }}</span></p>
                                                @endif
                                            </div>
                                            <div class="p-6 border-t border-gray-200">
                                                <div class="flex flex-wrap items-center justify-between gap-4 mb-4">
                                                    <p class="font-bold text-green-500 timeago text-md" datetime="{{ $product->created_at }} {{ config('app.timezone') }}"></p>
                                                    <p class="text-gray-600">{{ $product->location ? config('global.us_states')[$product->location] : '' }}</p>
                                                </div>
                                                <button class="px-4 py-2 font-bold text-white rounded-xl bg-sky-600 hover:bg-blue-700">
                                                    View Details
                                                </button>
                                            </div>
                                        </div>
                                    </a>
                            @endif
                        @endforeach
                    @endif
                </div>
                {{ $products->links() }}
            </div>
            <div>
                <livewire:frontend.sidebar-sponsor>
            </div>           
        </div>
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