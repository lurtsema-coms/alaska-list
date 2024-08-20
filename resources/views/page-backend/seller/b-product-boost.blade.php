<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Boosted Product') }}
        </h2>
    </x-slot>

    <livewire:backend.seller.boost.table />
</x-app-layout>
