<?php

use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\Category;
use Livewire\Volt\Component;
use Livewire\Attributes\On;

new class extends Component {
    use WithPagination;

    #[Url]
    public $search = '';

    public function with(): array
    {
        return [
            'categories' => $this->loadCategories(),
        ];
    }

    #[On('alert-success')] 
    public function loadCategories()
    {
        return Category::with('subCategories', 'createdBy', 'updatedBy')
            ->withCount('products')
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('created_at', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('subCategories', function ($subQuery) {
                $subQuery->where('name', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('createdBy', function ($createdByQuery) {
                $createdByQuery->whereRaw("CONCAT(first_name, ' ', last_name) like ?", ['%' . $this->search . '%']);
            })
            ->orWhereHas('updatedBy', function ($updatedByQuery) {
                $updatedByQuery->whereRaw("CONCAT(first_name, ' ', last_name) like ?", ['%' . $this->search . '%']);
            })
            ->paginate(10);
    }

}; ?>

<div class="py-8">
    <div class="px-4 py-8 mx-auto space-y-8 bg-white shadow sm:container sm:rounded-lg sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-between">
            <livewire:backend.admin.category.add-category />
            <div class="relative p-1 overflow-hidden pointer-events-auto w-52 md:max-w-96">
                <input class="text-sm w-full px-4 border border-slate-300 rounded-lg focus:border-none focus:outline-none focus:ring-2 focus:ring-[#1F4B55]" type="search" placeholder="Search..." wire:model.live.debounce.200ms="search">
            </div>
        </div>
        <livewire:component.alert-messages />
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Sub Categories
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Products
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Created By
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Created At
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Updated By
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($categories as $category)
                        <tr class="hover:bg-gray-100" wire:key="{{ $category->id }}">
                            <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                                {{ $category->name }}
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    @php
                                        $subCategoriesToShow = $category->subCategories->take(4);
                                        $remainingCount = $category->subCategories->count() - $subCategoriesToShow->count();
                                    @endphp
    
                                    @foreach ($subCategoriesToShow as $sub_category)
                                        <span class="inline-block px-4 py-2 text-sm font-semibold text-gray-500 bg-gray-200 rounded-full">
                                            {{ $sub_category->name }}
                                        </span>
                                    @endforeach
                                    
                                    @if ($remainingCount > 0)
                                        <span class="inline-block text-gray-500">
                                            ...and {{ $remainingCount }} more
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                                {{ $category->products_count }}
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                                {{ $category->createdBy->first_name.' '.$category->createdBy->last_name }}
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                                {{ $category->created_at }}
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                                {{ $category->updatedBy ? $category->updatedBy->first_name.' '.$category->updatedBy->last_name : '' }}
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <livewire:backend.admin.category.edit-category wire:key="{{ 'edit-' . $category->id }}" :category="$category" />
                                    @if ($category->products_count == 0)
                                        <livewire:component.delete-button wire:key="{{ 'delete-' . $category->id }}" :model="$category" />
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $categories->links() }}
    </div>
</div>
