<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('View Featured Listing') }}
        </h2>
    </x-slot>

    <livewire:backend.seller.advertisement.view-item />
</x-app-layout>
