<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listing') }}
        </h2>
    </x-slot>

    <livewire:backend.seller.listing.add-item />
</x-app-layout>
