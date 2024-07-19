@extends('frontend-layout')

@section('body-content')
<div class="py-14 px-5">
    <div class="container mx-auto space-y-28" data-aos="zoom-in-up">
        <div class="text-center">
            <p class="text-4xl mb-4 font-bold">About Us</p>
            <p class="text-slate-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero, officiis.</p>
        </div>
        <div class="flex items-center flex-col gap-8 lg:flex-row">
            <div class="max-w-2xl rounded-lg overflow-hidden">
                <img src="{{ asset('frontend/work-team-digital-art.jpg') }}" alt="">
            </div>
            <div class="space-y-8 text-slate-600">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt quod nostrum provident possimus voluptatum enim temporibus aliquam ex voluptates. Assumenda est esse eligendi sapiente totam minima magnam quas qui dignissimos nulla. Commodi aliquid voluptatem assumenda, libero pariatur ipsam eligendi aspernatur, obcaecati ab veritatis, ipsa consequuntur eaque quasi. Voluptatum, id dolorem.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab illum perspiciatis ut repudiandae, explicabo ullam error est minus ipsa nostrum unde, eius earum aliquam voluptatibus modi similique? Odio, delectus reprehenderit.</p>
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