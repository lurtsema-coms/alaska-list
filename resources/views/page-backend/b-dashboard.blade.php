<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="">
        @role('admin')
            <livewire:backend.approver.dashboard.chart />
        @endrole
        @role('approver')
            <livewire:backend.approver.dashboard.chart />
        @endrole
        @role('seller')
            <livewire:backend.seller.dashboard.chart />
        @endrole
    </div>
</x-app-layout>
