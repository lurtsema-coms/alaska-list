<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-[120rem] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('welcome') }}" wire:navigate>
                        <img class="max-w-24 h-9" src="{{ asset('img/logo/logo.png') }}" alt="logo-white">
                    </a>
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-4 sm:-my-px sm:ms-10 lg:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </x-nav-link>
                @role('seller')
                    <x-nav-link :href="route('seller-listing')" :active="request()->routeIs('seller-listing') || request()->routeIs('seller-listing-add') " wire:navigate>
                        {{ __('Listing') }}
                    </x-nav-link>
                    {{-- <x-nav-link :href="route('seller-boost')" :active="request()->routeIs('seller-boost')" wire:navigate>
                        {{ __('Boost') }}
                    </x-nav-link> --}}
                    <x-nav-link :href="route('seller-special-boost')" :active="request()->routeIs('seller-special-boost')" wire:navigate>
                        {{ __('Boosted Listing') }}
                    </x-nav-link>
                    <x-nav-link :href="route('seller-advertisement')" :active="request()->routeIs('seller-advertisement')" wire:navigate>
                        {{ __('Featured Listing') }}
                    </x-nav-link>
                @endrole
                @role('admin')
                    <x-nav-link :href="route('admin-categories')" :active="request()->routeIs('admin-categories')" wire:navigate>
                        {{ __('Categories') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin-listing')" :active="request()->routeIs('admin-listing')" wire:navigate>
                        {{ __('Listing') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin-special-boost')" :active="request()->routeIs('admin-special-boost')" wire:navigate>
                        {{ __('Boosted Listing') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin-advertisement')" :active="request()->routeIs('admin-advertisement')" wire:navigate>
                        {{ __('Featured Listing') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin-user-control')" :active="request()->routeIs('admin-user-control')" wire:navigate>
                        {{ __('User Control') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin-advertising-plan')" :active="request()->routeIs('admin-advertising-plan')" wire:navigate>
                        {{ __('Advertising Plan') }}
                    </x-nav-link>
                @endrole
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden lg:flex lg:items-center lg:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                            <div x-data="{{ json_encode(['name' => auth()->user()->first_name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start" x-on:click="localStorage.setItem('prohibitedModal', 'true');">
                            <x-dropdown-link>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -me-2 lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            @role('seller')
                <x-responsive-nav-link :href="route('seller-listing')" :active="request()->routeIs('seller-listing')" wire:navigate>
                    {{ __('Listing') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('seller-special-boost')" :active="request()->routeIs('seller-special-boost')" wire:navigate>
                    {{ __('Boosted Listing') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('seller-boost')" :active="request()->routeIs('seller-boost')" wire:navigate>
                    {{ __('Featured Listing') }}
                </x-responsive-nav-link>
            @endrole
            @role('admin')
            <x-responsive-nav-link :href="route('admin-categories')" :active="request()->routeIs('admin-categories')" wire:navigate>
                {{ __('Categories') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin-listing')" :active="request()->routeIs('admin-listing')" wire:navigate>
                {{ __('Listing') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin-special-boost')" :active="request()->routeIs('admin-special-boost')" wire:navigate>
                {{ __('Boosted Listing') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin-advertisement')" :active="request()->routeIs('admin-advertisement')" wire:navigate>
                {{ __('Featured Listing') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin-user-control')" :active="request()->routeIs('admin-user-control')" wire:navigate>
                {{ __('User Control') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin-advertising-plan')" :active="request()->routeIs('admin-advertising-plan')" wire:navigate>
                {{ __('Advertising Plan') }}
            </x-responsive-nav-link>
            @endrole
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="text-base font-medium text-gray-800" x-data="{{ json_encode(['name' => auth()->user()->first_name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="text-sm font-medium text-gray-500">{{ auth()->user()->email }}</div>
            </div>
            
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate>
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link x-on:click="localStorage.setItem('prohibitedModal', 'true');">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
