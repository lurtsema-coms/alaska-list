<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Approve Listing') }}
        </h2>
    </x-slot>
    
    <livewire:backend.approver.table>
</x-app-layout>