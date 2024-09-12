@extends('frontend-layout')

@section('body-content')
{{-- hero section --}}
<div class="relative h-72">
    <div class="absolute w-full h-full bg-top bg-cover" style="background-image: url('{{ asset('frontend/alaska-bg.jpg') }}'); background-position: 30% 60%;">
    </div>
    <div class="absolute inset-0 z-20 w-full h-full bg-search-gradient opacity-70">
    </div>
    <div class="absolute inset-0 z-30 flex items-center justify-center">
        <div class="container px-5 mx-auto font-sans text-2xl font-semibold text-white text-shadow-custom sm:text-4xl">
            <p>ONE STOP SHOP</p>
            <p>FOR ALL ALASKAN GOODS!</p>
        </div>
    </div>
    <div class="absolute inset-x-0 bottom-0 z-30 translate-y-1/2 ">
        <div class="container px-5 mx-auto">
            <livewire:frontend.home-search />
        </div>
    </div>
</div>

{{-- Categories Section --}}
<div>
    <div class="container w-full px-5 mx-auto sm:max-w-4xl mt-28">
        <livewire:frontend.categories />
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
</div>

<div class="relative border py-28 bg-gradient-to-b from-gray-50 to-white" data-aos="fade-up">
    <div class="container px-6 mx-auto md:px-12">
        <div class="mb-12 text-center">
            <h1 class="text-3xl font-bold text-center sm:text-4xl text-slate-700">
                Share Your Treasures with Us
            </h1>
            <p class="max-w-3xl mx-auto mt-4 text-lg text-slate-500">
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