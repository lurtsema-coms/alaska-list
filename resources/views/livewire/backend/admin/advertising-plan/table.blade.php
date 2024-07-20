<?php

use App\Models\AdvertisingPlan;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    use WithPagination;

    #[Url]
    public $search = '';

    public function with(): array
    {
        return [
            'plans' => $this->loadAdvertisingPlan(),
        ];
    }

    #[On('alert-success')] 
    public function loadAdvertisingPlan()
    {
        return AdvertisingPlan::with('createdBy', 'updatedBy')
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%')
                    ->orWhere('duration_days', 'like', '%' . $this->search . '%')
                    ->orWhere('cost', 'like', '%' . $this->search . '%')
                    ->orWhere('created_at', 'like', '%' . $this->search . '%');
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
    <div class="sm:container bg-white py-8 px-4 sm:rounded-lg mx-auto space-y-8 shadow sm:px-6 lg:px-8">
        <div class="flex justify-between items-center flex-wrap">
            <livewire:backend.admin.advertising-plan.add-plan />
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
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Duration Days
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Cost
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
                    @foreach ($plans as $plan)
                        <tr class="hover:bg-gray-100" wire:key="advertising-plan-{{ $plan->id }}">
                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                                {{ $plan->name }}
                            </td>
                            <td class="px-6 py-3 whitespace-normal text-sm text-gray-500 min-w-96 md:min-w-full">
                                {{ $plan->description }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                                {{ $plan->duration_days }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                                ${{ $plan->cost }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                                {{ $plan->createdBy->first_name.' '.$plan->createdBy->last_name }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                                {{ $plan->created_at }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                                {{ $plan->updatedBy ? $plan->updatedBy->first_name.' '.$plan->updatedBy->last_name : '' }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex items-center gap-2">
                                    <livewire:backend.admin.advertising-plan.edit-plan wire:key="edit-plan-{{ $plan->id }}" :key="'edit-plan-' . $plan->id" :$plan/>
                                    <livewire:component.delete-button wire:key="{{ 'delete-plan' . $plan->id }}" :model="$plan" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $plans->links() }}
    </div>
</div>
