@extends('frontend-layout')

@section('body-content')
{{-- hero section --}}
<div class="mx-auto overflow-hidden min-h-[50rem]" data-aos="zoom-in-up">
    <div class="absolute w-full h-full bg-center bg-cover">
        <video class="absolute top-0 left-0 object-cover w-full h-full" autoplay muted loop style="object-position: 50% 5%;">
            <source src="{{ asset('frontend/vid_banner.mp4') }}" type="video/mp4">
        </video>
    </div>
    <div class="relative h-auto sm:min-h-[50rem] w-full sm:container mx-auto md:rounded-2xl">
        <div class="min-h-[50rem] flex md:p-10">
            <div class="z-10 flex flex-col justify-center w-full gap-8 px-5 mt-[28rem] text-white">
                <div class="flex justify-center mt-4" >
                    <a class="bg-search-gradient text-3xl px-6 py-3 rounded-full border-2 border-white font-extrabold shadow-lg hover:bg-[#245D69] transition-colors duration-300 cursor-pointer hover:opacity-70" href="{{ route('listing-page') }}" wire:navigate>
                        BROWSE ITEMS
                    </a>
                </div>
                <div class="flex justify-center mt-4" >
                    <a class="bg-search-gradient text-2xl px-6 py-3 rounded-full border-2 border-white font-extrabold shadow-lg hover:bg-[#245D69] transition-colors duration-300 cursor-pointer hover:opacity-70" href="{{ route('dashboard') }}" wire:navigate>
                        SELL NOW
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Categories Section --}}
<div>
    <div class="container px-5 mx-auto mt-28">
        <h2 class="mb-4 text-3xl font-bold text-center sm:text-4xl text-slate-700">Explore Our Categories</h2>
        <p class="mb-12 text-lg text-center text-slate-500">Find the best deals and discover a wide range of products across various categories. Start exploring now!</p>
        <div class="flex flex-col gap-8 xl:flex-row">
            <div class="w-full mx-auto sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-2xl" data-aos="fade-right">
                <livewire:frontend.ads-listing/>
            </div>          
            <div class="flex flex-col justify-center flex-1 gap-4 px-5 md:px-0">
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
                <a class="flex flex-col flex-1 p-4 mb-4 transition-all border shadow-sm cursor-pointer bg-gray-50 min-w-56 border-slate-300 rounded-xl hover:border-sky-600" href="{{ $furniture }}" wire:navigate data-aos="fade-right">
                    <div>
                        <p class="text-xl font-bold text-gray-700">Furnitures</p>
                        <p class="text-gray-700">Discover a wide selection of sofas, tables, and chairs for sale, both new and used.</p>
                    </div>
                    {{-- <div class="flex justify-end flex-1 mt-3">
                        <img class="object-contain w-16" src="{{ asset('icon-img/lamp.png') }}" alt="">
                    </div> --}}
                </a>
                <a class="flex flex-col flex-1 p-4 mb-4 transition-all border shadow-sm cursor-pointer bg-gray-50 min-w-56 border-slate-300 rounded-xl hover:border-sky-600" href="{{ $electronic }}" wire:navigate data-aos="fade-right">
                    <div>
                        <p class="text-xl font-bold text-gray-700">Electronics</p>
                        <p class="text-gray-700">Explore deals on smartphones, laptops, and gadgets from leading brands.</p>
                    </div>
                    {{-- <div class="flex justify-end flex-1 mt-3">
                        <img class="object-contain w-16" src="{{ asset('icon-img/gadgets.png') }}" alt="">
                    </div> --}}
                </a>
                <a class="flex flex-col flex-1 p-4 mb-4 transition-all border shadow-sm cursor-pointer bg-gray-50 min-w-56 border-slate-300 rounded-xl hover:border-sky-600" href="{{ $vehicle }}" wire:navigate data-aos="fade-right">
                    <div>
                        <p class="text-xl font-bold text-gray-700">Vehicles</p>
                        <p class="text-gray-700">Find cars, trucks, motorcycles, and RVs for sale near you, both use.</p>
                    </div>
                    {{-- <div class="flex justify-end flex-1 mt-3">
                        <img class="object-contain w-16" src="{{ asset('icon-img/car.png') }}" alt="">
                    </div> --}}
                </a>
                <a class="flex flex-col flex-1 p-4 mb-4 transition-all border shadow-sm cursor-pointer bg-gray-50 min-w-56 border-slate-300 rounded-xl hover:border-sky-600" href="{{ $real_estate }}" wire:navigate data-aos="fade-right">
                    <div>
                        <p class="text-xl font-bold text-gray-700">Real Estate</p>
                        <p class="text-gray-700">Browse listings for apartments, houses, and commercial properties.</p>
                    </div>
                    {{-- <div class="flex justify-end flex-1 mt-3">
                        <img class="object-contain w-16" src="{{ asset('icon-img/house.png') }}" alt="">
                    </div> --}}
                </a>
                {{-- <div class="w-32 mb-4 transition-all bg-gray-100 shadow-md cursor-pointer rounded-l-xl hover:border hover:bg-gray-200" data-aos="fade-right">
                    <a href="{{ route('listing-page') }}" wire:navigate>
                        <div class="flex flex-col items-center justify-center h-full gap-4">
                            <div class="p-3 border rounded-full bg-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </div>
                            <p class="font-medium text-slate-600">See all</p>
                        </div>
                    </a>
                </div> --}}
            </div>
        </div>
        <div class="flex justify-center mt-12">
            <a href="{{ route('listing-page') }}" wire:navigate>
                <div class="bg-[#2171a7] px-8 py-3 rounded-full text-white font-bold text-lg shadow-lg hover:bg-[#1a5b8a] transition-transform transform hover:scale-105 cursor-pointer">
                    See All Categories
                </div>
            </a>
        </div>
    </div>
    
    {{-- Featured Section --}}
    {{-- <div class="container px-5 mx-auto mt-28"> --}}
        {{-- <div class="flex flex-col items-center gap-4 mb-4" data-aos="zoom-in">
            <h1 class="text-3xl font-bold text-center sm:text-4xl text-slate-700">Featured Products</h1>
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
        
        <div id="products" class="p-5 bg-white rounded-lg shadow-lg sm:p-10" data-aos="zoom-in">
            <div class="md:mx-12 lg:mx-20 xl:mx-auto">
                <div class="mt-6 mb-8 space-y-5 text-center">
                    <div class="inline-block px-4 py-2 text-lg font-semibold text-white rounded-full bg-[#2171a7] shadow-md hover:bg-[#1e65a4] transition-colors">
                        Fresh recommended ads
                    </div>
                </div>
                <livewire:frontend.sponsored-listing>
            </div>
        </div> --}}
    {{-- </div> --}}
