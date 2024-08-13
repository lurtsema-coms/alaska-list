<?php

use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\Advertisement;
use Livewire\Volt\Component;
use Livewire\Attributes\On;

new class extends Component {
    use WithPagination;

    #[Url]
    public $search = '';

    public function with(): array
    {
        return [
            'advertisements' => $this->loadAdvertisement(),
        ];
    }
    
    #[On('alert-success')]
    public function loadAdvertisement()
    {
        return Advertisement::withTrashed()
            ->with([
                'advertisingPlan' => function($query) {
                    $query->withTrashed();
                }
            ])
            ->where(function ($query) {
                $query->where('id', 'like', '%' . $this->search . '%')
                    ->orWhere('from_date', 'like', '%' . $this->search . '%')
                    ->orWhere('to_date', 'like', '%' . $this->search . '%')
                    ->orWhere('created_at', 'like', '%' . $this->search . '%');
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
    }
}; ?>

<div class="py-8">
    <div class="px-4 py-8 mx-auto space-y-8 bg-white shadow sm:container sm:rounded-lg sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-between">
            <livewire:backend.admin.advertisement.add-advertisement/>
            <div class="relative overflow-hidden pointer-events-auto w-52 md:max-w-96">
                <input class="text-sm w-full px-4 border border-slate-300 rounded-lg focus:border-none focus:outline-none focus:ring-2 focus:ring-[#1F4B55]" type="search" placeholder="Search..." wire:model.live.debounce.200ms="search">
            </div>
        </div>
        <livewire:component.alert-messages/>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Id
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Item Code
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
                    @php
                        use Carbon\Carbon;
                    @endphp
                    @foreach ($advertisements as $advertisement)
                    <tr class="hover:bg-gray-100" wire:key="sponsor-item-{{ $advertisement->id }}">
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ $advertisement->id }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ $advertisement->uuid }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ Str::limit($advertisement->advertisingPlan->name, 50) }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ Carbon::parse($advertisement->from_date)->format('F j, Y g:i A') }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ Carbon::parse($advertisement->to_date)->format('F j, Y g:i A') }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ $advertisement->createdBy->first_name.' '.$advertisement->createdBy->last_name }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ $advertisement->created_at->format('Y-m-d') }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ $advertisement->updatedBy ? $advertisement->updatedBy->first_name.' '.$advertisement->updatedBy->last_name : '' }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <livewire:backend.admin.advertisement.edit-advertisement x-on:alert-success="$refresh" wire:key="edit-boosting-{{ $advertisement->id }}" :$advertisement />
                                <livewire:component.soft-delete-button wire:key="{{ 'soft-delete-boosting-' . $advertisement->id }}" :model="$advertisement" />
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $advertisements->links() }}
        </div>
    </div>
</div>
