@extends('frontend-layout')

@section('body-content')
{{-- hero section --}}
<div class="bg-[#246567] xl:[clip-path:ellipse(100%_100%_at_top_center)]" data-aos="zoom-in-up">
    <div class="relative min-h-[42rem] w-full sm:container mx-auto  md:rounded-2xl">
        <div class="min-h-[38rem] flex md:p-10">
            <div class="w-full flex justify-center flex-col gap-8 text-white z-10 px-5 md:px-10 xl:w-1/2">
                <p class="text-3xl font-bold md:text-5xl">Discover Alaska's Hidden Treasures, <span class="border-b-2 border-yellow-300">Sell</span> Your Surprises</p>
                <p class="text-lg text-slate-200">Welcome to Alaska List, your gateway to the Last Frontier's marketplace. Discover stories behind every listing - whether it's rugged gear, cozy cabins, or local services, find it all here.</p>
                <a class="flex justify-start mt-4" href="{{ route('listing-page') }}" wire:navigate>
                    <div class="bg-[#1F4B55] text-xl px-6 py-3 rounded-lg shadow-lg hover:bg-[#245D69] transition-colors duration-300 cursor-pointer">
                        Search Now
                    </div>
                </a>
            </div>
            <div class="absolute bottom-0 inset-0 flex items-center justify-end">
                <img src="{{ asset('frontend/business-woman.png') }}" alt="Image" class="hidden w-1/3 relative rounded-lg z-10 xl:block xl:right-24">
            </div>
            <!-- Random image icons -->
            <div class="absolute inset-0 flex items-center justify-center">
                <!-- Example random image icons with opacity -->
                <img src="{{ asset('icon-img/contact-list.png') }}" alt="Icon 1" class="absolute top-[10%] left-[10%] opacity-30 w-10">
                <img src="{{ asset('icon-img/list.png') }}" alt="Icon 2" class="absolute top-[30%] left-[70%] opacity-30 w-10">
                <img src="{{ asset('icon-img/shopping-bag.png') }}" alt="Icon 3" class="absolute top-[60%] left-[30%] opacity-30 w-10">
                <img src="{{ asset('icon-img/shopping-cart.png') }}" alt="Icon 4" class="absolute top-[40%] left-[50%] opacity-30 w-10">
                <img src="{{ asset('icon-img/store.png') }}" alt="Icon 5" class="absolute top-[80%] left-[20%] opacity-30 w-10">
                <img src="{{ asset('icon-img/store.png') }}" alt="Icon 6" class="absolute top-[70%] left-[60%] opacity-30 w-10">
                <!-- Add more icons as needed -->
            </div>
        </div>
    </div>
