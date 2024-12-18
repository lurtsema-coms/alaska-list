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

<div class="">
    <p>Explore by</p>
    <p class="mb-8 text-4xl">Categories</p>

    <div class="flex flex-wrap gap-8">
        @foreach($categories->chunk(ceil($categories->count() / 3)) as $chunk)
            <div class="flex flex-col flex-1 max-w-xl gap-8 min-w-72 xsm:min-w-80">
                @foreach($chunk as $category)
                    <div class="p-5 border border-gray-200 rounded-lg shadow-sm bg-gray-50">
                        <p class="mb-4 text-lg font-medium text-gray-700">{{ $category->name }}</p>
                        <ol class="grid grid-cols-1 gap-2 list-disc list-inside sm:grid-cols-2">
                            @foreach($category->subCategories as $index => $subCategory)
                                <li class="text-gray-600 break-words">
                                    @php
                                        $queryParam = 'sc_names[' . '0' . ']=' . urlencode($subCategory->name);
                                        $url = route('listing-page') . '?' . $queryParam;
                                    @endphp
                                    <a href="{{ $url }}" wire:navigate class="hover:opacity-70">
                                        <span>{{ $subCategory->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
