@extends('frontend-layout')

@section('body-content')
<div class="relative overflow-hidden pb-28" data-aos="zoom-in-up">
    <div class="relative bg-search-gradient h-80">
        <div class="absolute w-full h-full bg-top bg-cover" style="background-image: url('{{ asset('frontend/alaska-bg.jpg') }}'); background-position: 30% 60%;">
        </div>
        <div class="absolute inset-0 z-20 w-full h-full bg-search-gradient opacity-70">
        </div>
        <div class="absolute inset-0 z-30 flex items-center justify-center">
            <div class="container px-5 mx-auto font-sans font-semibold text-white text-shadow-custom sm:text-4xl">
                <p class="text-4xl">About Us</p>
                <p class="text-lg">Your go-to platform for buying, selling, and connecting with Alaskans.</p>
            </div>
        </div>
    </div>
    <div class="container px-5 mx-auto mt-28">
        <div class="flex flex-col gap-8 md:flex-row">
            <div class="flex flex-col gap-8 2xl:flex-row">
                <div class="max-w-xl overflow-hidden rounded-lg">
                    <img src="{{ asset('frontend/mountain.jpg') }}" alt="Our Team at Work">
                </div>
                <div class="space-y-8 text-slate-600">
                    <p class="max-w-2xl text-lg">
                        We believe in the power of community and the importance of local connections. Our platform is designed to bring people together, making it easy to buy, sell, and discover unique items within your area. 
                    </p>
                    <p class="max-w-2xl text-lg">
                        Our team is dedicated to creating a safe and user-friendly environment where everyone can find what they need, whether it's a rare find or a great deal. We are here to support your transactions every step of the way.
                    </p>
                    <a class="flex" href="/advertise-with-us#get-in-touch" wire:navigate>
                        <div class="border border-[#2171a7] px-6 py-3 rounded-lg shadow-md hover:bg-[#2171a7] hover:text-white transition-colors duration-300 cursor-pointer">
                            Get In Touch
                        </div>
                    </a>
                </div>
            </div>
            <div>
                <livewire:frontend.sidebar-sponsor>
            </div>   
        </div>
    </div>
</div>
@endsection