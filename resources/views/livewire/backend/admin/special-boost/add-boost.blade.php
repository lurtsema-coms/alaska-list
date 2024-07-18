<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div x-data="{ add_boost: $wire.entangle('add_boost') }" x-init="$watch('add_boost', value => {
    if (value) {
        document.body.classList.add('overflow-hidden');
    } else {
        document.body.classList.remove('overflow-hidden');
    }
    })">
    
    <button class="bg-blue-400 text-sm text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-500" @click="add_boost=true">
        Add Special Boost
    </button>

    <div class="position fixed h-full w-full top-0 left-0 bg-black bg-opacity-30 z-10 overflow-auto"
    x-show="add_boost"
    x-transition
    x-cloak>
        <div class="h-full flex p-5">
            <div class="bg-white w-full max-w-xl m-auto rounded-2xl shadow-lg overflow-hidden">
                <div class="p-10 max-h-[35rem] overflow-auto">
                    <p class="font-bold text-lg text-slate-700 tracking-wide mb-6 pointer-events-none">Special Boost Item</p>
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <p class="font-medium text-slate-700">Item Code</p>
                            <div class="relative w-full">
                                <input
                                    class="text-md w-full px-4 pr-10 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]"
                                    type="text"
                                    wire:model="item_code"
                                    required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-slate-500"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4 sm:flex-row">
                            <div class="flex-1 space-y-2">
                                <p class="font-medium text-slate-700">Item</p>
                                <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" readonly wire:model="to_date">
                            </div>
                            <div class="flex-1 space-y-2">
                                <p class="font-medium text-slate-700">Seller</p>
                                <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" readonly wire:model="end_date">
                            </div>
                        </div>
                        <div class="flex flex-col gap-4 sm:flex-row">
                            <div class="flex-1 space-y-2">
                                <p class="font-medium text-slate-700">Seller Email</p>
                                <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" readonly wire:model="to_date">
                            </div>
                            <div class="flex-1 space-y-2">
                                <p class="font-medium text-slate-700">Item Status</p>
                                <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" readonly wire:model="end_date">
                            </div>
                        </div>
                        <p class="font-bold text-md text-slate-700 tracking-wide !mb-3 !mt-6 pointer-events-none">Setup:</p>
                        <div class="flex flex-col gap-4 sm:flex-row">
                            <div class="flex-1 space-y-2">
                                <p class="font-medium text-slate-700">To Date</p>
                                <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="date" required wire:model="to_date">
                            </div>
                            <div class="flex-1 space-y-2">
                                <p class="font-medium text-slate-700">End Date</p>
                                <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="date" required wire:model="end_date">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <p class="font-medium text-slate-700">Insert Image</p>
                                <input class="text-md w-full px-5 py-5 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="file" wire:model="insert_image" required>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2 mt-8">
                        <button class="text-slate-600 shadow py-2 px-4 rounded-lg hover:opacity-70" type="button"
                                @click="add_boost=false;">
                            Cancel
                        </button>
                        <button class="text-white bg-[#1F4B55] shadow py-2 px-4 rounded-lg hover:opacity-70" type="submit">Submit</button>
                    </div>
                </div>    
            </div>
        </div>
    </div>
    
    
</div>

