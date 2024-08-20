@extends('frontend-layout')

@section('body-content')
{{-- hero section --}}
<div class="mx-auto overflow-hidden h-[37rem] md:min-h-[50rem] lg:min-h-[50rem]" data-aos="zoom-in-up">
    <div class="absolute w-full h-full bg-center bg-cover">
        <video class="absolute top-0 left-0 object-cover w-auto h-[20rem] sm:h-full sm:w-full" autoplay muted loop style="object-position: 50% 5%;">
            <source src="{{ asset('frontend/vid_banner.mp4') }}" type="video/mp4">
        </video>
    </div>
    <div class="relative w-full h-auto mx-auto sm:container md:rounded-2xl">
        <div class="min-h-[50rem] flex md:p-10">
            <div class="z-10 flex flex-col justify-center w-full gap-8 px-5 mt-[5rem] md:mt-[30rem] lg:mt-[28rem] text-white">
                <div class="flex justify-center mt-4" >
                    <a class="bg-search-gradient text-2xl sm:text-3xl px-6 py-3 rounded-full sm:border-2 sm:border-white font-extrabold shadow-lg hover:bg-[#245D69] transition-colors duration-300 cursor-pointer hover:opacity-70 " href="{{ route('listing-page') }}" wire:navigate>
                        BROWSE ITEMS
                    </a>
                </div>  
                <div class="flex justify-center mt-2 sm:mt-4" >
                    <a class="bg-search-gradient text-xl sm:text-2xl px-6 py-3 rounded-full sm:border-2 sm:border-white font-extrabold shadow-lg hover:bg-[#245D69] transition-colors duration-300 cursor-pointer hover:opacity-70" href="{{ route('dashboard') }}" wire:navigate>
                        SELL NOW
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Categories Section --}}
<div>
    <div class="container px-5 mx-auto mt-0 sm:mt-28">
        <div class="flex flex-col items-center">
            <h2 class="mb-4 text-3xl font-bold text-center sm:text-4xl text-slate-700">Discover Top Deals in Alaska</h2>
            <p class="max-w-3xl mb-12 text-lg text-center text-slate-500">Explore unbeatable offers and a wide range of products and services across Alaska. Alaska List is your go-to marketplace for finding top deals in your local area. Start your search today!</p>
        </div>
    </div>

    <div class="w-full mt-14 bg-search-gradient">
        <div class="container relative px-5 mx-auto -top-8">                
            <div class="mx-auto max-w-7xl" data-aos="fade-right">
                <livewire:frontend.sponsored-listing/>
            </div>
        </div>
    </div>
    
    <div class="container px-5 mx-auto mt-14">
        <div class="flex flex-col gap-8 m-auto max-w-8xl">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
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
                {{-- <a class="flex flex-col p-4 transition-all border shadow-sm cursor-pointer min-w-fit bg-gray-50 max-w-56 border-slate-300 rounded-xl hover:border-sky-600" href="{{ $furniture }}" wire:navigate data-aos="fade-right"> --}}
                <a class="flex flex-col p-4 transition-all border shadow-sm cursor-pointer min-w-fit bg-gray-50 max-w-56 border-slate-300 rounded-xl hover:border-sky-600" href="{{ route('listing-page') }}" wire:navigate data-aos="fade-right">
                    <p class="text-xl font-bold text-gray-700">Furnitures</p>
                    <p class="text-gray-700">Discover a wide selection of sofas, tables, and chairs for sale, both new and used.</p>
                </a>
                {{-- <a class="flex flex-col p-4 transition-all border shadow-sm cursor-pointer min-w-fit bg-gray-50 max-w-56 border-slate-300 rounded-xl hover:border-sky-600" href="{{ $electronic }}" wire:navigate data-aos="fade-right"> --}}
                <a class="flex flex-col p-4 transition-all border shadow-sm cursor-pointer min-w-fit bg-gray-50 max-w-56 border-slate-300 rounded-xl hover:border-sky-600" href="{{ route('listing-page') }}" wire:navigate data-aos="fade-right">
                    <div>
                        <p class="text-xl font-bold text-gray-700">Electronics</p>
                        <p class="text-gray-700">Explore deals on smartphones, laptops, and gadgets from leading brands.</p>
                    </div>
                </a>
                {{-- <a class="flex flex-col p-4 transition-all border shadow-sm cursor-pointer min-w-fit bg-gray-50 max-w-56 border-slate-300 rounded-xl hover:border-sky-600" href="{{ $vehicle }}" wire:navigate data-aos="fade-right"> --}}
                <a class="flex flex-col p-4 transition-all border shadow-sm cursor-pointer min-w-fit bg-gray-50 max-w-56 border-slate-300 rounded-xl hover:border-sky-600" href="{{ route('listing-page')}}" wire:navigate data-aos="fade-right">
                    <div>
                        <p class="text-xl font-bold text-gray-700">Vehicles</p>
                        <p class="text-gray-700">Find cars, trucks, motorcycles, and RVs for sale near you, both use.</p>
                    </div>
                </a>
                {{-- <a class="flex flex-col p-4 transition-all border shadow-sm cursor-pointer min-w-fit bg-gray-50 max-w-56 border-slate-300 rounded-xl hover:border-sky-600" href="{{ $real_estate }}" wire:navigate data-aos="fade-right"> --}}
                <a class="flex flex-col p-4 transition-all border shadow-sm cursor-pointer min-w-fit bg-gray-50 max-w-56 border-slate-300 rounded-xl hover:border-sky-600" href="{{ route('listing-page')}}" wire:navigate data-aos="fade-right">
                    <div>
                        <p class="text-xl font-bold text-gray-700">Real Estate</p>
                        <p class="text-gray-700">Browse listings for apartments, houses, and commercial properties.</p>
                    </div>
                </a>
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
</div>

<div class="relative mt-28 h-96">
    <div class="absolute w-full h-full bg-top bg-cover" style="background-image: url('{{ asset('frontend/alaska-bg.jpg') }}'); background-position: 30% 60%;">
    </div>
    <div class="absolute inset-0 z-10 w-full h-full bg-search-gradient opacity-70">
    </div>
    <div class="absolute z-20 flex flex-col items-center w-full h-full top-8 font-bebasNeue">
        <p class="px-5 text-[4rem] font-bold text-center text-white text-shadow-custom">
            FIND WHAT YOU NEED IN <span class="">ALASKA</span>
        </p>    
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
                <button @click="setActiveAccordion(id)" class="flex items-center justify-between w-full gap-4 px-5 py-4 font-semibold text-left select-none">
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
                <button @click="setActiveAccordion(id)" class="flex items-center justify-between w-full gap-4 px-5 py-4 font-semibold text-left select-none">
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
                <button @click="setActiveAccordion(id)" class="flex items-center justify-between w-full gap-4 px-5 py-4 font-semibold text-left select-none">
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
                <button @click="setActiveAccordion(id)" class="flex items-center justify-between w-full gap-4 px-5 py-4 font-semibold text-left select-none">
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
                <button @click="setActiveAccordion(id)" class="flex items-center justify-between w-full gap-4 px-5 py-4 font-semibold text-left select-none">
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


@endsection