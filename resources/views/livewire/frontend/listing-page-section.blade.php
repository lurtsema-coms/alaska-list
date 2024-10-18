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
    #[Url] 
    public $category_id;
    #[Url] 
    public $location;
    public $price_range;
    public $sort_by = "";
    #[Url] 
    public $page = 1;
    public $pagination = 5;
    
    public function mount()
    {
        $category_id = $this->category_id;
        $filter_sc_names = [];
        
        if($category_id) {
            $sub_category = Category::with('subCategories')->find($category_id);
            
            foreach($sub_category->subCategories as $item){                
                $filter_sc_names[] = "$item->category_id-$item->name";
            }

            $this->sc_names = $filter_sc_names;
            // dd($filter_sc_names);
        }
    }

    public function updated()
    {
        $this->dispatch('load-time-ago');
    }

    public function updatedPage($page)
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

                        $searchQuery->orWhereHas('subCategory', function ($subQuery) {
                            $subQuery->where('name', 'like', '%' . $this->search . '%');
                        });
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
            $category_ids = [];
            $names = [];
            
            foreach($this->sc_names as $item) {
                $parts = explode('-', $item, 2);
                $category_ids[] = $parts[0];
                $names[] = $parts[1];
            }

            $query->where(function ($query) use ($category_ids, $names) {
                $query->whereHas('subCategory', function ($subQuery) use ($category_ids, $names) {
                    $subQuery->whereIn('name', $names)
                        ->whereIn('category_id', $category_ids);
                });

                // Filter by category ID
            });
        }
        
        return $query->paginate($this->pagination);
    }

    public function oneCategory($sub_category)
    {
        $this->dispatch('load-time-ago');
        // Toggle
        if (in_array($sub_category, $this->sc_names)) {
            $this->sc_names = array_diff($this->sc_names, [$sub_category]);
        } else {
            $this->sc_names = [$sub_category]; 
        }
    }


    public function dispatchTimeAgo(){
        // $this->dispatch('load-time-ago');
        $this->resetData(['sc_names', 'price_range', 'sort_by', 'location', 'category_id']);
    }

    public function resetData($data)
    {
        $this->reset($data);
    }
}; ?>

