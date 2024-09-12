<?php

use App\Models\Category;
use Livewire\Volt\Component;

new class extends Component {
    
    public $sub_categories = [];

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
        $this->sub_categories = $categoryModel['sub_categories'] ;
    }
}; ?>

<div class="">
    <div class="column-wrapper hidden md:block">
        @foreach ($categories as $category)
            <div class="rounded-lg p-4  transition-shadow duration-300  avoid-break" wire:key="{{ 'category-listing-'.$category->id }}">
                <a href="/listing-page?category_id={{ $category->id }}" wire:navigate>
                    <h3 class="text-xl font-bold text-blue-600 hover:text-blue-800">{{ $category->name }}</h3>
                </a>
                <ul class="mt-4 space-y-2 list-disc pl-5 font-bold">
                    @foreach($category->subCategories as $sub_category)
                        <li wire:key="{{ 'sub-categ-listing-'.$sub_category->id }}">
                            <a href="{{ "listing-page?sc_names[0]=$category->id-$sub_category->name" }}" class="text-gray-600 hover:text-blue-800" wire:navigate>
                                {{ $sub_category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>

    <div class="flex mt-36 gap-1 flex-wrap md:hidden">
        @foreach ($categories as $category)
            <div class="" wire:key="{{ 'category-listing-mobile-'.$category->id }}">
                <button wire:click="selectedButton({{$category}})">{{$category->name}}</button>
            </div>
        @endforeach
    </div>
    <div class="md:hidden">
        <ul class="mt-4 space-y-2 list-disc pl-5 font-bold">
            @foreach($sub_categories as $sub_category)
                <li wire:key="{{ 'sub-categ-listing-mobile-'.$sub_category['id'] }}">
                    <a href="{{ "listing-page?sc_names[0]=" .$sub_category['category_id']. "-" .$sub_category['name'] }}" class="text-gray-600 hover:text-blue-800" wire:navigate>
                        {{ $sub_category['name'] }}   
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>


