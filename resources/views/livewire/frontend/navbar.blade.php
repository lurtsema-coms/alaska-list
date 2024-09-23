<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {

    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div 
    class="fixed top-0 z-50 w-full" x-data="{ sidebarOpen: false, scrolled: window.scrollY > 0, hovered: false }" 
    @scroll.window="scrolled = window.scrollY > 0" 
    x-init="scrolled = window.scrollY > 0"
>
    <div 
        :class="{'bg-white shadow-sm' : scrolled, 'bg-[#f7fafce7]' : hovered || scrolled}"
        class="transition-all {{ request()->routeIs('listing-page-item') ? 'shadow-sm' : "" }} hover:bg-[#f7fafce7]"
        @mouseenter="hovered = true" 
        @mouseleave="hovered = false"    
    >
        <div class="px-5 py-2 mx-auto sm:container">
            <div class="relative flex items-center justify-between">
                <div class="flex items-center gap-5">
                    <a class="" href="/" wire:navigate>
                        <img class="max-w-24" src="{{ asset('img/logo/logo_light.png') }}" alt="logo-white">
                    </a>
                </div>
                <div class="absolute items-center hidden gap-2 font-bold -translate-x-1/2 left-1/2 lg:flex">
                    <a 
                        :class="{ 
                            '{{ request()->routeIs('welcome') ? 'text-teal-400' : '!text-gray-600' }}': hovered || scrolled 
                        }"
                        class="relative px-1 group {{ request()->routeIs('welcome') ? '!text-teal-400' : 'text-white' }}"
                        href="{{ route('welcome') }}" 
                        wire:navigate
                    >
                        <span class="transition-opacity group-hover:!text-teal-400 {{ request()->routeIs('listing-page-item') ? '!text-gray-600' : '' }}">{{ request()->routeIs('welcome') ? 'Home' : 'Home' }}</span>
                    </a>

                    <a 
                        :class="{' {{ request()->routeIs('listing-page') ? 'text-teal-400' : '!text-gray-600' }}': hovered || scrolled}"
                        class="relative px-1 group {{ request()->routeIs('listing-page') ? '!text-teal-400' : 'text-white' }} {{ request()->routeIs('listing-page-item') ? '!text-gray-500' : '' }}"
                        href="{{ route('listing-page') }}" 
                        wire:navigate 
                    >
                        <span class="transition-opacity group-hover:!text-teal-400 {{ request()->routeIs('listing-page-item') ? '!text-gray-600' : '' }}">{{ request()->routeIs('listing-page') ? 'Listing' : 'Listing' }}</span>
                    </a>

                    <a
                        :class="{' {{ request()->routeIs('about-us') ? 'text-teal-400' : '!text-gray-600' }}': hovered || scrolled}"
                        class="relative px-1 group {{ request()->routeIs('about-us') ? '!text-teal-400' : 'text-white' }} {{ request()->routeIs('listing-page-item') ? '!text-gray-500' : '' }}"
                        href="{{ route('about-us') }}" 
                        wire:navigate
                    >
                        <span class="transition-opacity group-hover:!text-teal-400 {{ request()->routeIs('listing-page-item') ? '!text-gray-600' : '' }}">{{ request()->routeIs('about-us') ? 'About Us' : 'About Us' }}</span>
                    </a>
                    
                    <a 
                        :class="{' {{ request()->routeIs('advertise-with-us') ? 'text-teal-400' : '!text-gray-600' }}': hovered || scrolled}"
                        class="relative px-1 group {{ request()->routeIs('advertise-with-us') ? '!text-teal-400' : 'text-white' }} {{ request()->routeIs('listing-page-item') ? '!text-gray-500' : '' }}"
                        href="{{ route('advertise-with-us') }}" 
                        wire:navigate
                    >
                        <span class="transition-opacity group-hover:!text-teal-400 {{ request()->routeIs('listing-page-item') ? '!text-gray-600' : '' }}">{{ request()->routeIs('advertise-with-us') ? 'Advertise With Us' : 'Advertise With Us' }}</span>
                    </a>
                    
                </div>
                @guest
                    <a class="relative hidden px-1 group lg:block" href="{{ route('login') }}" wire:navigate>
                        <div class="px-4 py-2 font-bold text-white transition duration-300 rounded-full shadow-md bg-search-gradient hover:opacity-70">
                            Post an Ad
                        </div>
                    </a>
                    @else
                    <a class="relative hidden px-1 group lg:block" href="{{ route('dashboard') }}" wire:navigate>
                        <span 
                            :class="{ 
                                '!text-gray-600': hovered || scrolled || '{{ request()->routeIs('listing-page-item') }}', 
                                'text-white': !hovered && !'{{ request()->routeIs('listing-page-item') }}', 
                                'font-bold text-white': !hovered || !scrolled ,
                            }"
                            class="transition-opacity group-hover:!text-teal-300"
                        >
                            Dashboard
                        </span>
                    </a>
                @endguest
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="block text-black cursor-pointer size-8 text-dark hover:opacity-70 lg:hidden"
                    @click="sidebarOpen = true;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </div>
        </div>
    </div>
    <div class="fixed top-0 z-10 p-6 overflow-y-auto bg-gray-900 h-dvh w-80 bg-opacity-90"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        x-show="sidebarOpen"
        @click.outside="sidebarOpen = false">
        <div class="space-y-4 ">
            <div class="flex items-center justify-between md:justify-end">
                <a class="block md:hidden" href="/" wire:navigate>
                    <img class="max-w-24" src="{{ asset('img/logo/logo-white.png') }}" alt="logo-white">
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer size-8 text-slate-300 hover:text-white"
                @click="sidebarOpen = false;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </div>
            <div class="flex flex-col gap-5 text-white">
                <a class="relative px-1 group" href="{{ route('welcome') }}" wire:navigate>
                    <span class="transition-opacity group-hover:opacity-70">Home</span>
                    <span class="absolute left-0 w-0 h-1 transition-all bg-white -bottom-3 group-hover:w-full"></span>
                </a>
                {{-- <a class="relative px-1 group" href="{{ route('categories') }}" wire:navigate>
                    <span class="transition-opacity group-hover:opacity-70">Categories</span>
                    <span class="absolute left-0 w-0 h-1 transition-all bg-white -bottom-3 group-hover:w-full"></span>
                </a> --}}
                <a class="relative px-1 group" href="{{ route('listing-page') }}" wire:navigate>
                    <span class="transition-opacity group-hover:opacity-70">Listings</span>
                    <span class="absolute left-0 w-0 h-1 transition-all bg-white -bottom-3 group-hover:w-full"></span>
                </a>
                <a class="relative px-1 group" href="{{ route('about-us') }}" wire:navigate>
                    <span class="transition-opacity group-hover:opacity-70">About Us</span>
                    <span class="absolute left-0 w-0 h-1 transition-all bg-white -bottom-3 group-hover:w-full"></span>
                </a>
                {{-- <a class="relative px-1 group" href="/#get-in-touch" wire:navigate>
                    <span class="transition-opacity group-hover:opacity-70">Get In Touch</span>
                    <span class="absolute left-0 w-0 h-1 transition-all bg-white -bottom-3 group-hover:w-full"></span>
                </a> --}}
                <a class="relative px-1 group" href="{{ route('advertise-with-us') }}" wire:navigate>
                    <span class="transition-opacity group-hover:opacity-70">Advertise With Us</span>
                    <span class="absolute left-0 w-0 h-1 transition-all bg-white -bottom-3 group-hover:w-full"></span>
                </a>
                <div class="flex flex-col gap-5 mt-10">
                    @guest
                        <a class="relative px-1 group" href="{{ route('login') }}" wire:navigate>
                            <span class="transition-opacity group-hover:opacity-70">Post Classifieds</span>
                            <span class="absolute left-0 w-0 h-1 transition-all bg-white -bottom-3 group-hover:w-full"></span>
                        </a>
                        @else
                        <a class="relative px-1 group" href="{{ route('dashboard') }}" wire:navigate>
                            <span class="transition-opacity group-hover:opacity-70">Dashboard</span>
                            <span class="absolute left-0 w-0 h-1 transition-all bg-white -bottom-3 group-hover:w-full"></span>
                        </a>
                        <a class="relative px-1 cursor-pointer group" wire:click="logout">
                            <span class="transition-opacity group-hover:opacity-70">Logout</span>
                            <span class="absolute left-0 w-0 h-1 transition-all bg-white -bottom-3 group-hover:w-full"></span>
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
