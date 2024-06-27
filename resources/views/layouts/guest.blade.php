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
        <div class="w-full max-w-7xl flex flex-row  justify-center m-auto bg-white shadow-none sm:shadow-md overflow-hidden h-[45rem]">
            <div class="w-full sm:w-2/5 p-10 m-auto mx-8 sm:pt-28 sm:pb-20 sm:px-20 sm:mx-11 sm:my-16 bg-gray-100 rounded-lg">
                {{ $slot }}
            </div>
            <div class="w-3/5  hidden sm:block relative bg-contain bg-no-repeat bg-center">
                {{-- <img class="absolute object-cover min-h-full min-w-full top-0 z-10" src="{{asset('img/nurses.png')}}" alt=""> --}}
                <div class=" w-full h-full absolute inset-0 z-20 opacity-75">
                </div>
            </div>
        </div>
    </body>
</html>
