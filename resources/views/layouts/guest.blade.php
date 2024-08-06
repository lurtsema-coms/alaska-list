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
    <body class="flex min-h-screen m-auto font-sans antialiased text-gray-900 sm:px-10">
        <div class="w-full max-w-7xl flex flex-col-reverse justify-center m-auto bg-white shadow-none lg:shadow-md overflow-hidden h-full lg:min-h-[45rem] lg:flex-row rounded-3xl lg:border">
            <div class="flex w-full p-5 bg-white sm:p-10 xl:p-20 rounded-3xl lg:w-1/2">
                <div class="w-full max-w-2xl p-20 px-10 m-auto border bg-gray-50 rounded-2xl">
                    {{ $slot }}
                </div>
            </div>
            <div class="w-1/2 flex-row hidden lg:block bg-[#122a30] p-10 xl:p-20 pt-32">
                <div class="flex justify-center w-full mb-2">
                    <img class="w-2/3" src="{{ asset('frontend/alaska.png') }}" alt="">
                </div>
                <div class="w-full p-6">
                    <h1 class="mb-2 text-xl font-bold text-white ">Your Alaskan Shopping Adventure Starts Here </h1>
                    <div class="flex justify-center text-justify">
                        <span class="text-gray-200 text">Discover the best of Alaska from wherever you are with our curated selection of unique products and essentials. Your Alaskan shopping adventure begins here, bringing the spirit of the Last Frontier to your doorstep.</span>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