</div>

<div class="relative mt-28 h-96">
    <div class="absolute w-full h-full bg-top bg-cover bg-brainstorm brightness-50" style="background-position: 30% 60%;">
    </div>
    <div class="absolute top-0 flex flex-col items-center justify-center w-full h-full font-darkerGrotesque">
        <p class="px-5 text-5xl text-center text-white">Find what you need</p>
        <p class="px-5 text-5xl text-center text-white">in <span class="text-yellow-200">Alaska</span></p>
    </div>
</div>

<div class="relative border py-28 bg-gradient-to-b from-gray-50 to-white" data-aos="fade-up">
    <div class="container px-6 mx-auto md:px-12">
        <div class="mb-12 text-center">
            <h1 class="text-3xl font-bold text-center sm:text-4xl text-slate-700">
                Share Your Treasures with Us
            </h1>
            <p class="max-w-2xl mx-auto mt-4 text-lg text-slate-500">
                Join our community and start listing your valuable items today. It’s fast, easy, and secure.
            </p>
        </div>

        <div class="flex flex-col items-center max-w-6xl gap-8 px-8 py-10 mx-auto bg-white shadow-xl lg:flex-row lg:space-x-8 lg:gap-0 rounded-xl">
            <!-- Step 1: Register -->
            <div class="flex-1 transition-transform transform hover:scale-105">
                <div class="flex items-center mb-6 space-x-4">
                    <div class="flex items-center justify-center text-xl font-bold text-white rounded-full h-14 w-14">
                        <img src="{{ asset('frontend/signup.png') }}" alt="">
                    </div>
                    <p class="text-xl font-semibold text-slate-800">Register</p>
                </div>
                <p class="text-base text-slate-600">
                    Become part of our community by creating an account. It’s quick and easy, allowing you to start listing your treasures immediately.
                </p>
            </div>
            
            <!-- Step 2: Login -->
            <div class="flex-1 transition-transform transform hover:scale-105">
                <div class="flex items-center mb-6 space-x-4">
                    <div class="flex items-center justify-center text-xl font-bold text-white rounded-full h-14 w-14">
                        <img src="{{ asset('frontend/login.png') }}" alt="">
                    </div>
                    <p class="text-xl font-semibold text-slate-800">Login</p>
                </div>
                <p class="text-base text-slate-600">
                    Securely access your account to manage your listings. Login keeps your details safe and ensures easy management of your items.
                </p>
            </div>
            
            <!-- Step 3: Upload Your Treasures -->
            <div class="flex-1 transition-transform transform hover:scale-105">
                <div class="flex items-center mb-6 space-x-4">
                    <div class="flex items-center justify-center text-xl font-bold text-white rounded-full h-14 w-14">
                        <img src="{{ asset('frontend/photo.png') }}" alt="">
                    </div>
                    <p class="text-xl font-semibold text-slate-800">Upload Your Treasures</p>
                </div>
                <p class="text-base text-slate-600">
                    Ready to make a sale? Upload your items with clear descriptions and set a fair price to attract potential buyers quickly.
                </p>
            </div>
        </div>
        <div class="flex justify-center mt-12">
            <a href="{{ route('register') }}" wire:navigate>
                <div class="bg-[#2171a7] px-8 py-3 rounded-full text-white font-bold text-lg shadow-lg hover:bg-[#1a5b8a] transition-transform transform hover:scale-105 cursor-pointer">
                    Get Started
                </div>
            </a>
        </div>
    </div>
