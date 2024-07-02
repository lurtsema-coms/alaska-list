<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div class="sticky top-0 z-20" x-data="{ sidebarOpen: false }">
    <div class="bg-white border-b">
        <div class="container mx-auto py-2 px-5 md:px-0">
            <div class="flex items-center">
                <div class="flex items-center w-full gap-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 text-dark cursor-pointer hover:opacity-70"
                        @click="sidebarOpen = true;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <p class="text-xl text-slate-700">Logo</p>
                </div>
                <div class="relative w-full max-w-96 p-1 overflow-hidden">
                    <input class="w-full rounded-full py-2 pr-12 pl-4 focus:ring-2" type="text" placeholder="Search...">
                    <button class="absolute inset-y-0 right-2 flex items-center pr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed top-0 h-dvh w-80 bg-gray-900 bg-opacity-90 p-6 space-y-4 z-10"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        x-show="sidebarOpen"
        @click.outside="sidebarOpen = false">
        <div class="flex justify-end">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 text-slate-300 cursor-pointer hover:text-white"
            @click="sidebarOpen = false;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </div>
        <div class="flex flex-col gap-5 text-white">
            <a class="relative group px-1" href="/" wire:navigate>
                <span class="transition-opacity group-hover:opacity-70">Home</span>
                <span class="absolute -bottom-3 left-0 w-0 transition-all h-1 bg-white group-hover:w-full"></span>
            </a>
            <a class="relative group px-1" href="/categories" wire:navigate>
                <span class="transition-opacity group-hover:opacity-70">Categories</span>
                <span class="absolute -bottom-3 left-0 w-0 transition-all h-1 bg-white group-hover:w-full"></span>
            </a>
            <a class="relative group px-1" href="">
                <span class="transition-opacity group-hover:opacity-70">Listing page</span>
                <span class="absolute -bottom-3 left-0 w-0 transition-all h-1 bg-white group-hover:w-full"></span>
            </a>
            <a class="relative group px-1" href="/about-us" wire:navigate>
                <span class="transition-opacity group-hover:opacity-70">About Us</span>
                <span class="absolute -bottom-3 left-0 w-0 transition-all h-1 bg-white group-hover:w-full"></span>
            </a>
            <a class="relative group px-1" href="/#get-in-touch">
                <span class="transition-opacity group-hover:opacity-70">Get In Touch</span>
                <span class="absolute -bottom-3 left-0 w-0 transition-all h-1 bg-white group-hover:w-full"></span>
            </a>
            <a class="relative group px-1" href="/advertise-with-us" wire:navigate>
                <span class="transition-opacity group-hover:opacity-70">Advertise With Us</span>
                <span class="absolute -bottom-3 left-0 w-0 transition-all h-1 bg-white group-hover:w-full"></span>
            </a>
        </div>
    </div>
</div>
