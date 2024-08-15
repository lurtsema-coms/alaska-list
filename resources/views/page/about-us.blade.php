@extends('frontend-layout')

@section('body-content')
<div class="px-5 pb-28 pt-14">
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
    </div>
</div>
@endsection