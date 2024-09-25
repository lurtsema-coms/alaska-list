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
            ->with(['product' => function($query) {
                $query->withTrashed();
            }, 'advertisingPlan' => function($query) {
                $query->withTrashed();
            }])
            ->selectRaw("
                special_boosts.*,
                DATE_FORMAT(CONVERT_TZ(from_date, '+00:00', @@session.time_zone), '%M %d, %Y %h:%i %p') AS formatted_from_date,
                DATE_FORMAT(CONVERT_TZ(to_date, '+00:00', @@session.time_zone), '%M %d, %Y %h:%i %p') AS formatted_to_date,
                CASE 
                    WHEN from_date <= NOW() AND to_date >= NOW() THEN 'Ongoing'
                    ELSE 'Expired'
                END AS status
            ")
            ->where(function ($query) {
                $query->where('id', 'like', '%' . $this->search . '%')
                    ->orWhereRaw("DATE_FORMAT(CONVERT_TZ(from_date, '+00:00', @@session.time_zone), '%M %d, %Y %h:%i %p') LIKE ?", ['%' . $this->search . '%'])
                    ->orWhereRaw("DATE_FORMAT(CONVERT_TZ(to_date, '+00:00', @@session.time_zone), '%M %d, %Y %h:%i %p') LIKE ?", ['%' . $this->search . '%'])
                    ->orWhere('created_at', 'like', '%' . $this->search . '%')
                    ->orWhere(function ($query) {
                        $query->whereRaw("(from_date <= NOW() AND to_date >= NOW())")
                            ->whereRaw("'Ongoing' LIKE ?", ['%' . $this->search . '%'])
                            ->orWhereRaw("(from_date > NOW() OR to_date < NOW())")
                            ->whereRaw("'Expired' LIKE ?", ['%' . $this->search . '%']);
                    });
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
    <div class="px-4 py-8 mx-auto space-y-8 bg-white shadow sm:container sm:rounded-lg sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center {{ auth()->user()->role == 'admin' ? 'justify-end' : 'justify-between' }}">
            @role('seller')
            <livewire:backend.admin.special-boost.add-boost/>
            @endrole
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
                            Id
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Boosted Code
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Listing Item Code
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
                    @foreach ($sponsors as $sponsor)
                    <tr class="hover:bg-gray-100" wire:key="sponsor-item-{{ $sponsor->id }}">
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ $sponsor->id }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            <div class="inline-block px-4 py-2 text-center rounded-lg shadow-sm {{ $sponsor->status == 'Ongoing' ? 'bg-green-400' : 'bg-red-400' }} text-white">
                                {{ $sponsor->status }}
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ $sponsor->uuid }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ $sponsor->product->uuid }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ Str::limit($sponsor->product->name, 50) }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ $sponsor->advertisingPlan->name }}
                        </td>
                        <td 
                            class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap" 
                            x-data="{
                                date: moment('{{ $sponsor->from_date }}Z')
                            }"
                        >
                            {{ $sponsor->formatted_from_date }}
                        </td>
                        <td 
                            class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap" 
                            x-data="{
                                date: moment('{{ $sponsor->to_date }}Z')
                            }"
                        >
                            {{ $sponsor->formatted_to_date }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ $sponsor->createdBy->first_name.' '.$sponsor->createdBy->last_name }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ $sponsor->created_at->format('Y-m-d') }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ $sponsor->updatedBy ? $sponsor->updatedBy->first_name.' '.$sponsor->updatedBy->last_name : '' }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                @role('seller')
                                    <a href="{{  route('seller-special-boost-view', $sponsor->id) }}" wire:navigate>
                                        <button class="px-4 py-2 text-sm text-white bg-blue-400 rounded-lg shadow-md hover:bg-blue-500">
                                            VIEW
                                        </button>
                                    </a>
                                @endrole
                                @role('admin')
                                    <livewire:backend.admin.special-boost.edit-boost x-on:alert-success="$refresh" wire:key="edit-boosting-{{ $sponsor->id }}" :$sponsor />
                                    <livewire:component.soft-delete-button wire:key="{{ 'soft-delete-boosting-' . $sponsor->id }}" :model="$sponsor" />
                                @endrole
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

@script
<script>
    $(document).ready(function() {
        
        setMinDateTime();

        function setMinDateTime() {
            $('.datetime-input').each(function() {
                let currentValue = $(this).val(); // Get the current value of the input
                if (currentValue) {
                    // If there's already a value, set the minimum to that value
                    $(this).attr('min', currentValue);
                } else {
                    // If there's no value, set the minimum to the current date and time
                    const now = new Date();
                    const year = now.getFullYear();
                    const month = String(now.getMonth() + 1).padStart(2, '0');
                    const day = String(now.getDate()).padStart(2, '0');
                    const hours = String(now.getHours()).padStart(2, '0');
                    const minutes = String(now.getMinutes()).padStart(2, '0');
                    
                    const minDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;
                    // $(this).attr('min', minDateTime);
                }
            });
        }
    });
</script>
@endscript