</div>

<div class="relative py-28" data-aos="fade-up">
    <div class="container px-6 mx-auto md:px-12">
        <div class="mb-12 text-center">
            <h1 class="text-3xl font-bold text-center sm:text-4xl text-slate-700">
                Frequently Asked Questions
            </h1>
            <p class="max-w-2xl mx-auto mt-4 text-lg text-slate-500">
                Here are some of the most common frequently asked questions
            </p>
        </div>
        <div x-data="{ 
                activeAccordion: '', 
                setActiveAccordion(id) { 
                    this.activeAccordion = (this.activeAccordion == id) ? '' : id 
                } 
            }" class="relative w-full max-w-4xl p-5 mx-auto text-lg bg-white shadow-md sm:p-8 rounded-2xl">

            <div x-data="{ id: $id('accordion') }" :class="{ 'border-neutral-200/60 text-neutral-800' : activeAccordion==id, 'border-transparent text-neutral-600 hover:text-neutral-800' : activeAccordion!=id }" class="duration-200 ease-out bg-white border rounded-md cursor-pointer group" x-cloak>
                <button @click="setActiveAccordion(id)" class="flex items-center justify-between w-full px-5 py-4 font-semibold text-left select-none">
                    <span>How do I create a listing?</span>
                    <div :class="{ 'rotate-90': activeAccordion==id }" class="relative flex items-center justify-center w-2.5 h-2.5 shrink-0 duration-300 ease-out">
                        <div class="absolute w-0.5 h-full bg-neutral-500 group-hover:bg-neutral-800 rounded-full"></div>
                        <div :class="{ 'rotate-90': activeAccordion==id }" class="absolute w-full h-0.5 ease duration-500 bg-neutral-500 group-hover:bg-neutral-800 rounded-full"></div>
                    </div>
                </button>
                <div x-show="activeAccordion==id" x-collapse x-cloak>
                    <div class="p-5 pt-0 opacity-70">
                        To create a listing, simply log in to your account, navigate to the 'Listing' page, fill out the required details including title, description, price, and category, then upload clear photos of your item, and finally, click 'Submit' to post your listing.
                    </div>
                </div>
            </div>
            <div x-data="{ id: $id('accordion') }" :class="{ 'border-neutral-200/60 text-neutral-800' : activeAccordion==id, 'border-transparent text-neutral-600 hover:text-neutral-800' : activeAccordion!=id }" class="duration-200 ease-out bg-white border rounded-md cursor-pointer group" x-cloak>
                <button @click="setActiveAccordion(id)" class="flex items-center justify-between w-full px-5 py-4 font-semibold text-left select-none">
                    <span>How do I ensure my safety when buying or selling?</span>
                    <div :class="{ 'rotate-90': activeAccordion==id }" class="relative flex items-center justify-center w-2.5 h-2.5 shrink-0 duration-300 ease-out">
                        <div class="absolute w-0.5 h-full bg-neutral-500 group-hover:bg-neutral-800 rounded-full"></div>
                        <div :class="{ 'rotate-90': activeAccordion==id }" class="absolute w-full h-0.5 ease duration-500 bg-neutral-500 group-hover:bg-neutral-800 rounded-full"></div>
                    </div>
                </button>
                <div x-show="activeAccordion==id" x-collapse x-cloak>
                    <div class="p-5 pt-0 opacity-70">
                        Your safety is our priority. We recommend meeting in public places for transactions, bringing a friend along, and avoiding sharing personal information online. Always trust your instincts, and if something feels off, it’s okay to walk away.
                    </div>
                </div>
            </div>
            <div x-data="{ id: $id('accordion') }" :class="{ 'border-neutral-200/60 text-neutral-800' : activeAccordion==id, 'border-transparent text-neutral-600 hover:text-neutral-800' : activeAccordion!=id }" class="duration-200 ease-out bg-white border rounded-md cursor-pointer group" x-cloak>
                <button @click="setActiveAccordion(id)" class="flex items-center justify-between w-full px-5 py-4 font-semibold text-left select-none">
                    <span>What types of items are prohibited on the platform?</span>
                    <div :class="{ 'rotate-90': activeAccordion==id }" class="relative flex items-center justify-center w-2.5 h-2.5 shrink-0 duration-300 ease-out">
                        <div class="absolute w-0.5 h-full bg-neutral-500 group-hover:bg-neutral-800 rounded-full"></div>
                        <div :class="{ 'rotate-90': activeAccordion==id }" class="absolute w-full h-0.5 ease duration-500 bg-neutral-500 group-hover:bg-neutral-800 rounded-full"></div>
                    </div>
                </button>
                <div x-show="activeAccordion==id" x-collapse x-cloak>
                    <div class="p-5 pt-0 opacity-70">
                        Items that are illegal, harmful, or violate our community guidelines are strictly prohibited. This includes weapons, counterfeit goods, stolen property, and adult content. Please review our full list of prohibited items before posting.
                    </div>
                </div>
            </div>
            <div x-data="{ id: $id('accordion') }" :class="{ 'border-neutral-200/60 text-neutral-800' : activeAccordion==id, 'border-transparent text-neutral-600 hover:text-neutral-800' : activeAccordion!=id }" class="duration-200 ease-out bg-white border rounded-md cursor-pointer group" x-cloak>
                <button @click="setActiveAccordion(id)" class="flex items-center justify-between w-full px-5 py-4 font-semibold text-left select-none">
                    <span>How can I boost my ad to get more visibility?</span>
                    <div :class="{ 'rotate-90': activeAccordion==id }" class="relative flex items-center justify-center w-2.5 h-2.5 shrink-0 duration-300 ease-out">
                        <div class="absolute w-0.5 h-full bg-neutral-500 group-hover:bg-neutral-800 rounded-full"></div>
                        <div :class="{ 'rotate-90': activeAccordion==id }" class="absolute w-full h-0.5 ease duration-500 bg-neutral-500 group-hover:bg-neutral-800 rounded-full"></div>
                    </div>
                </button>
                <div x-show="activeAccordion==id" x-collapse x-cloak>
                    <div class="p-5 pt-0 opacity-70">
                        You can boost your ad by selecting one of our premium listing options. Boosted ads appear at the top of search results and can increase your chances of making a sale. Check the “Advertise with Us” section for more details.
                    </div>
                </div>
            </div>
            <div x-data="{ id: $id('accordion') }" :class="{ 'border-neutral-200/60 text-neutral-800' : activeAccordion==id, 'border-transparent text-neutral-600 hover:text-neutral-800' : activeAccordion!=id }" class="duration-200 ease-out bg-white border rounded-md cursor-pointer group" x-cloak>
                <button @click="setActiveAccordion(id)" class="flex items-center justify-between w-full px-5 py-4 font-semibold text-left select-none">
                    <span>What should I do if I encounter a suspicious ad or user?</span>
                    <div :class="{ 'rotate-90': activeAccordion==id }" class="relative flex items-center justify-center w-2.5 h-2.5 shrink-0 duration-300 ease-out">
                        <div class="absolute w-0.5 h-full bg-neutral-500 group-hover:bg-neutral-800 rounded-full"></div>
                        <div :class="{ 'rotate-90': activeAccordion==id }" class="absolute w-full h-0.5 ease duration-500 bg-neutral-500 group-hover:bg-neutral-800 rounded-full"></div>
                    </div>
                </button>
                <div x-show="activeAccordion==id" x-collapse x-cloak>
                    <div class="p-5 pt-0 opacity-70">
                        If you come across an ad or user that seems suspicious, please report it immediately using the "Report" button on the listing page. Our team will review the report and take appropriate action to maintain the safety and integrity of our platform.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Get In Touch --}}
<div id="get-in-touch" class="container px-5 mx-auto mb-28" data-aos="zoom-in">
    <div class="flex flex-col items-center gap-4 mb-14">
        <h1 class="text-3xl font-bold text-center sm:text-4xl text-slate-700">Get In Touch</h1>
        <p class="text-lg text-center text-slate-500">Contact us using the information below. We'll respond promptly to your inquiries and feedback</p>
    </div>
    <div class="px-5 md:px-0">
        <div class="flex w-full max-w-6xl mx-auto overflow-hidden rounded-lg shadow-lg lg:rounded-full lg:shadow">
            <div class="hidden w-full mb-4 lg:block lg:w-1/2 md:mb-0">
                <img class="h-[38rem] w-full object-cover bg-center" src="{{ asset('frontend/contact.jpg') }}" alt="Contact Image" loading="lazy">
            </div>
            <div class="flex items-center justify-center w-full p-5 lg:w-full xl:w-1/2 lg:bg-white">
                <livewire:frontend.contact-us>
            </div>
        </div>
    </div>
</div>
@endsection