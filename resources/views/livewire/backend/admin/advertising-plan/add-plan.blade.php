<?php

use App\Models\AdvertisingPlan;
use Illuminate\Support\Facades\Hash;
use Livewire\Volt\Component;

new class extends Component {

    public $name = '';
    public $duration_days = '';
    public $cost = '';
    public $description = '';
    public $add_plan_modal = false;

    function addPlan()
    {
        AdvertisingPlan::create([
            'name' => trim($this->name),
            'duration_days' => $this->duration_days,
            'cost' => $this->cost,
            'description' => $this->description,
            'created_by' => auth()->user()->id 
        ]);

        $this->resetData(['name', 'duration_days', 'cost', 'description']);

        $this->add_plan_modal = false;
        $this->dispatch('alert-success');
    }

    function resetData($data)
    {
        $this->reset($data);
    }
}; ?>

<div 
    x-data="{ add_plan_modal: $wire.entangle('add_plan_modal') }" x-init="$watch('add_plan_modal', value => {
        if (value) {
            document.body.classList.add('overflow-hidden');
        } else {
            document.body.classList.remove('overflow-hidden');
        }
    })">
    <button class="bg-blue-400 text-sm text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-500"
    @click="add_plan_modal=true">
        Add Plan
    </button>
    
    <div class="position fixed h-full w-full top-0 left-0 bg-black bg-opacity-30 z-10 overflow-auto"
        x-show="add_plan_modal"
        x-transition
        x-cloak>
        <div class="h-full flex p-5">
            <div class="bg-white w-full max-w-xl m-auto rounded-2xl shadow-lg overflow-hidden"
            @click.outside="add_plan_modal=false; $wire.call('resetData', ['name', 'duration_days', 'cost', 'description'])">
                <div class="p-10 max-h-[35rem] overflow-auto">
                    <form wire:submit="addPlan">
                        <p class="font-bold text-lg text-slate-700 tracking-wide mb-6 pointer-events-none">Add Plan</p>
                        <div class="space-y-4">
                            <div class="flex flex-col gap-4 sm:flex-row">
                                <div class="flex-1 space-y-2">
                                    <p class="font-medium text-slate-700">Name</p>
                                    <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" required wire:model="name">
                                </div>
                            </div>
                            <div class="flex flex-col gap-4 sm:flex-row">
                                <div class="flex-1 space-y-2">
                                    <p class="font-medium text-slate-700">Duration Days</p>
                                    <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" required wire:model="duration_days">
                                </div>
                                <div class="flex-1 space-y-2">
                                    <p class="font-medium text-slate-700">Cost</p>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                            <span class="text-slate-500">$</span>
                                        </div>
                                        <input class="text-md w-full pl-8 pr-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="number" required wire:model="cost">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="space-y-2">
                                    <p class="font-medium text-slate-700">Description</p>
                                    <textarea class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" name="" id="" cols="50" rows="3" required wire:model="description"></textarea>
                                </div>
                            </div>
                            {{-- Loading Animation --}}
                            <div class="w-full text-center" wire:loading>
                                <div class="flex justify-center items-center gap-2">
                                    <svg class="animate-spin h-5 w-5 text-[#1F4B55]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 2.042.777 3.908 2.05 5.334l1.95-2.043z"></path>
                                    </svg>
                                    <span class="text-md font-medium text-slate-600">Saving post...</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-8">
                            <button class="text-slate-600 shadow py-2 px-4 rounded-lg hover:opacity-70" type="button"
                                    @click="add_plan_modal=false; $wire.call('resetData', ['name', 'duration_days', 'cost', 'description'])">
                                Cancel
                            </button>
                            <button class="text-white bg-[#1F4B55] shadow py-2 px-4 rounded-lg hover:opacity-70" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>