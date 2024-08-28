@extends('frontend-layout')

@section('body-content')
<div class="relative overflow-hidden pb-28" data-aos="zoom-in-up">
    <div class="bg-search-gradient py-14">
        <div class="container px-5 mx-auto">            
            <h2 class="text-4xl font-bold text-white">About Us</h2>
            <p class="text-lg text-neutral-300">Connecting communities through trusted local marketplaces.</p>
        </div>
    </div>
    <div class="container px-5 mx-auto mt-28">
        <div class="flex flex-col gap-8 md:flex-row">
            <div class="flex flex-col gap-8 2xl:flex-row">
                <div class="max-w-xl overflow-hidden rounded-lg">
                    <img src="{{ asset('frontend/about-us.jpg') }}" alt="Our Team at Work">
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