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
        .layer3{
            
        }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased flex m-auto min-h-screen">
        <div class="w-full max-w-7xl flex flex-row justify-center m-auto bg-white shadow-none sm:shadow-md overflow-hidden h-[45rem] bg-no-repeat bg-cover bg-splashed1">
            <div class="w-full hidden sm:block sm:w-2/5">
            </div>
            <div class="w-full sm:w-3/5 p-10 m-auto mx-1 sm:mx-16 rounded-lg leading-none bg-gray-50 border">
                <div class="w-full">
                    <livewire:pages.auth.register>
                </div>
            </div>
        </div>
        @livewireScripts
    </body>
</html>