<div class="relative space-y-8">
    <div class="relative bg-search-gradient h-80">
        <div class="absolute w-full h-full bg-top bg-cover" style="background-image: url('{{ asset('frontend/alaska-bg.jpg') }}'); background-position: 30% 60%;">
        </div>
        <div class="absolute inset-0 z-20 w-full h-full bg-search-gradient opacity-70">
        </div>
    </div>
    <div class="relative z-30 px-5 mx-auto max-w-120 -top-28 sm:-top-20">
        {{-- Filter Categories responsive --}}
        {{-- <div class="p-4 mx-auto bg-white border shadow-sm max-w-8xl rounded-2xl xl:hidden">
            <div class="space-y-4 overflow-y-auto max-h-80 sm:p-4">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-medium text-gray-700">Filter by categories</h2>
                    <button class="text-sm text-gray-600 hover:text-gray-900 hover:underline focus:outline-none" type="button" wire:click="dispatchTimeAgo">Reset</button>
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">
                    @foreach ($categories as $category)
                        <div class="p-4 bg-gray-100 rounded-lg shadow-md" wire:key="{{ 'category-listing-'.$category->id }}">
                            <h3 class="mb-2 text-lg font-medium text-gray-700">{{ $category->name }}</h3>
                            <div class="grid gap-2 md:grid-cols-2">
                                @foreach($category->subCategories as $sub_category)
                                    <a class="category-anchor" wire:click="oneCategory('{{ $category->id.'-'.$sub_category->name }}')">
                                        <label class="flex items-center cursor-pointer min-w-fit" wire:key="{{ 'sub-categ-listing-'.$sub_category->id }}">
                                            <input type="checkbox"
                                                class="hidden w-5 h-5"
                                                wire:model.change="sc_names"
                                                value="{{ $category->id.'-'.$sub_category->name }}"
                                            >
                                            <span class="text-gray-500 {{ in_array($category->id.'-'.$sub_category->name, $sc_names) ? "bg-white shadow-sm p-2 border rounded-lg border-[#285680] text-[#285680]" : '' }}">{{ $sub_category->name }}</span>
                                        </label>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div> --}}

        <div class="px-2 sm:px-10 bg-gray-50 rounded-2xl">
            <div class="flex flex-col justify-between mt-12 xl:flex-row">
                <div class="flex flex-wrap gap-4 mt-8">
                    <div>
                        <h3 class="mb-2">Location</h3>
                        <select name="" id="" class="h-12 border border-gray-300 rounded-lg" wire:model.change="location">
                            <option value="" selected>All Location</option>
                            @foreach (config('global.us_states') as  $location)
                                <option value="{{ $location }}" wire:key="{{ $location }}">{{ $location }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <h3 class="mb-2">Sort By:</h3>
                        <select name="" id="" class="h-12 border border-gray-300 rounded-lg" wire:model.change="sort_by">
                            <option value="">Default</option>
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
                <div class="flex justify-start flex-1 gap-4 xl:justify-end">
                    <div>
                        <h3 class="mb-2 opacity-0">Paginate</h3>
                        <select class="h-12 border border-gray-300 rounded-lg" name="" id="" wire:model.change="pagination">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>               
                    <div class="relative w-full overflow-hidden max-w-60 md:max-w-96 ">
                        <h3 class="mb-2 opacity-0">Search</h3>
                        <div class="relative w-full">
                            <input
                                class="w-full h-12 px-4 pr-10 border rounded-lg text-md border-slate-300 focus:outline-none focus:ring-0 focus:border-blue-600"
                                type="text"
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

            </div>
            
            {{-- Small Screen Size filter categories --}}
            <div class="w-full mx-auto mt-4 lg:hidden">
                <div class="space-y-4 max-h-96">
                    <div class="p-8 bg-white border rounded-lg shadow-sm border-slate-300"> 
                        @if ($sc_names)
                            <div class="inline-block px-4 py-2 mb-5 bg-white border border-gray-300 rounded-lg shadow-sm">
                                <div class="flex items-center gap-2">
                                    <span>{{ substr($sc_names[0], strpos($sc_names[0], '-') + 1) }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-red-600 cursor-pointer size-5 hover:opacity-70"
                                        wire:click="oneCategory('{{ $sc_names[0] }}')"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </div>
                            </div>
                        @endif                               
                        <div class="flex flex-col gap-1 mb-4">
                            <h2 class="text-lg font-medium text-[#285680]">Filter by categories</h2>
                        </div>

                        <div class="grid gap-6 overflow-y-auto sm:grid-cols-2 md:grid-cols-3 max-h-40">
                            @foreach ($categories as $category)
                                <div class="" wire:key="{{ 'category-listing-'.$category->id }}">
                                    <h3 class="mb-2 text-lg font-medium text-gray-700">{{ $category->name }}</h3>
                                    <div class="grid grid-cols-1 gap-2">
                                        @foreach($category->subCategories as $sub_category)
                                            <a class="category-anchor" wire:click="oneCategory('{{ $category->id.'-'.$sub_category->name }}')">
                                                <label class="flex items-center cursor-pointer min-w-fit" wire:key="{{ 'sub-categ-listing-'.$sub_category->id }}">
                                                    <input type="checkbox"
                                                        class="hidden w-5 h-5"
                                                        wire:model.change="sc_names"
                                                        value="{{ $category->id.'-'.$sub_category->name }}"
                                                    >
                                                    <span class="text-gray-500 {{ in_array($category->id.'-'.$sub_category->name, $sc_names) ? "bg-white shadow-sm p-2 border rounded-lg border-[#285680] !text-[#285680]" : '' }}">{{ $sub_category->name }}</span>
                                                </label>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="lg:mt-0" id="list-section">
                <div class="flex flex-col gap-8 mt-11 md:flex-row">
                    <div class="hidden w-full mx-auto max-w-72 lg:block">
                        <div class="sticky space-y-4 top-28">
                            <div class="p-8 bg-white border shadow-sm border-slate-300 rounded-2xl"> 
                                @if ($sc_names)
                                    <div class="inline-block px-4 py-2 mb-5 bg-white border border-gray-300 rounded-lg shadow-sm">
                                        <div class="flex items-center gap-2">
                                            <span>{{ substr($sc_names[0], strpos($sc_names[0], '-') + 1) }}</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-red-600 cursor-pointer size-5 hover:opacity-70"
                                                wire:click="oneCategory('{{ $sc_names[0] }}')"
                                            >
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                        </div>
                                    </div>
                                @endif                               
                                <div class="flex flex-col gap-1 mb-4">
                                    <h2 class="text-lg font-medium text-[#285680]">Filter by categories</h2>
                                </div>
    
                                <div class="grid grid-cols-1 gap-6 ">
                                    @foreach ($categories as $category)
                                        <div class="" wire:key="{{ 'category-listing-'.$category->id }}">
                                            <h3 class="mb-2 text-lg font-medium text-gray-700">{{ $category->name }}</h3>
                                            <div class="grid grid-cols-1 gap-2">
                                                @foreach($category->subCategories as $sub_category)
                                                    <a class="category-anchor" wire:click="oneCategory('{{ $category->id.'-'.$sub_category->name }}')">
                                                        <label class="flex items-center cursor-pointer min-w-fit" wire:key="{{ 'sub-categ-listing-'.$sub_category->id }}">
                                                            <input type="checkbox"
                                                                class="hidden w-5 h-5"
                                                                wire:model.change="sc_names"
                                                                value="{{ $category->id.'-'.$sub_category->name }}"
                                                            >
                                                            <span class="text-gray-500 {{ in_array($category->id.'-'.$sub_category->name, $sc_names) ? "bg-white shadow-sm p-2 border rounded-lg border-[#285680] !text-[#285680]" : '' }}">{{ $sub_category->name }}</span>
                                                        </label>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-2 break-1757:grid-cols-3">
                            @if($products->isEmpty())
                                <p>😔 No uploads yet!</p>
                            @else
                                @foreach($products as $product)
                                    @if ($product->ActiveSpecialBoostCount)
                                        <a href="{{ route('listing-page-item', $product->id) }}" class="block mb-8 overflow-hidden transition duration-300 bg-white border shadow-lg border-yellow-50 rounded-2xl hover:border-yellow-600 hover:no-underline" wire:navigate wire:key="{{ 'product-item-listing-'.$product->id }}">
                                            <div class="flex flex-col h-full">
                                                @php
                                                    $images = explode(',', $product->file_path);
                                                    $firstImage = trim($images[0]);
                                                @endphp 
                
                                                <div class="relative">
                                                    <img class="object-cover w-full h-56 rounded-t-xl" src="{{ asset($firstImage) }}" alt="{{ $product->name }}">
                                                    <div class="absolute px-3 py-1 text-xs font-bold text-white bg-yellow-500 rounded-full top-4 left-4">Boosted</div>
                                                    <div class="absolute px-3 py-1 bg-white rounded-full shadow-lg bottom-4 left-4">
                                                        <p class="text-xl font-medium text-gray-600">
                                                            ${{ number_format($product->price, fmod($product->price, 1) !== 0.00 ? 2 : 0) }}
                                                        </p>
                                                    </div>
                                                </div>
                                                
                                                <div class="flex-1 p-6 bg-gradient-to-b from-yellow-50 to-white">
                                                    <p class="text-lg font-semibold text-gray-800">{{ \Illuminate\Support\Str::words($product->name, 15, '...') }}</p>
                                                    <p class="my-2 text-sm text-gray-600">{{ Str::limit($product->description, 150) }}</p>
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
                                                        <p class="text-gray-600">
                                                            📍 {{ $product->location ? $product->location : '' }}
                                                        </p>
                                                    </div>
                                                    <button class="px-4 py-2 font-bold text-white bg-yellow-500 rounded-xl hover:bg-yellow-600">
                                                        View Details
                                                    </button>
                                                </div>
                                            </div>
                                        </a>
                                        @else
                                            <a href="{{ route('listing-page-item', $product->id) }}" class="block mb-8 overflow-hidden transition duration-300 bg-white border shadow-lg rounded-2xl hover:border-blue-400 hover:no-underline" wire:navigate wire:key="{{ 'product-item-listing-'.$product->id }}">
                                                <div class="flex flex-col h-full">
                                                    @php
                                                        $images = explode(',', $product->file_path);
                                                        $firstImage = trim($images[0]);
                                                    @endphp 
                    
                                                    <div class="relative">
                                                        <img class="object-cover w-full h-56 rounded-t-xl" src="{{ asset($firstImage) }}" alt="{{ $product->name }}">
                                                        <div class="absolute px-3 py-1 bg-white rounded-full shadow-lg bottom-4 left-4">
                                                            <p class="text-xl font-medium text-gray-600">
                                                                ${{ number_format($product->price, fmod($product->price, 1) !== 0.00 ? 2 : 0) }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="flex-1 p-6 to-white">
                                                        <p class="text-lg font-semibold text-gray-800">{{ \Illuminate\Support\Str::words($product->name, 15, '...') }}</p>
                                                        <p class="my-2 text-sm text-gray-600">{{ Str::limit($product->description, 150) }}</p>
                                                        <div class="flex items-center my-4 space-x-2">
                                                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $product->subCategory->name }}</span>
                                                        </div>
                                                        @if ($product->qty)
                                                            <p class="text-sm text-gray-600">Available: <span class="text-gray-500">{{ $product->qty }}</span></p>
                                                        @endif
                                                    </div>
                                                    
                                                    <div class="p-6 border-t rounded-b-xl">
                                                        <div class="flex flex-wrap items-center justify-between gap-4 mb-4">
                                                            <p class="font-bold text-green-500 timeago text-md" datetime="{{ $product->created_at }} {{ config('app.timezone') }}"></p>
                                                            <p class="text-gray-600">
                                                                📍 {{ $product->location ? $product->location : '' }}
                                                            </p>
                                                        </div>
                                                        <button class="px-4 py-2 font-bold text-white bg-blue-500 rounded-xl hover:bg-blue-600">
                                                            View Details
                                                        </button>
                                                    </div>
                                                </div>
                                            </a>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        {{ $products->links(data: ['scrollTo' => '#list-section']) }}
                        <div class="mt-4 2xl:hidden">
                            <livewire:frontend.sidebar-sponsor>
                        </div>   
                    </div>
                    <div class="hidden 2xl:block">
                        <livewire:frontend.sidebar-sponsor>
                    </div>           
                </div>
            </div>
        </div>
    </div>
</div>

@script
<script>
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

    $(document).ready(function() {
        $('.category-anchor').on('click', function(event) {

            // Get the target element by ID
            const targetElement = document.getElementById('list-section');
            if (targetElement) {
                var topOffset = 160; // Adjust the offset as needed
                
                // Calculate the element's position relative to the top of the page
                var elementPosition = targetElement.getBoundingClientRect().top + window.pageYOffset;
                
                // Scroll to the calculated position with the offset
                window.scrollTo({
                    top: elementPosition - topOffset,
                    behavior: 'smooth'
                });
            } else {
                console.error('Element with id "list-section" not found');
            }
        });
    });


</script>
@endscript