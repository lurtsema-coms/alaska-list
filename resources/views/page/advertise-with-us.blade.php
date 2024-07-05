@extends('frontend-layout')

@section('body-content')
<div class="relative my-14 px-5">
    <div class="absolute inset-0 bg-no-repeat bg-cover opacity-25 bg-scattered"></div>

    <div id="advertise-with-us" class="container mx-auto" data-aos="zoom-in-up">
        <h2 class="text-center text-4xl font-bold text-gray-800 mb-4">Advertise with us</h2>
        <p class="text-center text-gray-600 mb-4">Boost your listing to the top and gain maximum visibility!</p>
    
        <div class="mb-6">
            <h3 class="text-xl font-semibold text-gray-700">Advertising Plans</h3>
            <div class="space-y-4 mt-2">
                <div class="bg-gray-50 p-4 rounded-md shadow-md">
                    <h4 class="text-lg font-semibold text-gray-800">Daily Boost</h4>
                    <p class="text-gray-600">Move your listing to the top for 24 hours. Perfect for a quick visibility spike.</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-md shadow-md">
                    <h4 class="text-lg font-semibold text-gray-800">Weekly Spotlight</h4>
                    <p class="text-gray-600">Keep your listing at the top for an entire week. Great for sustained attention.</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-md shadow-md">
                    <h4 class="text-lg font-semibold text-gray-800">Monthly Premium</h4>
                    <p class="text-gray-600">Enjoy top-of-page placement for a whole month. Ideal for long-term promotions and continuous exposure.</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-md shadow-md">
                    <h4 class="text-lg font-semibold text-gray-800">Custom Packages</h4>
                    <p class="text-gray-600">Need something specific? Contact us for tailored advertising solutions that fit your exact needs.</p>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="text-xl font-semibold text-gray-700">Why Choose Our Advertising Options?</h3>
            <ul class="list-disc pl-5 text-gray-600 mt-2 space-y-2">
                <li>Prominent Placement</li>
                <li>Enhanced Exposure</li>
                <li>Targeted Audience</li>
                <li>Flexible Plans</li>
            </ul>
        </div>
    
        <div class="mb-6">
            <h3 class="text-xl font-semibold text-gray-700">How It Works</h3>
            <ol class="list-decimal pl-5 text-gray-600 mt-2 space-y-2">
                <li>Choose Your Category</li>
                <li>Select Your Plan</li>
                <li>Promote Your Listing</li>
                <li>Watch the Views Roll In</li>
            </ol>
        </div>
    
        <div class="mt-6">
            <h3 class="text-xl font-semibold text-gray-700">Get Started Today!</h3>
            <p class="text-gray-600 mb-4">Ready to boost your listing and attract more customers? It’s easy to get started. Just <a href="#" class="text-blue-600 underline">sign in</a> to your account and select the "Advertise with Us" option from your dashboard. Choose your plan, promote your listing, and watch your visibility soar!</p>
            <p class="text-gray-600">For any questions or custom advertising needs, feel free to <a href="/#get-in-touch" class="text-blue-600 underline">contact us</a>. Our team is here to help you succeed.</p>
        </div>
    </div>
</div>
@endsection