@extends('frontend-layout')

@section('body-content')
<div class="relative px-5 my-14">
    <div class="absolute inset-0 bg-no-repeat bg-cover opacity-25 bg-scattered"></div>

    <div id="advertise-with-us" class="container mx-auto" data-aos="zoom-in-up">
        <h2 class="mb-4 text-4xl font-bold text-center text-gray-800">Advertise with us</h2>
        <p class="mb-4 text-center text-gray-600">Boost your listing to the top and gain maximum visibility!</p>
    
        <div class="mt-12 mb-6">
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
                    Go to the Contact Page
                    <p class="ml-4">Navigate to our contact page to start the process of promoting your product.</p>
                </li>
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

    
        <div class="mt-6">
            <h3 class="text-xl font-semibold text-gray-700">Get Started Today!</h3>
            <p class="text-gray-600">For any questions or custom advertising needs, feel free to <a href="/#get-in-touch" class="text-blue-600 underline">contact us</a>. Our team is here to help you succeed.</p>
        </div>
    </div>
</div>
@endsection