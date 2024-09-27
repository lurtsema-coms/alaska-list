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
        <!-- Apex JS -->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/css/lightgallery.min.css" integrity="sha512-F2E+YYE1gkt0T5TVajAslgDfTEUQKtlu4ralVq78ViNxhKXQLrgQLLie8u1tVdG2vWnB3ute4hcdbiBtvJQh0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/lightgallery.min.js" integrity="sha512-jEJ0OA9fwz5wUn6rVfGhAXiiCSGrjYCwtQRUwI/wRGEuWRZxrnxoeDoNc+Pnhx8qwKVHs2BRQrVR9RE6T4UHBg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/css/lg-thumbnail.min.css" integrity="sha512-GRxDpj/bx6/I4y6h2LE5rbGaqRcbTu4dYhaTewlS8Nh9hm/akYprvOTZD7GR+FRCALiKfe8u1gjvWEEGEtoR6g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/plugins/thumbnail/lg-thumbnail.min.js" integrity="sha512-VBbe8aA3uiK90EUKJnZ4iEs0lKXRhzaAXL8CIHWYReUwULzxkOSxlNixn41OLdX0R1KNP23/s76YPyeRhE6P+Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        {{-- Selectize --}}
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
            integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
            integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer">
        </script>

        <!-- Timeago.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/timeago.js/4.0.2/timeago.min.js"></script>
        
        {{-- Moment JS --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Styling for the Selectize control */
            .selectize-control.single .selectize-input, .selectize-dropdown.single {
                border-color: rgb(203 213 225);
            }

            .selectize-control.single .selectize-input {
                font-size: 1rem;
                background-color: #fff
                background-image: none;
                padding: .64rem .8rem;
                border-radius: 0.5rem;
            }

            /* Styling for the Selectize input */
            .selectize-input {
                font-size: 1rem;
                padding: .64rem .8rem;
                border-radius: 0.5rem;
            }

            /* Styling for the Selectize dropdown */
            .selectize-dropdown {
                font-size: 1rem;
            }

            /* Styling for dropdown items */
            .selectize-dropdown-content {
                font-size: 1rem;
            }

            /* Dropdown item styles */
            .selectize-dropdown-item {
                font-size: 1rem;
                padding: .5rem 1rem;
                cursor: pointer;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="px-4 py-6 mx-auto sm:container sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @role('seller')
                    <livewire:component.prohibited-listing-modal />
                @endrole
                {{ $slot }}
                <div x-data="{ showModal: false }" 
                    wire:offline="showModal = true" 
                    x-show="showModal" 
                    x-cloak 
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                    
                    <!-- Modal Content -->
                    <div class="w-full max-w-lg p-6 bg-white rounded-lg shadow-lg">
                        <!-- Modal Header -->
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-semibold text-gray-800">Connection Issue</h3>
                            <button @click="showModal = false" class="text-gray-500 hover:text-gray-700">X</button>
                        </div>

                        <!-- Modal Body -->
                        <div class="text-gray-600">
                            <p class="alert alert-warning">
                                Whoops, your device has lost connection. The web page you are viewing is offline.
                            </p>
                            <p class="mt-4">
                                Please refresh the page before doing any further actions.
                            </p>
                        </div>

                        <!-- Modal Footer -->
                        <div class="flex justify-end mt-4">
                            <button @click="showModal = false" class="px-4 py-2 text-white transition bg-blue-500 rounded-md hover:bg-blue-600">
                                Dismiss
                            </button>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </body>
</html>
