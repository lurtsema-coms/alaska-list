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

        $query = Product::with('subCategory.category')
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
    <div class="sm:container bg-white py-8 px-4 sm:rounded-lg mx-auto space-y-8 shadow sm:px-6 lg:px-8">
        <div class="flex justify-between items-center flex-wrap">
            <a href="{{ route('seller-listing-add') }}" wire:navigate>
                <button class="bg-blue-400 text-sm text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-500">
                    Add Item
                </button>
            </a>
            <div class="relative w-52 p-1 pointer-events-auto overflow-hidden md:max-w-96">
                <input class="text-sm w-full px-4 border border-slate-300 rounded-lg focus:border-none focus:outline-none focus:ring-2 focus:ring-[#1F4B55]" type="search" placeholder="Search..." wire:model.live.debounce.200ms="search">
            </div>
        </div>
        <livewire:component.alert-messages />
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-sm text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Sub Category
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Image
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm text-gray-500 uppercase tracking-wider whitespace-nowrap min-w-96 md:min-w-60">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Qty
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Created At
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Updated At
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($products as $product)
                        <tr class="hover:bg-gray-100" wire:key="{{ $product->id }}">
                            <td class="px-6 py-3 whitespace-nowrap text-sm">
                                <span class="font-bold {{ $product->status == 'APPROVED' ? 'text-green-500' : ($product->status == 'PENDING' ? 'text-yellow-500' : 'text-red-500') }}">
                                    {{ $product->status }}
                                </span>
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                                {{ $product->category->name }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                                {{ $product->subCategory->name }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                                {{ $product->name }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                                {{ count(explode(",", $product->file_name)) }}
                            </td>
                            <td class="px-6 py-3 whitespace-normal text-sm text-gray-500 min-w-96 md:min-w-full">
                                {{ Str::limit($product->description, 100) }}
                            </td>
                            <td class="px-6 py-3 whitespace-normal text-sm text-gray-500">
                                {{ $product->qty }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                                {{ $product->created_at->format('Y-m-d') }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                                {{ $product->updated_at ? $product->updated_at->format('Y-m-d') : '' }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('seller-listing-edit', $product->id) }}" wire:navigate>
                                        <button class="bg-blue-400 text-sm text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-500">
                                            EDIT
                                        </button>
                                    </a>
                                    <livewire:backend.seller.listing.update-qty wire:key="update-qty-{{ $product->id }}" :id="$product->id" />
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
