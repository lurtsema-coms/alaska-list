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

<div class="sticky top-0 z-20" x-data="{ sidebarOpen: false }">
    <div class="shadow-lg border-b-1 bg-gray-50">
        <div class="px-5 py-2 mx-auto sm:container sm:px-0">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-5">
                    <a class="" href="/" wire:navigate>
                        <img class="max-w-24" src="{{ asset('img/logo/logo.png') }}" alt="{{ asset('img/logo/logo.png') }}">
                    </a>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="block text-black cursor-pointer size-8 text-dark hover:opacity-70 lg:hidden"
                    @click="sidebarOpen = true;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <div class="items-center justify-end hidden w-full gap-4 lg:flex xl:px-0">
                    <a class="relative px-1 group {{ request()->routeIs('welcome') ? 'text-slate-950' : 'text-gray-600' }}" 
                    href="{{ route('welcome') }}" wire:navigate>
                        <span class="transition-opacity group-hover:text-slate-950">{{ request()->routeIs('welcome') ? 'Home' : 'Home' }}</span>
                        <span class="absolute left-0 h-1 transition-all bg-[#70B7E5] -bottom-3 {{ request()->routeIs('welcome') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>

                    <a class="relative px-1 group {{ request()->routeIs('listing-page') ? 'text-slate-950' : 'text-gray-600' }}" 
                    href="{{ route('listing-page') }}" wire:navigate>
                        <span class="transition-opacity group-hover:text-slate-950">{{ request()->routeIs('listing-page') ? 'Listing Page' : 'Listing Page' }}</span>
                        <span class="absolute left-0 h-1 transition-all bg-[#70B7E5] -bottom-3 {{ request()->routeIs('listing-page') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>

                    <a class="relative px-1 group {{ request()->routeIs('about-us') ? 'text-slate-950' : 'text-gray-600' }}" 
                    href="{{ route('about-us') }}" wire:navigate>
                        <span class="transition-opacity group-hover:text-slate-950">{{ request()->routeIs('about-us') ? 'About Us' : 'About Us' }}</span>
                        <span class="absolute left-0 h-1 transition-all bg-[#70B7E5] -bottom-3 {{ request()->routeIs('about-us') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>

                    {{-- <a class="relative px-1 group {{ request()->routeIs('get-in-touch') ? 'text-slate-950' : 'text-gray-600' }}" 
                    href="/#get-in-touch" wire:navigate>
                        <span class="transition-opacity group-hover:text-slate-950">{{ request()->routeIs('get-in-touch') ? 'Get In Touch' : 'Get In Touch' }}</span>
                        <span class="absolute left-0 h-1 transition-all bg-[#70B7E5] -bottom-3 {{ request()->routeIs('get-in-touch') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a> --}}

                    <a class="relative px-1 group {{ request()->routeIs('advertise-with-us') ? 'text-slate-950' : 'text-gray-600' }}" 
                    href="{{ route('advertise-with-us') }}" wire:navigate>
                        <span class="transition-opacity group-hover:text-slate-950">{{ request()->routeIs('advertise-with-us') ? 'Advertise With Us' : 'Advertise With Us' }}</span>
                        <span class="absolute left-0 h-1 transition-all bg-[#70B7E5] -bottom-3 {{ request()->routeIs('advertise-with-us') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>

                    @guest
                        <a class="relative" href="{{ route('login') }}" wire:navigate>
                            <div class="font-bold text-white bg-[#70B7E5] px-4 py-2 rounded-full shadow-md hover:bg-[#1B494D] hover:border-white transition duration-300">
                                POST CLASSIFIEDS
                            </div>
                        </a>
                        @else
                        <a class="relative px-1 group" href="{{ route('dashboard') }}" wire:navigate>
                            <span class="transition-opacity group-hover:text-slate-950">Dashboard</span>
                            <span class="absolute left-0 h-1 transition-all bg-[#70B7E5] -bottom-3 w-0 group-hover:w-full"></span>
                        </a>
                    @endguest
                    {{-- <div class="relative w-full p-1 overflow-hidden max-w-60 md:max-w-96 ">
                        <input class="w-full py-2 pl-4 pr-12 rounded-full focus:ring-2" type="search" wire:model="search" placeholder="Search..."
                            x-on:change="$dispatch('search-on', { val: $event.target.value})">
                        <button class="absolute inset-y-0 flex items-center pr-3 right-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </button>
                    </div> --}}
                    {{-- <a class="hidden font-medium text-slate-100 hover:text-slate-800 lg:block" href="{{ route('welcome') }}" wire:navigate>Home</a>
                    <a class="hidden font-medium text-slate-100 hover:text-slate-800 lg:block" href="{{ route('categories') }}" wire:navigate>Categories</a>
                    <a class="hidden font-medium text-slate-100 hover:text-slate-800 lg:block" href="{{ route('listing-page') }}" wire:navigate>Listing Page</a>
                    <a class="hidden font-medium text-slate-100 hover:text-slate-800 lg:block" href="{{ route('about-us') }}" wire:navigate>About Us</a>
                    <a class="hidden font-medium text-slate-100 hover:text-slate-800 lg:block" href="/#get-in-touch" wire:navigate>Get In Touch</a>
                    <a class="hidden font-medium text-slate-100 hover:text-slate-800 lg:block" href="{{ route('advertise-with-us') }}" wire:navigate>Advertise with us</a>
                    @guest
                    <a class="hidden font-medium text-slate-100 hover:text-slate-800 lg:block" href="{{ route('register') }}" wire:navigate>Sell</a>
                    @endguest
                    @auth
                    <a class="hidden font-medium cursor-pointer text-slate-100 hover:text-slate-800 lg:block" href="{{ route('dashboard') }}" wire:navigate>Dashboard</a>
                    @endauth --}}
                </div>
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
                    <img class="max-w-24 invert filter" src="{{ asset('img/logo/logo.png') }}" alt="{{ asset('img/logo/logo.png') }}">
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
                    <span class="transition-opacity group-hover:opacity-70">Listing Page</span>
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
