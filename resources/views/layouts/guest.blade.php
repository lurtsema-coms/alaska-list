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
    <body class="font-sans text-gray-900 antialiased flex m-auto min-h-screen">
        <div class="w-full max-w-7xl flex flex-col-reverse   justify-center m-auto bg-white shadow-none sm:shadow-md overflow-hidden h-full lg:h-[45rem] lg:flex-row rounded-3xl">
            <div class="w-full lg:w-2/5 p-10 m-auto  lg:pt-28 lg:pb-20 lg:px-20 lg:mx-11 lg:my-16 bg-gray-50 rounded-3xl border  ">
                <div class=" flex justify-center items-center">
                    <img class="w-2/3 block lg:hidden mb-5" src="{{ asset('frontend/alaskaLogo.png') }}" alt="">
                </div>
                {{ $slot }}
            </div>
            <div class="w-full flex-1 flex-row hidden lg:block bg-[#122a30] p-20 pt-32">
                <div class="flex justify-center mb-2 w-full">
                    <img class="w-2/3" src="{{ asset('frontend/alaska.png') }}" alt="">
                </div>
                <div class="p-6 w-full">
                    <h1 class=" text-xl font-bold text-white mb-2">Your Alaskan Shopping Adventure Starts Here </h1>
                    <div class="flex justify-center text-justify">
                        <span class="text-gray-200 text">Discover the best of Alaska from wherever you are with our curated selection of unique products and essentials. Your Alaskan shopping adventure begins here, bringing the spirit of the Last Frontier to your doorstep.</span>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
