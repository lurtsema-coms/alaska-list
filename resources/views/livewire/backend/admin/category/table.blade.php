<?php

use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\Category;
use Livewire\Volt\Component;

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

    public function loadCategories()
    {
        return Category::with('subCategories', 'createdBy', 'updatedBy')
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
    <div class="container bg-white py-8 px-4 sm:rounded-lg mx-auto space-y-8 shadow sm:px-6 lg:px-8">
        <div class="flex justify-between items-center flex-wrap">
            <livewire:backend.admin.category.add-category />
            <div class="relative w-52 p-1 pointer-events-auto overflow-hidden md:max-w-96">
                <input class="text-sm w-full px-4 border border-slate-300 rounded-lg focus:border-none focus:outline-none focus:ring-2 focus:ring-[#1F4B55]" type="search" placeholder="Search..." wire:model.live.debounce.200ms="search">
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-sm text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Sub Categories
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Created By
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Created At
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Updated By
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($categories as $category)
                        <tr class="hover:bg-gray-100" wire:key="{{ $category->id }}">
                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                                {{ $category->name }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex items-center gap-2">
                                    @php
                                        $subCategoriesToShow = $category->subCategories->take(4);
                                        $remainingCount = $category->subCategories->count() - $subCategoriesToShow->count();
                                    @endphp
    
                                    @foreach ($subCategoriesToShow as $sub_category)
                                        <span class="inline-block bg-gray-200 rounded-full  text-sm font-semibold text-gray-500 px-4 py-2">
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
                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                                {{ $category->createdBy->first_name.' '.$category->createdBy->last_name }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                                {{ $category->created_at }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                                {{ $category->updatedBy ? $category->updatedBy->first_name.' '.$category->updatedBy->last_name : '' }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex items-center gap-2">
                                    <livewire:backend.admin.category.edit-category :key="$category->id" :$category/>
                                    <livewire:backend.admin.category.delete-category :key="$category->id" :category_id="$category->id"/>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $categories->links() }}
        </div>
    </div>
</div>
