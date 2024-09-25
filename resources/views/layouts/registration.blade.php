<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('img/logo/logo.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput.min.js"></script>


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles

        <style>
        .layer1 {
            background: url('frontend/wave3.svg');
            background-size: cover; /* Optional: ensures the image covers the entire background */
            background-repeat: no-repeat; /* Optional: prevents the image from repeating */
        }
        .layer2 {
            background: url('frontend/wave2.svg');
            background-size: cover; /* Optional: ensures the image covers the entire background */
            background-repeat: no-repeat; /* Optional: prevents the image from repeating */
        }
        </style>
    </head>
    <body class="flex min-h-screen py-10 font-sans antialiased text-gray-900">
        <div class="w-full max-w-7xl flex flex-row justify-center m-auto shadow-none sm:shadow-md overflow-hidden min-h-[45rem] bg-no-repeat bg-cover bg-center rounded-2xl sm:border px-5 relative py-5" style="background-image: url('{{ asset('frontend/mountain.jpg') }}');">
            <!-- Watermark overlay only on the background image -->
            <div class="absolute inset-0 z-20 bg-[#17437cf6] opacity-75"></div>
            <div class="relative w-full max-w-2xl p-10 m-auto mx-1 leading-none border border-sky-600 rounded-2xl bg-gray-50 z-30">
                <div class="w-full">
                    <livewire:pages.auth.register>
                </div>
            </div>
        </div>
        @livewireScripts
    </body>
    
</html>