</div>
{{-- Categories Section --}}
<div class="mt-28 container mx-auto">
    <h2 class="text-center text-3xl sm:text-4xl font-bold text-slate-700 mb-10">Explore Our Categories</h2>
    <p class="text-center text-lg text-gray-600 mb-12">Find the best deals and discover a wide range of products across various categories. Start exploring now!</p>
    <div class="flex justify-center flex-wrap gap-4 px-5 md:px-0">
        @php
            $queryParamFurniture = 'sc_names[' . '0' . ']=' . urlencode('furniture');
            $furniture = route('listing-page') . '?' . $queryParamFurniture;
            $queryParamElectronics = 'sc_names[' . '0' . ']=' . urlencode('electronic');
            $electronic = route('listing-page') . '?' . $queryParamElectronics;
            $queryParamVehicles = 'sc_names[' . '0' . ']=' . urlencode('vehicle');
            $vehicle = route('listing-page') . '?' . $queryParamVehicles;
            $queryParamRealEstate = 'sc_names[' . '0' . ']=' . urlencode('real state');
            $real_estate = route('listing-page') . '?' . $queryParamRealEstate;
        @endphp
        <a class="flex-1 flex flex-col bg-gray-50 cursor-pointer min-w-56 min-h-44 p-4 border border-slate-300 rounded-xl shadow-md mb-4 transition-all hover:border-sky-600" href="{{ $furniture }}" wire:navigate data-aos="fade-right">
            <div>
                <p class="text-gray-700 text-2xl font-bold">Furnitures</p>
                <p class="text-gray-700">Discover a wide selection of sofas, tables, and chairs for sale, both new and used.</p>
            </div>
            <div class="flex-1 flex justify-end mt-3">
                <img class="w-16" src="{{ asset('icon-img/lamp.png') }}" alt="">
            </div>
        </a>
        <a class="flex-1 flex flex-col bg-gray-50 cursor-pointer min-w-56 min-h-44 p-4 border border-slate-300 rounded-xl shadow-md mb-4 transition-all hover:border-sky-600" href="{{ $electronic }}" wire:navigate data-aos="fade-right">
            <div>
                <p class="text-gray-700 text-2xl font-bold">Electronics</p>
                <p class="text-gray-700">Explore deals on smartphones, laptops, and gadgets from leading brands.</p>
            </div>
            <div class="flex-1 flex justify-end mt-3">
                <img class="w-16" src="{{ asset('icon-img/gadgets.png') }}" alt="">
            </div>
        </a>
        <a class="flex-1 flex flex-col bg-gray-50 cursor-pointer min-w-56 min-h-44 p-4 border border-slate-300 rounded-xl shadow-md mb-4 transition-all hover:border-sky-600" href="{{ $vehicle }}" wire:navigate data-aos="fade-right">
            <div>
                <p class="text-gray-700 text-2xl font-bold">Vehicles</p>
                <p class="text-gray-700">Find cars, trucks, motorcycles, and RVs for sale near you, both use.</p>
            </div>
            <div class="flex-1 flex justify-end mt-3">
                <img class="w-16" src="{{ asset('icon-img/car.png') }}" alt="">
            </div>
        </a>
        <a class="flex-1 flex flex-col bg-gray-50 cursor-pointer min-w-56 min-h-44 p-4 border border-slate-300 rounded-xl shadow-md mb-4 transition-all hover:border-sky-600" href="{{ $real_estate }}" wire:navigate data-aos="fade-right">
            <div>
                <p class="text-gray-700 text-2xl font-bold">Real Estate</p>
                <p class="text-gray-700">Browse listings for apartments, houses, and commercial properties.</p>
            </div>
            <div class="flex-1 flex justify-end mt-3">
                <img class="w-16" src="{{ asset('icon-img/house.png') }}" alt="">
            </div>
        </a>
        <div class="min-h-44 w-32 bg-gray-100 rounded-l-xl shadow-md mb-4 transition-all hover:border hover:bg-gray-200 cursor-pointer" data-aos="fade-right">
            <a href="/categories" wire:navigate>
                <div class="h-full flex justify-center items-center flex-col gap-4">
                    <div class="rounded-full border p-3 bg-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </div>
                    <p class="font-medium text-slate-600">See all</p>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="mt-28 container mx-auto">
    <div class="mb-12 flex flex-col items-center gap-4" data-aos="zoom-in">
        <h1 class="text-center text-3xl sm:text-4xl font-bold text-slate-700">Featured Products</h1>
        <svg width="100%" height="24" viewBox="0 0 445 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="paint0_linear" x1="442.073" y1="0.563245" x2="414.515" y2="114.417" gradientUnits="userSpaceOnUse">
                    <stop offset="0%" stop-color="#a1ffce"></stop>
                    <stop offset="100%" stop-color="#faffd1"></stop>
                </linearGradient>
            </defs>
            <path d="M2.05469 14.4867C101.635 11.2688 220.427 7.27869 321.636 4.51622C339.098 4.03959 405.88 2.2299 435.16 2.4148C469.321 2.63052 367.236 4.76098 333.13 5.23315C287.706 5.862 241.846 5.56207 196.608 7.11433C141.398 9.00879 86.1341 13.2794 32.6894 18.4062C25.661 19.0804 18.1112 19.7952 11.4034 20.8511C10.8564 20.9372 12.5329 21.0395 13.133 21.0441C30.5637 21.177 48.0652 20.9913 65.4387 20.6787C190.017 18.4372 313.48 13.4101 438.301 12.1482" stroke="url(#paint0_linear)" stroke-width="4" stroke-linecap="round"></path>
        </svg>
    </div>
    
    <div id="products" class="bg-white shadow-lg rounded-lg p-5 sm:p-10" data-aos="zoom-in">
        <div class="mx-8 md:mx-12 lg:mx-20 xl:mx-auto">
            <div class="mb-12 space-y-5 md:mb-14 text-center">
                <div class="inline-block px-4 py-2 text-sm font-semibold text-white rounded-full bg-[#2171a7] shadow-md hover:bg-[#1e65a4] transition-colors">
                    Sponsored Listings
                </div>
                <h1 class="text-3xl font-semibold text-gray-800">
                    Explore products that have been highlighted for your attention.
                </h1>
            </div>
            <livewire:frontend.sponsored-listing>
        </div>
    </div>
</div>
<div class="mt-10 relative py-28 bg-gradient-to-r " data-aos="zoom-in">
    <div class="sm:container mx-auto text-center px-5 md:px-24">
        <div class="relative inline-block">
            <h2 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#2171a7] to-[#1e65a4]">
                Discover Top Listings from Our Community
            </h2>
            <svg class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-4" width="100%" height="60" viewBox="0 0 100 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 30L50 0L100 30L50 60L0 30Z" fill="rgba(33, 113, 167, 0.1)" />
            </svg>
        </div>
        <p class="mt-4 text-lg text-gray-700 leading-relaxed">
            Explore curated highlights from community sellers. Find one-of-a-kind items, unique treasures, and special deals that you won't want to miss.
        </p>
    </div>
