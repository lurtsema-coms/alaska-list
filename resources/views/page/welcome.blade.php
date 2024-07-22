@extends('frontend-layout')

@section('body-content')
{{-- hero section --}}
<div class="bg-[#246567] xl:[clip-path:ellipse(100%_100%_at_top_center)]" data-aos="zoom-in-up">
    <div class="relative h-auto sm:min-h-[42rem] w-full sm:container mx-auto  md:rounded-2xl">
        <div class="min-h-[38rem] flex md:p-10">
            <div class="w-full flex justify-center flex-col gap-8 text-white z-10 px-5 md:px-10 xl:w-1/2">
                <div>
                    <p class="text-3xl font-bold font-darkerGrotesque sm:text-6xl">ANYTHING YOU NEED, WE'VE GOT YOU COVERED</p>
                    <p class="text-3xl font-bold font-darkerGrotesque sm:text-6xl"></p>
                </div>
                <p class="text-lg text-slate-200">Classified advertissement website</p>
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
<div>
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
    {{-- Featured Section --}}
    <div class="mt-28 container mx-auto">
        <div class="mb-4 flex flex-col items-center gap-4" data-aos="zoom-in">
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
            <div class="md:mx-12 lg:mx-20 xl:mx-auto">
                <div class="mb-12 space-y-5 md:mb-14 text-center">
                    <div class="inline-block px-4 py-2 text-sm font-semibold text-white rounded-full bg-[#2171a7] shadow-md hover:bg-[#1e65a4] transition-colors">
                        Fresh recommended ads
                    </div>
                    <h1 class="text-3xl font-semibold text-gray-800">
                        Explore products that have been highlighted for your attention.
                    </h1>
                </div>
                <livewire:frontend.sponsored-listing>
            </div>
        </div>
    </div>
</div>

<div class="mt-28 relative h-96 " data-aos="zoom-in">
    <div class="h-full w-full absolute bg-brainstorm bg-cover bg-center brightness-50">
    </div>
    <div class="font-darkerGrotesque absolute top-0 h-full w-full flex flex-col justify-center items-center">
        <p class="text-5xl text-white">Find what you need</p>
        <p class="text-5xl text-white">in <span class="text-yellow-200">Alaska</span></p>
    </div>
</div>







<div class="py-28 relative">
    <div class="sm:container mx-auto px-6 md:px-12">
        <div class="mb-12 flex flex-col items-center gap-4" data-aos="fade-up">
            <h1 class="text-center text-3xl sm:text-4xl font-bold text-slate-700">
                Share Your Treasures with Us
            </h1>
        </div>

        <div class="max-w-7xl mx-auto flex flex-col gap-12 items-center px-8 py-12 bg-white border rounded-2xl shadow-xl overflow-hidden md:px-16" data-aos="fade-up">
            <div class="text-center bg-[#202c47] bg-opacity-80 text-white inline-block px-4 py-2 rounded-xl text-lg font-semibold">
                How It Works
            </div>
            <div class="flex flex-col gap-8 lg:flex-row lg:gap-12">
                <!-- Step 1: Register -->
                <div class="flex-1 relative bg-[#f9fbfc] p-8 rounded-xl shadow-lg transition-transform transform hover:scale-105">
                    <div class="absolute -top-8 -left-8 text-8xl text-[#2171a7] opacity-15">
                        1
                    </div>
                    <p class="text-xl font-semibold text-slate-700">Register</p>
                    <p class="text-lg text-slate-500 mt-3">
                        Become part of our community by creating an account. It’s quick and easy, allowing you to start listing your treasures immediately.
                    </p>
                </div>
                
                <!-- Step 2: Login -->
                <div class="flex-1 relative bg-[#f9fbfc] p-8 rounded-xl shadow-lg transition-transform transform hover:scale-105">
                    <div class="absolute -top-8 -left-8 text-8xl text-[#2171a7] opacity-15">
                        2
                    </div>
                    <p class="text-xl font-semibold text-slate-700">Login</p>
                    <p class="text-lg text-slate-500 mt-3">
                        Securely access your account to manage your listings. Login keeps your details safe and ensures easy management of your items.
                    </p>
                </div>
                
                <!-- Step 3: Upload Your Treasures -->
                <div class="flex-1 relative bg-[#f9fbfc] p-8 rounded-xl shadow-lg transition-transform transform hover:scale-105">
                    <div class="absolute -top-8 -left-8 text-8xl text-[#2171a7] opacity-15">
                        3
                    </div>
                    <p class="text-xl font-semibold text-slate-700">Upload Your Treasures</p>
                    <p class="text-lg text-slate-500 mt-3">
                        Ready to make a sale? Upload your items with clear descriptions and set a fair price to attract potential buyers quickly.
                    </p>
                </div>
            </div>
            <a class="flex justify-center mt-8" href="{{ route('login') }}">
                <div class="bg-[#2171a7] border border-[#2171a7] px-6 py-3 rounded-lg shadow-lg text-white font-semibold hover:bg-[#1a5b8a] transition-colors duration-300 cursor-pointer">
                    Get Started
                </div>
            </a>
        </div>
    </div>
</div>

{{-- Get In Touch --}}
<div id="get-in-touch" class="mb-28 container mx-auto" wire:scroll>
    <div class="mb-14 flex flex-col items-center gap-4" data-aos="zoom-in">
        <h1 class="text-center text-3xl sm:text-4xl font-bold text-slate-700">Get In Touch</h1>
        <p class="text-center text-slate-500 text-lg">Contact us using the information below. We'll respond promptly to your inquiries and feedback</p>
    </div>
    <div class="px-5 md:px-0" data-aos="zoom-in">
        <div class="max-w-6xl mx-auto flex w-full shadow-lg rounded-lg lg:rounded-full lg:shadow overflow-hidden">
            <div class="hidden w-full lg:block lg:w-1/2 mb-4 md:mb-0">
                <img class="h-[38rem] w-full object-cover bg-center" src="{{ asset('frontend/contact.jpg') }}" alt="Contact Image">
            </div>
            <div class="flex justify-center items-center w-full lg:w-full xl:w-1/2 lg:bg-white p-5">
                <livewire:frontend.contact-us>
            </div>
        </div>
    </div>
</div>
@endsection