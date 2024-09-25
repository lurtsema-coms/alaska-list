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
            ->selectRaw("
                advertisements.*,
                DATE_FORMAT(CONVERT_TZ(from_date, '+00:00', @@session.time_zone), '%M %d, %Y %h:%i %p') AS formatted_from_date,
                DATE_FORMAT(CONVERT_TZ(to_date, '+00:00', @@session.time_zone), '%M %d, %Y %h:%i %p') AS formatted_to_date,
                CASE 
                    WHEN from_date <= NOW() AND to_date >= NOW() THEN 'Ongoing'
                    ELSE 'Expired'
                END AS status
            ")
            ->where(function ($query) {
                $query->where('id', 'like', '%' . $this->search . '%')
                    ->orWhere('uuid', 'like', '%' . $this->search . '%')
                    ->orWhere('created_at', 'like', '%' . $this->search . '%')
                    ->orWhereRaw("DATE_FORMAT(CONVERT_TZ(from_date, '+00:00', @@session.time_zone), '%M %d, %Y %h:%i %p') LIKE ?", ['%' . $this->search . '%'])
                    ->orWhereRaw("DATE_FORMAT(CONVERT_TZ(to_date, '+00:00', @@session.time_zone), '%M %d, %Y %h:%i %p') LIKE ?", ['%' . $this->search . '%'])
                    ->orWhere(function ($query) {
                        $query->whereRaw("(from_date <= NOW() AND to_date >= NOW())")
                            ->whereRaw("'Ongoing' LIKE ?", ['%' . $this->search . '%'])
                            ->orWhereRaw("(from_date > NOW() OR to_date < NOW())")
                            ->whereRaw("'Expired' LIKE ?", ['%' . $this->search . '%']);
                    });
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
        <div class="flex flex-wrap items-center {{ auth()->user()->role == 'admin' ? 'justify-end' : 'justify-between' }}">
            @role('seller')
                <livewire:backend.admin.advertisement.add-advertisement/>
            @endrole
            <div class="relative overflow-hidden pointer-events-auto w-52 md:max-w-96">
                <input class="text-sm w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="search" placeholder="Search..." wire:model.live.debounce.200ms="search">
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
                            Status
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
                        @role('admin')
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Updated By
                        </th>
                        @endrole
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
                            <div class="inline-block px-4 py-2 text-center rounded-lg shadow-sm {{ $advertisement->status == 'Ongoing' ? 'bg-green-400' : 'bg-red-400' }} text-white">
                                {{ $advertisement->status }}
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ $advertisement->uuid }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ Str::limit($advertisement->advertisingPlan->name, 50) }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap" x-data="{
                            date: moment('{{ $advertisement->from_date }}Z')
                        }">
                            {{ $advertisement->formatted_from_date }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ $advertisement->formatted_to_date }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ $advertisement->createdBy->first_name.' '.$advertisement->createdBy->last_name }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ $advertisement->created_at->format('Y-m-d') }}
                        </td>
                        @role('admin')
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ $advertisement->updatedBy ? $advertisement->updatedBy->first_name.' '.$advertisement->updatedBy->last_name : '' }}
                        </td>
                        @endrole
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                @role('admin')
                                <livewire:backend.admin.advertisement.edit-advertisement x-on:alert-success="$refresh" wire:key="edit-boosting-{{ $advertisement->id }}" :$advertisement />
                                <livewire:component.soft-delete-button wire:key="{{ 'soft-delete-boosting-' . $advertisement->id }}" :model="$advertisement" />
                                @endrole
                                @role('seller')
                                <a href="{{ route('seller-advertisement-view', $advertisement->id) }}" wire:navigate>
                                    <button class="px-4 py-2 text-sm text-white bg-blue-400 rounded-lg shadow-md hover:bg-blue-500">
                                        VIEW
                                    </button>
                                </a>
                                @endrole
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
