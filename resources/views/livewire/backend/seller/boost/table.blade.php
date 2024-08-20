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
            'products' => $this->loadProduct(),
        ];
    }
    
    #[On('alert-success')]
    public function loadProduct()
    {
        $query = Product::with(['specialBoost.advertisingPlan'])
            ->where('created_by', auth()->user()->id)
            ->where(function ($query) {
                $query->whereHas('specialBoost')
                    ->where(function ($query) {
                        $query->where('uuid', 'like', '%' . $this->search . '%')
                            ->orWhere('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('specialBoost', function ($query) {
                        $query->where('from_date', 'like', '%' . $this->search . '%')
                            ->orWhere('to_date', 'like', '%' . $this->search . '%')
                            ->orWhere('created_at', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('specialBoost.advertisingPlan', function ($query) {
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
        <livewire:component.alert-messages/>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Item Code
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Product Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Advertising Plan
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            From Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            To Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Created At
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                        use Carbon\Carbon;
                    @endphp
                    @foreach ($products as $product)
                    <tr class="hover:bg-gray-100" wire:key="spb-item-{{ $product->id }}">
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ $product->uuid }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ $product->name }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ $product->specialBoost->first()->advertisingPlan->name }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ $product->specialBoost->first()->from_date }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ $product->specialBoost->first()->to_date }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ $product->specialBoost->first()->created_at }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
    </div>
</div>