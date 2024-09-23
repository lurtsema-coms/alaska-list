<?php

use App\Models\SpecialBoost;
use App\Models\AdvertisingPlan;
use Livewire\Volt\Component;

new class extends Component {

    public $sponsor;
    public $uuid;
    public $advertising_plan_id;
    public $from_date = '';
    public $to_date = '';
    public $plans;
    
    public function mount()
    {
        $sponsor_id = request()->route('id');

        $this->sponsor = SpecialBoost::with('product')->find($sponsor_id);
        $this->uuid = $this->sponsor->uuid;
        $this->advertising_plan_id = $this->sponsor->advertising_plan_id;
        $this->from_date = $this->sponsor->from_date;
        $this->to_date = $this->sponsor->to_date;
        $this->plans = AdvertisingPlan::get();
    }
}; ?>

<div class="py-8">
    <div class="px-4 py-8 mx-auto space-y-8 bg-white shadow sm:container sm:rounded-lg sm:px-6 lg:px-8">
        <a class="inline-block mb-4 font-medium text-sky-600" href="{{ route('seller-special-boost') }}" wire:navigate>
            <span class="flex items-center space-x-2 cursor-pointer hover:opacity-70">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span>Back to Boosted Listing</span>
            </span>
        </a>
        <div class="grid pb-8 xl:gap-8 xl:grid-cols-2">
            <div>                
                <div class="grid sm:grid-cols-2 gap-x-8 gap-y-4">
                    <div class="space-y-2">
                        <p class="font-medium text-slate-700">Boosted Code</p>
                        <input class="text-base w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" wire:model="uuid" readonly>
                    </div>
                    <div class="space-y-2">
                        <p class="font-medium text-slate-700">Advertising Plan</p>
                        <select 
                            class="text-base w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55] disabled:border-slate-300" 
                            id="advertising-plan-{{ $uuid }}"
                            wire:model="advertising_plan_id" 
                            required
                            disabled
                        >
                            <option value="" disabled selected>Select at least one</option>
                            @foreach ($plans as $plan)
                                <option value="{{ $plan->duration_days }}" data-advertising-id="{{ $plan->id }}">{{ $plan->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div
                        class="space-y-2"
                        x-data="{ 
                            from_date: moment(new Date(`${{ $from_date }} UTC`)).format('YYYY-MM-DDTHH:mm') 
                        }"
                    >
                        <p class="font-medium text-slate-700">From Date</p>
                        <input 
                            class="text-base w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" 
                            id="from-date-{{ $uuid }}"
                            type="datetime-local" 
                            x-model="from_date"
                            readonly
                            required
                        >
                    </div>
                    <div 
                        class="space-y-2"
                        x-data="{ 
                            to_date: moment(new Date(`${{ $to_date }} UTC`)).format('MM/DD/YYYY') 
                        }"
                    >
                        <p class="font-medium text-slate-700">To Date</p>
                            <input 
                            class="text-base w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" 
                            id="to-date-{{ $uuid }}"
                            type="text"
                            x-model="to_date"
                            readonly
                            required
                        >
                    </div>
                </div>
            </div>
            <div class="flex justify-center mt-8 space-y-4 xl:mt-0">
                <div class="max-w-96">                                    
                    <a href="{{ route('listing-page-item', $sponsor->product->id) }}" class="block mb-8 overflow-hidden transition duration-300 bg-white border shadow-lg border-yellow-50 rounded-2xl hover:border-yellow-600 hover:no-underline" wire:navigate wire:key="{{ 'product-item-listing-'.$sponsor->product->id }}">
                        <div class="flex flex-col h-full">
                            @php
                                $images = explode(',', $sponsor->product->file_path);
                                $firstImage = trim($images[0]);
                            @endphp 

                            <div class="relative">
                                <img class="object-cover w-full h-56 rounded-t-xl" src="{{ asset($firstImage) }}" alt="{{ $sponsor->product->name }}">
                                <div class="absolute px-3 py-1 text-xs font-bold text-white bg-yellow-500 rounded-full top-4 left-4">Boosted</div>
                            </div>
                            
                            <div class="flex-1 p-6 bg-gradient-to-b from-yellow-50 to-white">
                                <p class="mb-2 text-lg font-semibold text-gray-800">{{ $sponsor->product->name }}</p>
                                <p class="mb-2 text-sm text-gray-600">{{ Str::limit($sponsor->product->description, 150) }}</p>
                                @if ($sponsor->product->price)
                                    <p class="mb-4 text-lg font-semibold text-yellow-600">${{ number_format($sponsor->product->price, fmod($sponsor->product->price, 1) !== 0.00 ? 2 : 0) }}</p>
                                @endif
                                <div class="flex items-center my-4 space-x-2">
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $sponsor->product->subCategory->name }}</span>
                                </div>
                                @if ($sponsor->product->qty)
                                    <p class="text-sm text-gray-600">Available: <span class="text-gray-500">{{ $sponsor->product->qty }}</span></p>
                                @endif
                            </div>
                            
                            <div class="p-6 border-t border-yellow-200 bg-yellow-50 rounded-b-xl">
                                <div class="flex flex-wrap items-center justify-between gap-4 mb-4" wire:ignore>
                                    <p class="font-bold text-green-500 timeago text-md" datetime="{{ $sponsor->product->created_at }} {{ config('app.timezone') }}"></p>
                                    <p class="text-gray-600">
                                        📍 {{ $sponsor->product->location ? $sponsor->product->location : '' }}
                                    </p>
                                </div>
                                <button class="px-4 py-2 font-bold text-white bg-yellow-500 rounded-xl hover:bg-yellow-600">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@script
<script data-navigate-once>
    $(document).ready(function() {

        let component = @this;

        $('#advertising-plan-{{ $uuid }}, #from-date-{{ $uuid }}').on('change', function(){
            component.advertising_plan = $('#advertising-plan-{{ $uuid }}').find('option:selected').data('advertising-id');
            computedPlanDate();
        })

        function initializeTimeago() {
            const timeagoNodes = document.querySelectorAll('.timeago');
            if (timeagoNodes.length) {
                timeagoInstance = timeago.render(timeagoNodes);
            }
        }

        initializeTimeago();
        
        function computedPlanDate() {
            const duration = parseInt($('#advertising-plan-{{ $uuid }}').val(), 10);
            const fromDate = $('#from-date-{{ $uuid }}').val();

            if (fromDate === '' || isNaN(duration)) return;

            const fromDateISO = new Date(fromDate);
            
            // Calculate the new date by adding the duration
            const toDateISO = new Date(fromDateISO);
            toDateISO.setDate(toDateISO.getDate() + duration);

            // Format the to_date as YYYY-MM-DD for display
            const toDateFormatted = toDateISO.toISOString().split('T')[0];

            // Update the component and the display
            component.from_date = fromDateISO.toISOString();
            component.to_date = toDateISO.toISOString();
            
            $('#to-date-{{ $uuid }}').val(toDateFormatted);
        }
    });
</script>
@endscript