</div>
<div class="py-16 bg-[#246567] relative">
    <div class="sm:container mx-auto px-5 md:px-0">
        <div class="mb-14 flex flex-col items-center gap-2" data-aos="zoom-in">
            <h1 class="text-2xl sm:text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#a1ffce] to-[#faffd1]">
                Upload Your Treasure
            </h1>
        </div>

        <div class="max-w-7xl mx-auto flex flex-col gap-16 items-center px-10 py-16 bg-white rounded-xl shadow-md overflow-hidden md:px-20" data-aos="zoom-in">
            <div class="text-center bg-[#202c47] bg-opacity-80 text-white inline-block px-3 py-1 rounded-lg text-sm">
                Steps
            </div>
            <div class="flex gap-16 flex-col lg:flex-row">
                <!-- Step 1: Register -->
                <div class="flex-1 relative bg-[#f0f8f9] p-6 rounded-lg shadow-lg">
                    <div class="absolute -top-10 -left-10 text-9xl text-[#2171a7] opacity-10">
                        1
                    </div>
                    <p class="text-xl font-medium text-slate-600">Register</p>
                    <p class="text-md text-slate-600 mt-2">
                        Join our community and start listing your treasures. Registering is quick and easy. Get started by creating your account and enjoy all the features we offer.
                    </p>
                </div>
                
                <!-- Step 2: Login -->
                <div class="flex-1 relative bg-[#f0f8f9] p-6 rounded-lg shadow-lg">
                    <div class="absolute -top-10 -left-10 text-9xl text-[#2171a7] opacity-10">
                        2
                    </div>
                    <p class="text-xl font-medium text-slate-600">Login</p>
                    <p class="text-md text-slate-600 mt-2">
                        Access your account to manage your listings. Logging in keeps your information secure and easily accessible.
                    </p>
                </div>
                
                <!-- Step 3: Upload Your Treasures -->
                <div class="flex-1 relative bg-[#f0f8f9] p-6 rounded-lg shadow-lg">
                    <div class="absolute -top-10 -left-10 text-9xl text-[#2171a7] opacity-10">
                        3
                    </div>
                    <p class="text-xl font-medium text-slate-600">Upload Your Treasures</p>
                    <p class="text-md text-slate-600 mt-2">
                        Ready to sell something? Upload your items and reach potential buyers quickly. Provide clear details and set a fair price to attract interested buyers.
                    </p>
                </div>
            </div>
            <a class="flex justify-center" href="{{ route('login') }}">
                <div class="border border-[#2171a7] px-6 py-3 rounded-lg shadow-lg hover:bg-[#2171a7] hover:text-white transition-colors duration-300 cursor-pointer">
                    Upload Now
                </div>
            </a>
        </div>
    </div>
</div>
<div class="relative -top-1 -z-10">
    <svg id="wave" style="transform:rotate(180deg); transition: 0.3s" viewBox="0 0 1440 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0">
                <stop stop-color="#246567" offset="0%"></stop>
                <stop stop-color="#246567" offset="100%"></stop>
            </linearGradient>
        </defs>
        <path fill="url(#sw-gradient-0)" d="M0,10L12,16.7C24,23,48,37,72,45C96,53,120,57,144,60C168,63,192,67,216,65C240,63,264,57,288,48.3C312,40,336,30,360,23.3C384,17,408,13,432,11.7C456,10,480,10,504,21.7C528,33,552,57,576,68.3C600,80,624,80,648,75C672,70,696,60,720,58.3C744,57,768,63,792,66.7C816,70,840,70,864,73.3C888,77,912,83,936,86.7C960,90,984,90,1008,85C1032,80,1056,70,1080,65C1104,60,1128,60,1152,61.7C1176,63,1200,67,1224,60C1248,53,1272,37,1296,26.7C1320,17,1344,13,1368,11.7C1392,10,1416,10,1440,23.3C1464,37,1488,63,1512,68.3C1536,73,1560,57,1584,43.3C1608,30,1632,20,1656,20C1680,20,1704,30,1716,35L1728,40L1728,100L1716,100C1704,100,1680,100,1656,100C1632,100,1608,100,1584,100C1560,100,1536,100,1512,100C1488,100,1464,100,1440,100C1416,100,1392,100,1368,100C1344,100,1320,100,1296,100C1272,100,1248,100,1224,100C1200,100,1176,100,1152,100C1128,100,1104,100,1080,100C1056,100,1032,100,1008,100C984,100,960,100,936,100C912,100,888,100,864,100C840,100,816,100,792,100C768,100,744,100,720,100C696,100,672,100,648,100C624,100,600,100,576,100C552,100,528,100,504,100C480,100,456,100,432,100C408,100,384,100,360,100C336,100,312,100,288,100C264,100,240,100,216,100C192,100,168,100,144,100C120,100,96,100,72,100,48,100,24,100,12,100L0,100Z"></path>
    </svg>
</div>

{{-- Get In Touch --}}
<div id="get-in-touch" class="mt-14 mb-28 container mx-auto" wire:scroll>
    <div class="mb-14 flex flex-col items-center gap-4" data-aos="zoom-in">
        <h1 class="text-center text-3xl sm:text-4xl font-bold text-slate-700">Get In Touch</h1>
    </div>
    <div class="container px-5 md:px-0" data-aos="zoom-in">
        <livewire:frontend.contact-us>
    </div>
</div>
@endsection