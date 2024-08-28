<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Approved Listing') }}
        </h2>
    </x-slot>
    
    <livewire:backend.approver.table>
</x-app-layout>