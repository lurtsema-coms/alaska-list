@extends('frontend-layout')

@section('body-content')
<div data-aos="zoom-in-up">
    <div class="bg-search-gradient py-14">
        <div class="container px-5 mx-auto">            
            <h2 class="text-4xl font-bold text-white">Advertise with us</h2>
            <p class="text-lg text-neutral-300">Boost your listing to the top and gain maximum visibility!</p>
        </div>
    </div>
    <div class="container relative px-5 mx-auto my-14">
        <div class="flex flex-col gap-8 md:flex-row">
            <div>
                <div id="advertise-with-us">
                    <div class="mb-6">
                        <h3 class="text-xl font-semibold text-gray-700">Advertising Plans</h3>
                        @php
                            $plans = App\Models\AdvertisingPlan::all(); // Fetch all products
                        @endphp
                        <div class="mt-2 space-y-4">
                            @foreach ($plans as $plan)
                                <div class="p-4 rounded-md shadow-md bg-gray-50">
                                    <h4 class="text-lg font-semibold text-gray-800">{{ $plan->name }}</h4>
                                    <p class="text-gray-600">{{ $plan->description }}.</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-xl font-semibold text-gray-700">Why Choose Our Advertising Options?</h3>
                        <ul class="pl-5 mt-2 space-y-2 text-gray-600 list-disc">
                            <li>Prominent Placement</li>
                            <li>Enhanced Exposure</li>
                            <li>Targeted Audience</li>
                            <li>Flexible Plans</li>
                        </ul>
                    </div>
                
                    <div class="mb-6">
                        <h3 class="text-xl font-semibold text-gray-700">How It Works</h3>
                        <ol class="pl-5 mt-2 space-y-2 text-gray-600 list-decimal">
                            <li>
                                Send a Message in the Contact Form
                                <p class="ml-4">Fill out the contact form with your product details and promotion requirements.</p>
                            </li>
                            <li>
                                Coordinate with Us
                                <p class="ml-4">Our team will get in touch with you to discuss the best plan for promoting your product.</p>
                            </li>
                            <li>
                                Your Product is on the Top of the Listing
                                <p class="ml-4">After finalizing the details, your product will be prominently displayed at the top of our listings.</p>
                            </li>
                        </ol>
                    </div>
                </div>

                {{-- Get In Touch --}}
                <div id="get-in-touch" class="container mx-auto my-28" data-aos="zoom-in">
                    <div class="flex flex-col items-center gap-4 mb-14">
                        <h1 class="text-3xl font-bold text-center sm:text-4xl text-slate-700">Get In Touch</h1>
                        <p class="text-lg text-center text-slate-500">Contact us using the information below. We'll respond promptly to your inquiries and feedback</p>
                    </div>
                    <div class="px-5 md:px-0">
                        <div class="flex w-full max-w-6xl mx-auto overflow-hidden rounded-lg shadow-lg xl:rounded-full xl:shadow">
                            <div class="hidden w-full mb-4 xl:block xl:w-1/2 md:mb-0">
                                <img class="h-[38rem] w-full object-cover bg-center" src="{{ asset('frontend/contact.jpg') }}" alt="Contact Image" loading="lazy">
                            </div>
                            <div class="flex items-center justify-center w-full p-5 lg:w-full xl:w-1/2 lg:bg-white">
                                <livewire:frontend.contact-us>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <livewire:frontend.sidebar-sponsor>
            </div> 
        </div>
    </div>
</div>
@endsection