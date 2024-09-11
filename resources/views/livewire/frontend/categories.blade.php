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
        return Category::withCount('subCategories')
            ->orderBy('sub_categories_count', 'asc')
            ->get();
    }
}; ?>

<div>
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">
        @foreach ($categories as $category)
            <div class="p-4 bg-gray-100 rounded-lg shadow-md" wire:key="{{ 'category-listing-'.$category->id }}">
                <a href="/listing-page?category_id={{ $category->id }}" wire:navigate>
                    <h3 class="inline-block mb-2 text-lg font-medium text-gray-700">{{ $category->name }}</h3>
                </a>
                <div class="grid grid-cols-2 gap-2">
                    @foreach($category->subCategories as $sub_category)
                        <label class="flex items-center space-x-2 cursor-pointer min-w-fit" wire:key="{{ 'sub-categ-listing-'.$sub_category->id }}">
                            <a class="text-gray-600 hover:opacity-70" href="{{ "listing-page?sc_names[0]=$category->id-$sub_category->name" }}" wire:navigate>{{ $sub_category->name }}</a>
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
