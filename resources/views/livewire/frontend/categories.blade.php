<?php

use App\Models\Category;
use Livewire\Volt\Component;

new class extends Component {
    
    public $sub_categories = [];
    public $selectedCategoryId = null;

    public function mount()
    {
        $categories = $this->loadCategories();
        if ($categories->isNotEmpty()) {
            $this->selectedCategoryId = $categories->last()->id;
            $this->sub_categories = $categories->last()->subCategories->toArray();
        }
    }

    public function with(): array
    {
        return [
            'categories' => $this->loadCategories(),
        ];
    }

    public function loadCategories()
    {
        return Category::withCount('subCategories')
            ->orderBy('sub_categories_count', 'asc')
            ->get();
    }

    public function selectedButton($categoryModel)
    {
        $this->selectedCategoryId = $categoryModel['id'];
        $this->sub_categories = $categoryModel['sub_categories'] ;
    }
}; ?>

<div>

    <div class="hidden column-wrapper md:block">
        @foreach ($categories as $category)
            <div class="p-4 transition-shadow duration-300 rounded-lg avoid-break" wire:key="{{ 'category-listing-'.$category->id }}">
                <a href="/listing-page?category_id={{ $category->id }}" wire:navigate>
                    <h3 class="text-xl font-bold text-blue-600 hover:text-blue-800">{{ $category->name }}</h3>
                </a>
                <ul class="text-blue-500 pl-5 mt-4 space-y-2 list-disc underline ">
                    @foreach($category->subCategories as $sub_category)
                        <li wire:key="{{ 'sub-categ-listing-'.$sub_category->id }}">
                            <a href="{{ "listing-page?sc_names[0]=$category->id-$sub_category->name" }}" class="text-blue-500 hover:text-blue-800" wire:navigate>
                                {{ $sub_category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>

    <div class="flex flex-wrap items-center justify-center gap-3 py-2 mt-32 md:hidden">
        @foreach ($categories as $category)
            <div class="" wire:key="{{ 'category-listing-mobile-'.$category->id }}">
                <button 
                    class="py-2 w-[8rem] shadow-md font-bold rounded-lg 
                    {{ $selectedCategoryId === $category->id ? 'bg-[#2171a7] text-white' : '' }}"
                    wire:click="selectedButton({{ $category }})"
                >
                    {{ $category->name }}
                </button>
            </div>
        @endforeach
    </div>
    <div class="mt-6 ml-6 italic text-gray-500 md:hidden">
        <p class="text-blue-600">Select Subcategories:</p>
    </div>
    <div class="flex items-center justify-center max-h-[20rem] mt-4 mb-20 overflow-y-auto md:hidden">
        <ul class="grid items-center justify-center grid-cols-2 pl-5 space-y-2 underline ">
            @foreach($sub_categories as $sub_category)
                <li wire:key="{{ 'sub-categ-listing-mobile-'.$sub_category['id'] }}">
                    <a href="{{ "listing-page?sc_names[0]=" .$sub_category['category_id']. "-" .$sub_category['name'] }}" class="text-slate-500 hover:text-blue-800" wire:navigate>
                        {{ $sub_category['name'] }}   
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>


