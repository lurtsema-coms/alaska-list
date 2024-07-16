<?php

use Livewire\Attributes\Url;
use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {

    #[Url]
    public $search = '';
    
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div class="sticky top-0 z-20" x-data="{ sidebarOpen: false }">
    <div class="bg-[#246567] border-b">
        <div class="sm:container mx-auto py-2 px-2 sm:px-0">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-white size-8 text-dark cursor-pointer hover:opacity-70"
                        @click="sidebarOpen = true;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <a class="hidden md:block" href="/" wire:navigate>
                        <img class="max-w-24" src="{{ asset('frontend/alaska.png') }}" alt="">
                    </a>
                </div>
                <div class="flex justify-end items-center gap-4 w-full">
                    <div class="relative w-full max-w-60 p-1 overflow-hidden md:max-w-96 ">
                        <input class="w-full rounded-full py-2 pr-12 pl-4 focus:ring-2" type="search" wire:model="search" placeholder="Search..."
                            x-on:change="$dispatch('search-on', { val: $event.target.value})">
                        <button class="absolute inset-y-0 right-2 flex items-center pr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </button>
                    </div>
                    @guest
                    <a class="hidden text-slate-100 font-medium hover:text-slate-800 lg:block" href="/register" wire:navigate>Sell</a>
                    <a class="hidden text-slate-100 font-medium hover:text-slate-800 lg:block" href="/login" wire:navigate>Login</a>
                    @else
                    <a class="hidden text-slate-100 font-medium hover:text-slate-800 cursor-pointer lg:block" href="{{ route('dashboard') }}" wire:navigate>Dashboard</a>
                    <a class="hidden text-slate-100 font-medium hover:text-slate-800 cursor-pointer lg:block" wire:click="logout">Logout</a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
    <div class="fixed top-0 h-dvh w-80 bg-gray-900 bg-opacity-90 p-6 z-10 overflow-y-auto"
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
            <div class="flex justify-between items-center md:justify-end">
                <a class="block md:hidden" href="/" wire:navigate>
                    <img class="max-w-24" src="{{ asset('frontend/alaska.png') }}" alt="">
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 text-slate-300 cursor-pointer hover:text-white"
                @click="sidebarOpen = false;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </div>
            <div class="flex flex-col gap-5 text-white">
                <a class="relative group px-1" href="{{ route('welcome') }}" wire:navigate>
                    <span class="transition-opacity group-hover:opacity-70">Home</span>
                    <span class="absolute -bottom-3 left-0 w-0 transition-all h-1 bg-white group-hover:w-full"></span>
                </a>
                <a class="relative group px-1" href="{{ route('categories') }}" wire:navigate>
                    <span class="transition-opacity group-hover:opacity-70">Categories</span>
                    <span class="absolute -bottom-3 left-0 w-0 transition-all h-1 bg-white group-hover:w-full"></span>
                </a>
                <a class="relative group px-1" href="{{ route('listing-page') }}" wire:navigate>
                    <span class="transition-opacity group-hover:opacity-70">Listing Page</span>
                    <span class="absolute -bottom-3 left-0 w-0 transition-all h-1 bg-white group-hover:w-full"></span>
                </a>
                <a class="relative group px-1" href="{{ route('about-us') }}" wire:navigate>
                    <span class="transition-opacity group-hover:opacity-70">About Us</span>
                    <span class="absolute -bottom-3 left-0 w-0 transition-all h-1 bg-white group-hover:w-full"></span>
                </a>
                <a class="relative group px-1" href="/#get-in-touch" wire:navigate>
                    <span class="transition-opacity group-hover:opacity-70">Get In Touch</span>
                    <span class="absolute -bottom-3 left-0 w-0 transition-all h-1 bg-white group-hover:w-full"></span>
                </a>
                <a class="relative group px-1" href="{{ route('advertise-with-us') }}" wire:navigate>
                    <span class="transition-opacity group-hover:opacity-70">Advertise With Us</span>
                    <span class="absolute -bottom-3 left-0 w-0 transition-all h-1 bg-white group-hover:w-full"></span>
                </a>
                <div class="flex flex-col gap-5 mt-10 lg:hidden">
                @guest
                    <a class="relative group px-1" href="{{ route('register') }}" wire:navigate>
                        <span class="transition-opacity group-hover:opacity-70">Sell</span>
                        <span class="absolute -bottom-3 left-0 w-0 transition-all h-1 bg-white group-hover:w-full"></span>
                    </a>
                    <a class="relative group px-1" href="{{ route('login') }}" wire:navigate>
                        <span class="transition-opacity group-hover:opacity-70">Login</span>
                        <span class="absolute -bottom-3 left-0 w-0 transition-all h-1 bg-white group-hover:w-full"></span>
                    </a>
                    @else
                    <a class="relative group px-1" href="{{ route('dashboard') }}" wire:navigate>
                        <span class="transition-opacity group-hover:opacity-70">Dashboard</span>
                        <span class="absolute -bottom-3 left-0 w-0 transition-all h-1 bg-white group-hover:w-full"></span>
                    </a>
                    <a class="relative group px-1" href="{{ route('dashboard') }}" wire:cilck="logout">
                        <span class="transition-opacity group-hover:opacity-70">Logout</span>
                        <span class="absolute -bottom-3 left-0 w-0 transition-all h-1 bg-white group-hover:w-full"></span>
                    </a>
                @endguest
                </div>
            </div>
        </div>
    </div>
</div>
