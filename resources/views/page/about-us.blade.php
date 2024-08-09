@extends('frontend-layout')

@section('body-content')
<div class="px-5 py-14">
    <div class="container mx-auto space-y-28" data-aos="zoom-in-up">
        <div class="text-center">
            <p class="mb-4 text-4xl font-bold">About Us</p>
            <p class="text-lg text-slate-600">Connecting communities through trusted local marketplaces.</p>
        </div>
        <div class="flex flex-col items-center justify-center gap-8 lg:flex-row">
            <div class="max-w-2xl overflow-hidden rounded-lg">
                <img src="{{ asset('frontend/about-us.jpg') }}" alt="Our Team at Work">
            </div>
            <div class="space-y-8 text-slate-600">
                <p class="max-w-2xl text-lg">
                    We believe in the power of community and the importance of local connections. Our platform is designed to bring people together, making it easy to buy, sell, and discover unique items within your area. 
                </p>
                <p class="max-w-2xl text-lg">
                    Our team is dedicated to creating a safe and user-friendly environment where everyone can find what they need, whether it's a rare find or a great deal. We are here to support your transactions every step of the way.
                </p>
                <a class="flex" href="/#get-in-touch">
                    <div class="border border-[#2171a7] px-6 py-3 rounded-lg shadow-md hover:bg-[#2171a7] hover:text-white transition-colors duration-300 cursor-pointer">
                        Get In Touch
                    </div>
                </a>
            </div>
        </div>

        <!-- Our Values Section -->
        <div class="p-8 bg-white rounded-lg shadow-lg">
            <div class="mb-8 text-center">
                <h2 class="text-4xl font-bold text-gray-800">Our Values</h2>
                <p class="mt-2 text-lg text-gray-600">
                    Integrity, Innovation, and Community at the Core of What We Do
                </p>
            </div>
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Value 1 -->
                <div class="flex flex-col items-center">
                    <div class="p-4 text-white bg-blue-500 rounded-full shadow-lg">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-gray-800">Community</h3>
                    <p class="mt-2 text-center text-gray-600">
                        We believe in fostering a community where everyone feels welcome and valued.
                    </p>
                </div>
                <!-- Value 2 -->
                <div class="flex flex-col items-center">
                    <div class="p-4 text-white bg-green-500 rounded-full shadow-lg">
                        <i class="fas fa-lock fa-2x"></i>
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-gray-800">Security</h3>
                    <p class="mt-2 text-center text-gray-600">
                        Your safety and privacy are our top priorities. We ensure your transactions are secure.
                    </p>
                </div>
                <!-- Value 3 -->
                <div class="flex flex-col items-center">
                    <div class="p-4 text-white bg-yellow-500 rounded-full shadow-lg">
                        <i class="fas fa-lightbulb fa-2x"></i>
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-gray-800">Innovation</h3>
                    <p class="mt-2 text-center text-gray-600">
                        We're always evolving, finding new ways to improve your experience on our platform.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection