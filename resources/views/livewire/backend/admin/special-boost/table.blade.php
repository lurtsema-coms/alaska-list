<?php

use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\SpecialBoost;
use Livewire\Volt\Component;
use Livewire\Attributes\On;

new class extends Component {
    use WithPagination;

    #[Url]
    public $search = '';

    public function with(): array
    {
        return [
            'sponsors' => $this->loadSpecialBoost(),
        ];
    }
    
    #[On('alert-success')] 
    public function loadSpecialBoost(){
        $query = SpecialBoost::withTrashed()
            ->with('product', 'advertisingPlan')
            ->where(function ($query) {
                $query->where('id', 'like', '%' . $this->search . '%')
                    ->orWhere('from_date', 'like', '%' . $this->search . '%')
                    ->orWhere('to_date', 'like', '%' . $this->search . '%')
                    ->orWhere('created_at', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('product', function ($product) {
                $product->where('uuid', 'like', '%' . $this->search . '%')
                    ->orWhere('name', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('advertisingPlan', function ($advertisingPlan) {
                $advertisingPlan->where('name', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('createdBy', function ($createdByQuery) {
                $createdByQuery->whereRaw("CONCAT(first_name, ' ', last_name) like ?", ['%' . $this->search . '%']);
            })
            ->orWhereHas('updatedBy', function ($updatedByQuery) {
                $updatedByQuery->whereRaw("CONCAT(first_name, ' ', last_name) like ?", ['%' . $this->search . '%']);
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return $query;
    }
}; ?>

<div class="py-8">
    <div class="sm:container bg-white py-8 px-4 sm:rounded-lg mx-auto space-y-8 shadow sm:px-6 lg:px-8">
        <div class="flex justify-between items-center flex-wrap">
            <livewire:backend.admin.special-boost.add-boost/>
            <div class="relative w-52 p-1 pointer-events-auto overflow-hidden md:max-w-96">
                <input class="text-sm w-full px-4 border border-slate-300 rounded-lg focus:border-none focus:outline-none focus:ring-2 focus:ring-[#1F4B55]" type="search" placeholder="Search..." wire:model.live.debounce.200ms="search">
            </div>
        </div>
        <livewire:component.alert-messages/>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-sm text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Id
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Item Code
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Product Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Advertising Plan
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            From Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Start Date
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
                    @foreach ($sponsors as $sponsor)
                    <tr class="hover:bg-gray-100" wire:key="sponsor-item-{{ $sponsor->id }}">
                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                            {{ $sponsor->id }}
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                            {{ $sponsor->product->uuid }}
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                            {{ $sponsor->product->name }}
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                            {{ $sponsor->advertisingPlan->name }}
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                            {{ $sponsor->from_date }}
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                            {{ $sponsor->to_date }}
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                            {{ $sponsor->createdBy->first_name.' '.$sponsor->createdBy->last_name }}
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                            {{ $sponsor->created_at->format('Y-m-d') }}
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                            {{ $sponsor->updatedBy ? $sponsor->updatedBy->first_name.' '.$sponsor->updatedBy->last_name : '' }}
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                            <div class="flex items-center gap-2">
                                <livewire:backend.admin.special-boost.edit-boost wire:key="edit-boosting-{{ $sponsor->id }}" :$sponsor />
                                <livewire:component.soft-delete-button wire:key="{{ 'soft-delete-boosting-' . $sponsor->id }}" :model="$sponsor" />
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $sponsors->links() }}
        </div>
    </div>
</div>
