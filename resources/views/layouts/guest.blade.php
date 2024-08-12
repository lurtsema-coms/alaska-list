<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="flex min-h-screen py-10 font-sans antialiased text-gray-900 sm:px-10">
        <div class="w-full max-w-7xl flex flex-col-reverse justify-center m-auto bg-white shadow-none lg:shadow-md overflow-hidden h-full lg:min-h-[45rem] lg:flex-row rounded-3xl lg:border">
            <div class="flex w-full p-5 bg-white sm:p-10 xl:p-20 rounded-3xl lg:w-1/2">
                <div class="w-full max-w-2xl p-20 px-10 m-auto  rounded-2xl">
                    {{ $slot }}
                </div>
            </div>
            <div class="w-full flex-1 hidden sm:block relative bg-contain bg-no-repeat bg-center">
                <img class="absolute object-cover min-h-full min-w-full top-0 z-10" src="{{asset('frontend/mountain.jpg')}}" alt="">
                <div class=" w-full h-full absolute inset-0 z-20 bg-[#17427C] opacity-75">
                </div>
                <div class="flex justify-center w-full z-30 absolute top-40">
                    <img class="w-2/3" src="{{ asset('img/logo/logo_white.png') }}" alt="">
                </div>
                <div class="w-full flex absolute z-30 justify-center text-justify bottom-64">
                    <h1 class="text-2xl font-bold text-white italic ">Your Alaskan Shopping Adventure Starts Here</h1>
                </div>
            </div>

        </div>
    </body>
</html>
