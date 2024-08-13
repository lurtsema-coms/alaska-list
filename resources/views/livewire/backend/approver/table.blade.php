<?php

use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {

    use WithPagination;

    #[Url] 
    public $search = '';

    #[On('alert-success')] 
    public function with(): array
    {
        return [
            'products' => $this->loadProducts(),
        ];
    }

    public function loadProducts()
    {
        $query = Product::withTrashed()
            ->with('subCategory.category')
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%')
                    ->orWhere('status', 'like', '%' . $this->search . '%')
                    ->orWhereHas('subCategory', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('subCategory.category', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    });
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return $query;
    }

}; ?>

<div class="py-8">
    <div class="px-4 py-8 mx-auto space-y-8 bg-white shadow sm:container sm:rounded-lg sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-end">
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
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Sub Category
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Image
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Created At
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Updated At
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($products as $product)
                        <tr class="hover:bg-gray-100" wire:key="approver-listing-{{ $product->id }}">
                            <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                                <span class="font-bold {{ $product->status == 'ACTIVE' ? 'text-green-500' : 'text-red-500' }}">
                                    {{ $product->status }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                                {{ $product->category->name }}
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                                {{ $product->subCategory->name }}
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                                {{ Str::limit($product->name , 50) }}
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                                {{ count(explode(",", $product->file_name)) }}
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-500 whitespace-normal min-w-96">
                                {{ Str::limit($product->description, 100) }}
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                                {{ $product->created_at->format('Y-m-d') }}
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                                {{ $product->updated_at ? $product->updated_at->format('Y-m-d') : '' }}
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <livewire:backend.approver.update-item wire:key="approver-update-listing-{{ $product->id }}" :id="$product->id"/>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $products->links() }}
    </div>
</div>
