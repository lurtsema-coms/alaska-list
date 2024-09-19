<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
    <div class="flex flex-row items-center px-6 py-8 mt-10  shadow-sm rounded-xl">
        <div class="">
            <div class=" max-w-6xl px-8">
                <h1 class="text-xl font-bold text-[#2171a7] underline">
                    Share Your Treasures with Us
                </h1>
                <p class="max-w-3xl mx-auto mt-4 text-md text-slate-500">
                    Join our community and start listing your valuable items today. It’s fast, easy, and secure.
                </p>
            </div>
            <div class="flex flex-col items-center max-w-6xl gap-8 px-8 py-10 mx-auto ">
                <div class="flex flex-col transition-transform transform hover:scale-105">
                    <div class="flex flex-row items-center mb-6 space-x-4">
                        <div class="h-14 w-14">
                            <img src="{{ asset('frontend/signup.png') }}" alt="">
                        </div>
                        <p class="text-xl font-semibold text-[#2171a7]">Register</p>
                    </div>
                    <div class=" text-justify">
                        <span class="text-base text-slate-600">
                            Become part of our community by creating an account. It’s quick and easy, allowing you to start listing your treasures immediately.
                        </span>
                    </div>
                </div>
                <div class="flex flex-col transition-transform transform hover:scale-105">
                    <div class="flex flex-row  items-center mb-6 space-x-4">
                        <div class="h-14 w-14">
                            <img src="{{ asset('frontend/login.png') }}" alt="">
                        </div>
                        <p class="text-xl font-semibold text-[#2171a7]">Login</p>
                    </div>
                    <div class=" text-justify">
                        <span class="text-base text-slate-600">
                            Securely access your account to manage your listings. Login keeps your details safe and ensures easy management of your items.
                        </span>
                    </div>
                </div>
                <div class="flex flex-col transition-transform transform hover:scale-105">
                    <div class="flex flex-row items-center mb-6 space-x-4">
                        <div class="h-14 w-14">
                            <img src="{{ asset('frontend/photo.png') }}" alt="">
                        </div>
                        <p class="text-xl font-semibold text-[#2171a7]">Upload Your Treasures</p>
                    </div>
                    <div class=" text-justify">
                        <span class="text-base text-slate-600">
                            Ready to make a sale? Upload your items with clear descriptions and set a fair price to attract potential buyers quickly.
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
