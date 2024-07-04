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
        @livewireStyles

    </head>
    <body class="font-sans text-gray-900 antialiased flex m-auto min-h-screen">
        <div class="w-full max-w-7xl flex flex-row  justify-center m-auto bg-white shadow-none sm:shadow-md overflow-hidden h-[45rem]">
            <div class="w-full sm:w-2/5 p-10 px-20 bg-[#122a30] ">
                <div>
                    {{-- <img src="{{ asset('frontend/register2.png') }}" alt="Image" class=""> --}}
                </div>
                <div>
                    <span>

                    </span>
                </div>
            </div>
            <div class="w-3/5 p-10 m-auto mx-16 rounded-lg leading-none bg-gray-50 border  ">
                <div class=" w-full">
                    <livewire:pages.auth.register>
                </div>
            </div>
        </div>
        @livewireScripts
    </body>
</html>