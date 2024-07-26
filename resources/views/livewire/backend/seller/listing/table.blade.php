<?php

use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Models\Product;
use Livewire\Volt\Component;
use Livewire\Attributes\On;

new class extends Component {

    use WithPagination;

    #[Url] 
    public $search = '';

    public function with(): array
    {
        return [
            'products' => $this->loadProducts(),
        ];
    }

    #[On('alert-success')] 
    public function loadProducts()
    {
        $user_id = auth()->user()->id;

        $query = Product::withTrashed()
            ->with('subCategory.category')
            ->where('created_by', $user_id)
            ->where(function ($query) {
                $query
                    ->orWhere('name', 'like', '%' . $this->search . '%')
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
        <div class="flex flex-wrap items-center justify-between">
            <a href="{{ route('seller-listing-add') }}" wire:navigate>
                <button class="px-4 py-2 text-sm text-white bg-blue-400 rounded-lg shadow-md hover:bg-blue-500">
                    Add Item
                </button>
            </a>
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
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap min-w-96 md:min-w-60">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Qty
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Created At
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Deleted At
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
                        <tr class="hover:bg-gray-100" wire:key="{{ $product->id }}">
                            <td class="px-6 py-3 text-sm whitespace-nowrap">
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
                                {{ $product->name }}
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                                {{ count(explode(",", $product->file_name)) }}
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-500 whitespace-normal min-w-96 md:min-w-full">
                                {{ Str::limit($product->description, 100) }}
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-500 whitespace-normal">
                                {{ $product->qty }}
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                                {{ $product->created_at->format('Y-m-d') }}
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                                {{ $product->deleted_at ? $product->deleted_at->format('Y-m-d') : '' }}
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                                {{ $product->updated_at ? $product->updated_at->format('Y-m-d') : '' }}
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('seller-listing-edit', $product->id) }}" wire:navigate>
                                        <button class="px-4 py-2 text-sm text-white bg-blue-400 rounded-lg shadow-md hover:bg-blue-500">
                                            EDIT
                                        </button>
                                    </a>
                                    {{-- <livewire:backend.seller.listing.update-qty wire:key="update-qty-{{ $product->id }}" :id="$product->id" /> --}}
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
