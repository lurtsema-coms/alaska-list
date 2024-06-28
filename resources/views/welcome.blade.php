<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Alaska List</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <style>
        .ellipse{
            clip-path: ellipse(100% 100% at top center);
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-teal-50 font-sans text-slate-800 antialiased">
    <div class="flex flex-col h-full w-full">
        {{-- Navbar --}}
        <div class="sticky top-0 z-10" x-data="{ sidebarOpen: false }">
            <div class="bg-teal-50 border-b">
                <div class="container mx-auto py-2">
                    <div class="flex items-center">
                        <div class="flex items-center w-full gap-5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 text-dark cursor-pointer hover:opacity-70"
                                @click="sidebarOpen = true;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                            <p class="text-xl text-slate-700">Logo</p>
                        </div>
                        <div class="relative w-full max-w-96 p-1 overflow-hidden">
                            <input class="w-full rounded-full py-2 pr-12 pl-4 focus:ring-2" type="text" placeholder="Search...">
                            <button class="absolute inset-y-0 right-2 flex items-center pr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fixed top-0 h-dvh w-80 bg-gray-900 bg-opacity-90 p-6 space-y-4 z-10"
                x-cloak
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                x-show="sidebarOpen"
                @click.outside="sidebarOpen = false">
                <div class="flex justify-end">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 text-slate-300 cursor-pointer hover:text-white"
                    @click="sidebarOpen = false;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </div>
                <div class="flex flex-col gap-5 text-white">
                    <a class="relative group px-1" href="">
                        <span class="transition-opacity group-hover:opacity-70">HOME</span>
                        <span class="absolute -bottom-3 left-0 w-0 transition-all h-1 bg-white group-hover:w-full"></span>
                    </a>
                    <a class="relative group px-1" href="">
                        <span class="transition-opacity group-hover:opacity-70">CATEGORIES</span>
                        <span class="absolute -bottom-3 left-0 w-0 transition-all h-1 bg-white group-hover:w-full"></span>
                    </a>
                    <a class="relative group px-1" href="">
                        <span class="transition-opacity group-hover:opacity-70">LISTING PAGE</span>
                        <span class="absolute -bottom-3 left-0 w-0 transition-all h-1 bg-white group-hover:w-full"></span>
                    </a>
                    <a class="relative group px-1" href="">
                        <span class="transition-opacity group-hover:opacity-70">ABOUT US</span>
                        <span class="absolute -bottom-3 left-0 w-0 transition-all h-1 bg-white group-hover:w-full"></span>
                    </a>
                    <a class="relative group px-1" href="">
                        <span class="transition-opacity group-hover:opacity-70">CONTACT US</span>
                        <span class="absolute -bottom-3 left-0 w-0 transition-all h-1 bg-white group-hover:w-full"></span>
                    </a>
                    <a class="relative group px-1" href="">
                        <span class="transition-opacity group-hover:opacity-70">ADVERTISE WITH US</span>
                        <span class="absolute -bottom-3 left-0 w-0 transition-all h-1 bg-white group-hover:w-full"></span>
                    </a>
                </div>
            </div>
        </div>
        {{-- hero section --}}
        <div class="relative min-h-[42rem] ellipse container mt-5 mx-auto bg-[#246567] rounded-2xl">
            <div class="min-h-[38rem] flex p-10">
                <div class="w-1/2 px-10 flex justify-center flex-col gap-8 text-white z-10">
                    <p class="text-5xl font-bold">Discover Alaska's Hidden Treasures, <span class="border-b-2 border-yellow-300">Sell</span> Your Surprises</p>
                    <p class="text-lg text-slate-200">Welcome to Alaska List, your gateway to the Last Frontier's marketplace. Discover stories behind every listing - whether it's rugged gear, cozy cabins, or local services, find it all here.</p>
                    <a class="flex justify-center mt-4" href="#">
                        <div class="bg-[#1F4B55] text-xl px-6 py-3 rounded-lg shadow-md hover:bg-[#245D69] transition-colors duration-300 cursor-pointer">
                            Search Now
                        </div>
                    </a>
                </div>
                <div class="absolute inset-0 flex items-center justify-end">
                    <img src="{{ asset('frontend/business-woman.png') }}" alt="Image" class="w-1/3 relative right-24 rounded-lg">
                </div>
                <!-- Random image icons -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <!-- Example random image icons with opacity -->
                    <img src="{{ asset('icon-img/contact-list.png') }}" alt="Icon 1" class="absolute top-[10%] left-[10%] opacity-30 w-10">
                    <img src="{{ asset('icon-img/list.png') }}" alt="Icon 2" class="absolute top-[30%] left-[70%] opacity-30 w-10">
                    <img src="{{ asset('icon-img/shopping-bag.png') }}" alt="Icon 3" class="absolute top-[60%] left-[30%] opacity-30 w-10">
                    <img src="{{ asset('icon-img/shopping-cart.png') }}" alt="Icon 4" class="absolute top-[40%] left-[50%] opacity-30 w-10">
                    <img src="{{ asset('icon-img/store.png') }}" alt="Icon 5" class="absolute top-[80%] left-[20%] opacity-30 w-10">
                    <img src="{{ asset('icon-img/store.png') }}" alt="Icon 6" class="absolute top-[70%] left-[60%] opacity-30 w-10">
                    <!-- Add more icons as needed -->
                </div>
            </div>
        </div>
        {{-- Categories Section --}}
        <div class="mt-28 container mx-auto">
            <div class="flex justify-center flex-wrap gap-4">
                <div class="flex-1 flex flex-col bg-white cursor-pointer min-w-56 min-h-44 p-4 border border-slate-300 rounded-xl shadow-md mb-4 transition-all hover:border-sky-600">
                    <div>
                        <p class="text-gray-700 text-2xl font-bold">Furniture</p>
                        <p class="text-gray-700">Discover a wide selection of sofas, tables, and chairs for sale, both new and used.</p>
                    </div>
                    <div class="flex-1 flex justify-end mt-3">
                        <img class="w-16" src="{{ asset('icon-img/lamp.png') }}" alt="">
                    </div>
                </div>
                <div class="flex-1 flex flex-col bg-white cursor-pointer min-w-56 min-h-44 p-4 border border-slate-300 rounded-xl shadow-md mb-4 transition-all hover:border-sky-600">
                    <div>
                        <p class="text-gray-700 text-2xl font-bold">Electronics</p>
                        <p class="text-gray-700">Explore deals on smartphones, laptops, and gadgets from leading brands.</p>
                    </div>
                    <div class="flex-1 flex justify-end mt-3">
                        <img class="w-16" src="{{ asset('icon-img/gadgets.png') }}" alt="">
                    </div>
                </div>
                <div class="flex-1 flex flex-col bg-white cursor-pointer min-w-56 min-h-44 p-4 border border-slate-300 rounded-xl shadow-md mb-4 transition-all hover:border-sky-600">
                    <div>
                        <p class="text-gray-700 text-2xl font-bold">Vehicles</p>
                        <p class="text-gray-700">Find cars, trucks, motorcycles, and RVs for sale near you, both use.</p>
                    </div>
                    <div class="flex-1 flex justify-end mt-3">
                        <img class="w-16" src="{{ asset('icon-img/car.png') }}" alt="">
                    </div>
                </div>
                <div class="flex-1 flex flex-col bg-white cursor-pointer min-w-56 min-h-44 p-4 border border-slate-300 rounded-xl shadow-md mb-4 transition-all hover:border-sky-600">
                    <div>
                        <p class="text-gray-700 text-2xl font-bold">Real Estate</p>
                        <p class="text-gray-700">Browse listings for apartments, houses, and commercial properties.</p>
                    </div>
                    <div class="flex-1 flex justify-end mt-3">
                        <img class="w-16" src="{{ asset('icon-img/house.png') }}" alt="">
                    </div>
                </div>
                <div class="min-h-44 w-32 bg-yellow-100 rounded-l-xl shadow-md mb-4 transition-all hover:border hover:bg-yellow-200 cursor-pointer">
                    <div class="h-full flex justify-center items-center flex-col gap-4">
                        <div class="rounded-full border p-3 bg-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </div>
                        <p class="font-medium text-slate-600">See all</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-28 container mx-auto">
            <div class="mb-16 flex flex-col items-center gap-2">
                <h1 class="text-4xl">Featured Products</h1>
                <svg width="100%" height="24" viewBox="0 0 445 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="paint0_linear" x1="442.073" y1="0.563245" x2="414.515" y2="114.417" gradientUnits="userSpaceOnUse">
                            <stop offset="0.00246263" stop-color="#8CBEB2"></stop> <!-- Light teal -->
                            <stop offset="0.5" stop-color="#5C8D84"></stop>       <!-- Medium teal -->
                            <stop offset="1" stop-color="#246567"></stop>         <!-- Dark teal (your primary color) -->
                        </linearGradient>
                    </defs>
                    <path d="M2.05469 14.4867C101.635 11.2688 220.427 7.27869 321.636 4.51622C339.098 4.03959 405.88 2.2299 435.16 2.4148C469.321 2.63052 367.236 4.76098 333.13 5.23315C287.706 5.862 241.846 5.56207 196.608 7.11433C141.398 9.00879 86.1341 13.2794 32.6894 18.4062C25.661 19.0804 18.1112 19.7952 11.4034 20.8511C10.8564 20.9372 12.5329 21.0395 13.133 21.0441C30.5637 21.177 48.0652 20.9913 65.4387 20.6787C190.017 18.4372 313.48 13.4101 438.301 12.1482" stroke="url(#paint0_linear)" stroke-width="4" stroke-linecap="round"></path>
                </svg>
            </div>
            
            <div id="products" class="py-10 rounded-lg">
                <div class="max-w-6xl mx-8 md:mx-10 lg:mx-20 xl:mx-auto">

                    <div class="mb-12 space-y-5 md:mb-16 md:text-center">
                        <div class="inline-block px-3 py-1 text-sm font-semibold text-indigo-100 rounded-lg md:text-center bg-[#202c47] bg-opacity-80 hover:cursor-pointer hover:bg-opacity-40">
                            Sponsored Listings
                        </div>
                        <h1 class="mb-5 text-3xl font-semibold text-gray-800">
                            Explore products that have been highlighted for your attention.
                        </h1>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 lg:gap-8">

                        <!-- Product 1 -->
                        <div class="text-sm leading-6">
                            <div class="relative group">
                                <div class="absolute transition rounded-lg opacity-25 -inset-1 duration-400 group-hover:opacity-100 group-hover:duration-200"></div>
                                <a href="#" class="cursor-pointer">
                                    <div class="relative p-6 space-y-6 leading-none rounded-lg bg-white transition-all hover:border hover:border-sky-600 shadow-sm">
                                        <div class="flex items-center space-x-4">
                                            <img src="product-image-1.jpg" class="w-12 h-12 bg-center bg-cover border rounded-full" alt="Product 1">
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-800">Product 1</h3>
                                                <p class="text-gray-600 text-md">Category</p>
                                            </div>
                                        </div>
                                        <p class="leading-normal text-gray-700 text-md">Description of Product 1.</p>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Product 2 -->
                        <div class="text-sm leading-6">
                            <div class="relative group">
                                <div class="absolute transition rounded-lg opacity-25 -inset-1 duration-400 group-hover:opacity-100 group-hover:duration-200"></div>
                                <a href="#" class="cursor-pointer">
                                    <div class="relative p-6 space-y-6 leading-none rounded-lg bg-white transition-all hover:border hover:border-sky-600 shadow-sm">
                                        <div class="flex items-center space-x-4">
                                            <img src="product-image-2.jpg" class="w-12 h-12 bg-center bg-cover border rounded-full" alt="Product 2">
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-800">Product 2</h3>
                                                <p class="text-gray-600 text-md">Category</p>
                                            </div>
                                        </div>
                                        <p class="leading-normal text-gray-700 text-md">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum doloribus molestias ullam at minima in reiciendis hic nobis culpa magnam.</p>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Product 3 -->
                        <div class="text-sm leading-6">
                            <div class="relative group">
                                <div class="absolute transition rounded-lg opacity-25 -inset-1 duration-400 group-hover:opacity-100 group-hover:duration-200"></div>
                                <a href="#" class="cursor-pointer">
                                    <div class="relative p-6 space-y-6 leading-none rounded-lg bg-white transition-all hover:border hover:border-sky-600 shadow-sm">
                                        <div class="flex items-center space-x-4">
                                            <img src="product-image-3.jpg" class="w-12 h-12 bg-center bg-cover border rounded-full" alt="Product 3">
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-800">Product 3</h3>
                                                <p class="text-gray-600 text-md">Category</p>
                                            </div>
                                        </div>
                                        <p class="leading-normal text-gray-700 text-md">Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta recusandae aut molestias. Facere, sapiente. Animi a quis earum asperiores fugit. Officiis quaerat magni aperiam iste, aliquid corporis perspiciatis! Laborum provident consectetur quo modi sunt in vero accusamus delectus praesentium rem maxime porro explicabo soluta at eos quas nobis, asperiores nisi?</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Get In Touch --}}
        <div class="mt-28 container mx-auto">
            <div class="mb-16 flex flex-col items-center gap-2">
                <h1 class="text-4xl">Get In Touch</h1>
                <svg width="100%" height="24" viewBox="0 0 445 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="paint0_linear" x1="442.073" y1="0.563245" x2="414.515" y2="114.417" gradientUnits="userSpaceOnUse">
                            <stop offset="0.00246263" stop-color="#8CBEB2"></stop> <!-- Light teal -->
                            <stop offset="0.5" stop-color="#5C8D84"></stop>       <!-- Medium teal -->
                            <stop offset="1" stop-color="#246567"></stop>         <!-- Dark teal (your primary color) -->
                        </linearGradient>
                    </defs>
                    <path d="M2.05469 14.4867C101.635 11.2688 220.427 7.27869 321.636 4.51622C339.098 4.03959 405.88 2.2299 435.16 2.4148C469.321 2.63052 367.236 4.76098 333.13 5.23315C287.706 5.862 241.846 5.56207 196.608 7.11433C141.398 9.00879 86.1341 13.2794 32.6894 18.4062C25.661 19.0804 18.1112 19.7952 11.4034 20.8511C10.8564 20.9372 12.5329 21.0395 13.133 21.0441C30.5637 21.177 48.0652 20.9913 65.4387 20.6787C190.017 18.4372 313.48 13.4101 438.301 12.1482" stroke="url(#paint0_linear)" stroke-width="4" stroke-linecap="round"></path>
                </svg>
            </div>
            <div class="container">
                <div class="min-h-44 max-w-2xl mx-auto bg-white shadow-md rounded-lg">
                    <form action="" method="post">
                        <div class="flex flex-col gap-10 p-10">
                            <p class="text-slate-700 text-md font-bold">Email us at help@domain.com</p>
                            <div class="flex flex-wrap gap-5">
                                <div class="flex-1 min-w-64 relative z-0">
                                    <input type="text" name="name" class="peer block w-full appearance-none border-0 border-b border-gray-500 bg-transparent py-2.5 px-0 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0" placeholder=" " required/>
                                    <label class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Your name</label>
                                </div>
                                <div class="flex-1 min-w-64 relative z-0">
                                    <input type="text" name="email" class="peer block w-full appearance-none border-0 border-b border-gray-500 bg-transparent py-2.5 px-0 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0" placeholder=" " required/>
                                    <label class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Your Email</label>
                                </div>
                            </div>
                            <div class="relative z-0">
                                <textarea name="message" rows="5" class="peer block w-full appearance-none border-0 border-b border-gray-500 bg-transparent py-2.5 px-0 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0" placeholder=" " required></textarea>
                                <label class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Your message</label>
                            </div>
                            <div class="flex">
                                <button class="text-white bg-[#1F4B55] text-sm px-6 py-3 rounded-lg shadow-md hover:bg-[#245D69] transition-colors duration-300 cursor-pointer">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Footer --}}
        <footer class="mt-48 w-full bg-gray-900">
                <div class="mx-auto container px-4 sm:px-6 lg:px-8">
                    <!--Grid-->
                    <div class="py-12 flex flex-wrap justify-between items-center flex-col gap-8 lg:flex-row">
                        <a href="https://pagedone.io/" class="flex justify-center text-white">
                            Logo
                                <path d="M47 24.7231V7H54.4171C54.5916 7 54.816 7.00821 55.0903 7.02462C55.3645 7.03282 55.618 7.05744 55.8507 7.09846C56.8895 7.25436 57.7455 7.59487 58.4186 8.12C59.1001 8.64513 59.6029 9.30974 59.927 10.1138C60.2594 10.9097 60.4256 11.7959 60.4256 12.7723C60.4256 13.7405 60.2594 14.6267 59.927 15.4308C59.5945 16.2267 59.0876 16.8872 58.4061 17.4123C57.733 17.9374 56.8812 18.2779 55.8507 18.4338C55.618 18.4667 55.3604 18.4913 55.0778 18.5077C54.8035 18.5241 54.5833 18.5323 54.4171 18.5323H50.0042V24.7231H47ZM50.0042 15.7631H54.2925C54.4587 15.7631 54.6457 15.7549 54.8534 15.7385C55.0612 15.7221 55.2523 15.6892 55.4268 15.64C55.9255 15.5169 56.3161 15.2995 56.5986 14.9877C56.8895 14.6759 57.0931 14.3231 57.2094 13.9292C57.3341 13.5354 57.3964 13.1497 57.3964 12.7723C57.3964 12.3949 57.3341 12.0092 57.2094 11.6154C57.0931 11.2133 56.8895 10.8564 56.5986 10.5446C56.3161 10.2328 55.9255 10.0154 55.4268 9.89231C55.2523 9.84308 55.0612 9.81436 54.8534 9.80615C54.6457 9.78974 54.4587 9.78154 54.2925 9.78154H50.0042V15.7631Z" fill="white"/>
                                <path d="M66.0975 25.0923C65.1252 25.0923 64.3024 24.9118 63.6293 24.5508C62.9561 24.1815 62.445 23.6933 62.096 23.0862C61.7553 22.479 61.5849 21.8103 61.5849 21.08C61.5849 20.44 61.6929 19.8656 61.909 19.3569C62.1251 18.84 62.4575 18.3969 62.9063 18.0277C63.355 17.6503 63.9368 17.3426 64.6515 17.1046C65.1917 16.9323 65.8233 16.7764 66.5463 16.6369C67.2776 16.4974 68.0671 16.3703 68.9148 16.2554C69.7707 16.1323 70.6641 16.001 71.5949 15.8615L70.5228 16.4646C70.5311 15.5456 70.3234 14.8687 69.8995 14.4338C69.4757 13.999 68.761 13.7815 67.7554 13.7815C67.1488 13.7815 66.5629 13.921 65.9978 14.2C65.4327 14.479 65.0379 14.959 64.8135 15.64L62.0711 14.7908C62.4035 13.6667 63.0351 12.7641 63.9659 12.0831C64.9049 11.4021 66.1681 11.0615 67.7554 11.0615C68.9522 11.0615 70.0034 11.2544 70.9093 11.64C71.8234 12.0256 72.5007 12.6574 72.9412 13.5354C73.1822 14.0031 73.3276 14.4831 73.3775 14.9754C73.4274 15.4595 73.4523 15.9887 73.4523 16.5631V24.7231H70.822V21.8431L71.2583 22.3108C70.6517 23.2708 69.9411 23.9764 69.1267 24.4277C68.3206 24.8708 67.3108 25.0923 66.0975 25.0923ZM66.6959 22.7292C67.3773 22.7292 67.9591 22.6103 68.4411 22.3723C68.9231 22.1344 69.3054 21.8431 69.5879 21.4985C69.8788 21.1538 70.0741 20.8297 70.1738 20.5262C70.3317 20.1487 70.419 19.7179 70.4356 19.2338C70.4605 18.7415 70.473 18.3436 70.473 18.04L71.3954 18.3108C70.4896 18.4503 69.7126 18.5733 69.0643 18.68C68.4161 18.7867 67.8593 18.8892 67.3939 18.9877C66.9286 19.0779 66.5172 19.1805 66.1598 19.2954C65.8108 19.4185 65.5158 19.5621 65.2748 19.7262C65.0338 19.8903 64.8468 20.079 64.7138 20.2923C64.5891 20.5056 64.5268 20.7559 64.5268 21.0431C64.5268 21.3713 64.6099 21.6626 64.7761 21.9169C64.9423 22.1631 65.1833 22.36 65.4991 22.5077C65.8233 22.6554 66.2222 22.7292 66.6959 22.7292Z" fill="white"/>
                                <path d="M82.1078 31C81.3598 31 80.641 30.8851 79.9512 30.6554C79.2698 30.4256 78.6548 30.0933 78.1063 29.6585C77.5578 29.2318 77.109 28.7149 76.76 28.1077L79.5274 26.7538C79.785 27.2379 80.1465 27.5949 80.6119 27.8246C81.0856 28.0626 81.5884 28.1815 82.1203 28.1815C82.7435 28.1815 83.3003 28.0708 83.7907 27.8492C84.281 27.6359 84.6591 27.3159 84.925 26.8892C85.1993 26.4708 85.3281 25.9456 85.3115 25.3138V21.5354H85.6855V11.4308H88.3157V25.3631C88.3157 25.6995 88.2991 26.0195 88.2659 26.3231C88.2409 26.6349 88.1952 26.9385 88.1287 27.2338C87.9293 28.0954 87.547 28.801 86.9819 29.3508C86.4168 29.9087 85.7145 30.3231 84.8752 30.5938C84.0441 30.8646 83.1217 31 82.1078 31ZM81.846 25.0923C80.6077 25.0923 79.5274 24.7846 78.6049 24.1692C77.6825 23.5538 76.9678 22.7169 76.4608 21.6585C75.9539 20.6 75.7004 19.4062 75.7004 18.0769C75.7004 16.7313 75.9539 15.5333 76.4608 14.4831C76.9761 13.4246 77.7032 12.5918 78.6423 11.9846C79.5814 11.3692 80.6867 11.0615 81.9582 11.0615C83.238 11.0615 84.3101 11.3692 85.1744 11.9846C86.047 12.5918 86.7076 13.4246 87.1564 14.4831C87.6052 15.5415 87.8296 16.7395 87.8296 18.0769C87.8296 19.3979 87.6052 20.5918 87.1564 21.6585C86.7076 22.7169 86.0387 23.5538 85.1494 24.1692C84.2602 24.7846 83.1591 25.0923 81.846 25.0923ZM82.3072 22.4338C83.1134 22.4338 83.7616 22.2533 84.2519 21.8923C84.7505 21.5231 85.112 21.0103 85.3364 20.3538C85.5691 19.6974 85.6855 18.9385 85.6855 18.0769C85.6855 17.2072 85.5691 16.4482 85.3364 15.8C85.112 15.1436 84.7588 14.6349 84.2768 14.2738C83.7948 13.9046 83.1715 13.72 82.407 13.72C81.6008 13.72 80.936 13.9169 80.4124 14.3108C79.8889 14.6964 79.5024 15.2215 79.2531 15.8862C79.0038 16.5426 78.8792 17.2728 78.8792 18.0769C78.8792 18.8892 78.9997 19.6277 79.2407 20.2923C79.49 20.9487 79.8681 21.4697 80.375 21.8554C80.882 22.241 81.5261 22.4338 82.3072 22.4338Z" fill="white"/>
                                <path d="M97.6827 25.0923C96.3198 25.0923 95.1231 24.801 94.0926 24.2185C93.0621 23.6359 92.256 22.8277 91.6743 21.7938C91.1008 20.76 90.8141 19.5703 90.8141 18.2246C90.8141 16.7723 91.0967 15.5128 91.6618 14.4462C92.2269 13.3713 93.0122 12.5385 94.0178 11.9477C95.0234 11.3569 96.1869 11.0615 97.5082 11.0615C98.9044 11.0615 100.089 11.3856 101.061 12.0338C102.042 12.6738 102.769 13.5805 103.242 14.7538C103.716 15.9272 103.895 17.3097 103.778 18.9015H100.799V17.8185C100.791 16.3744 100.533 15.32 100.026 14.6554C99.5194 13.9908 98.7216 13.6585 97.6329 13.6585C96.4029 13.6585 95.4888 14.0359 94.8904 14.7908C94.2921 15.5374 93.9929 16.6328 93.9929 18.0769C93.9929 19.4226 94.2921 20.4646 94.8904 21.2031C95.4888 21.9415 96.3614 22.3108 97.5082 22.3108C98.2479 22.3108 98.8836 22.1508 99.4155 21.8308C99.9557 21.5026 100.371 21.0308 100.662 20.4154L103.629 21.3015C103.114 22.4995 102.316 23.4308 101.235 24.0954C100.163 24.76 98.9792 25.0923 97.6827 25.0923ZM93.0455 18.9015V16.6615H102.308V18.9015H93.0455Z" fill="white"/>
                                <path d="M111.708 25.0923C110.47 25.0923 109.39 24.7846 108.467 24.1692C107.545 23.5538 106.83 22.7169 106.323 21.6585C105.816 20.6 105.563 19.4062 105.563 18.0769C105.563 16.7313 105.816 15.5333 106.323 14.4831C106.838 13.4246 107.565 12.5918 108.505 11.9846C109.444 11.3692 110.549 11.0615 111.82 11.0615C113.1 11.0615 114.172 11.3692 115.037 11.9846C115.909 12.5918 116.57 13.4246 117.019 14.4831C117.467 15.5415 117.692 16.7395 117.692 18.0769C117.692 19.3979 117.467 20.5918 117.019 21.6585C116.57 22.7169 115.901 23.5538 115.012 24.1692C114.122 24.7846 113.021 25.0923 111.708 25.0923ZM112.169 22.4338C112.976 22.4338 113.624 22.2533 114.114 21.8923C114.613 21.5231 114.974 21.0103 115.199 20.3538C115.431 19.6974 115.548 18.9385 115.548 18.0769C115.548 17.2072 115.431 16.4482 115.199 15.8C114.974 15.1436 114.621 14.6349 114.139 14.2738C113.657 13.9046 113.034 13.72 112.269 13.72C111.463 13.72 110.798 13.9169 110.275 14.3108C109.751 14.6964 109.365 15.2215 109.115 15.8862C108.866 16.5426 108.741 17.2728 108.741 18.0769C108.741 18.8892 108.862 19.6277 109.103 20.2923C109.352 20.9487 109.73 21.4697 110.237 21.8554C110.744 22.241 111.388 22.4338 112.169 22.4338ZM115.548 24.7231V15.3938H115.174V7H118.203V24.7231H115.548Z" fill="white"/>
                                <path d="M127.395 25.0923C126.049 25.0923 124.873 24.7928 123.867 24.1938C122.861 23.5949 122.08 22.7703 121.523 21.72C120.975 20.6615 120.701 19.4472 120.701 18.0769C120.701 16.6821 120.983 15.4595 121.548 14.4092C122.113 13.359 122.899 12.5385 123.904 11.9477C124.91 11.3569 126.073 11.0615 127.395 11.0615C128.749 11.0615 129.93 11.361 130.935 11.96C131.941 12.559 132.722 13.3877 133.279 14.4462C133.835 15.4964 134.114 16.7067 134.114 18.0769C134.114 19.4554 133.831 20.6738 133.266 21.7323C132.709 22.7826 131.928 23.6072 130.923 24.2062C129.917 24.7969 128.741 25.0923 127.395 25.0923ZM127.395 22.3108C128.592 22.3108 129.481 21.9169 130.062 21.1292C130.644 20.3415 130.935 19.3241 130.935 18.0769C130.935 16.7887 130.64 15.7631 130.05 15C129.46 14.2287 128.575 13.8431 127.395 13.8431C126.589 13.8431 125.924 14.0236 125.4 14.3846C124.885 14.7374 124.503 15.2338 124.253 15.8738C124.004 16.5056 123.879 17.24 123.879 18.0769C123.879 19.3651 124.174 20.3949 124.765 21.1662C125.363 21.9292 126.24 22.3108 127.395 22.3108Z" fill="white"/>
                                <path d="M145.923 24.7231V18.3231C145.923 17.9046 145.894 17.441 145.836 16.9323C145.778 16.4236 145.64 15.9354 145.424 15.4677C145.217 14.9918 144.901 14.6021 144.477 14.2985C144.061 13.9949 143.496 13.8431 142.782 13.8431C142.399 13.8431 142.021 13.9046 141.647 14.0277C141.273 14.1508 140.933 14.3641 140.625 14.6677C140.326 14.9631 140.085 15.3733 139.902 15.8985C139.719 16.4154 139.628 17.08 139.628 17.8923L137.845 17.1415C137.845 16.0092 138.065 14.9836 138.506 14.0646C138.955 13.1456 139.611 12.4154 140.475 11.8738C141.34 11.3241 142.403 11.0492 143.667 11.0492C144.664 11.0492 145.487 11.2133 146.135 11.5415C146.783 11.8697 147.298 12.2882 147.681 12.7969C148.063 13.3056 148.345 13.8472 148.528 14.4215C148.711 14.9959 148.827 15.5415 148.877 16.0585C148.936 16.5672 148.965 16.9815 148.965 17.3015V24.7231H145.923ZM136.586 24.7231V11.4308H139.266V15.5538H139.628V24.7231H136.586Z" fill="white"/>
                                <path d="M157.87 25.0923C156.507 25.0923 155.31 24.801 154.28 24.2185C153.249 23.6359 152.443 22.8277 151.861 21.7938C151.288 20.76 151.001 19.5703 151.001 18.2246C151.001 16.7723 151.284 15.5128 151.849 14.4462C152.414 13.3713 153.199 12.5385 154.205 11.9477C155.21 11.3569 156.374 11.0615 157.695 11.0615C159.091 11.0615 160.276 11.3856 161.248 12.0338C162.229 12.6738 162.956 13.5805 163.43 14.7538C163.903 15.9272 164.082 17.3097 163.966 18.9015H160.986V17.8185C160.978 16.3744 160.72 15.32 160.213 14.6554C159.706 13.9908 158.909 13.6585 157.82 13.6585C156.59 13.6585 155.676 14.0359 155.078 14.7908C154.479 15.5374 154.18 16.6328 154.18 18.0769C154.18 19.4226 154.479 20.4646 155.078 21.2031C155.676 21.9415 156.548 22.3108 157.695 22.3108C158.435 22.3108 159.071 22.1508 159.603 21.8308C160.143 21.5026 160.558 21.0308 160.849 20.4154L163.816 21.3015C163.301 22.4995 162.503 23.4308 161.423 24.0954C160.351 24.76 159.166 25.0923 157.87 25.0923ZM153.233 18.9015V16.6615H162.495V18.9015H153.233Z" fill="white"/>
                                <path d="M24.5473 11.8941C25.1905 12.5063 25.2068 13.5149 24.5837 14.1468L18.7585 20.054C18.1354 20.686 17.1087 20.702 16.4654 20.0898C15.8222 19.4776 15.8059 18.469 16.429 17.8371L22.2542 11.9299C22.8773 11.2979 23.904 11.2819 24.5473 11.8941Z" fill="url(#paint0_linear_9147_12012)"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 4.54673C0 2.03564 2.07211 0 4.62819 0H21.5399V0.00124069C28.9908 0.0998525 35 6.06429 35 13.4075C35 20.8123 28.8897 26.8151 21.3523 26.8151C18.6648 26.8151 16.1587 26.052 14.0463 24.7342L6.58815 31.9057C4.13431 34.2652 0 32.5573 0 29.1841V4.54673ZM11.5194 22.7055C9.15709 20.295 7.70452 17.0179 7.70452 13.4075C7.70452 12.5277 8.43056 11.8144 9.32619 11.8144C10.2218 11.8144 10.9479 12.5277 10.9479 13.4075C10.9479 19.0526 15.6061 23.6288 21.3523 23.6288C27.0985 23.6288 31.7567 19.0526 31.7567 13.4075C31.7567 7.76248 27.0985 3.18626 21.3523 3.18626H4.62819C3.86336 3.18626 3.24334 3.79536 3.24334 4.54673V29.1841C3.24334 29.7351 3.91866 30.014 4.31948 29.6286L11.5194 22.7055Z" fill="url(#paint1_linear_9147_12012)"/>
                                <defs>
                                <linearGradient id="paint0_linear_9147_12012" x1="35" y1="1.89063" x2="1.11152" y2="33.4573" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#7C3AED"/>
                                <stop offset="0.993738" stop-color="#4F46E5"/>
                                </linearGradient>
                                <linearGradient id="paint1_linear_9147_12012" x1="35" y1="1.89063" x2="1.11152" y2="33.4573" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#7C3AED"/>
                                <stop offset="0.993738" stop-color="#4F46E5"/>
                                </linearGradient>
                                </defs>
                                </svg>
                                
                        </a>
                        <ul class="text-md text-center sm:flex flex-wrap items-center justify-center gap-14 lg:gap-10 xl:gap-14 transition-all duration-500">
                            <li><a href="#" class="text-white hover:text-gray-400">HOME</a></li>
                            <li><a href="#"  class="text-white hover:text-gray-400">CATEGORIES</a></li>
                            <li><a href="#"  class="text-white hover:text-gray-400">LISTING PAGE</a></li>
                            <li><a href="#"  class="text-white hover:text-gray-400">ABOUT US</a></li>
                            <li><a href="#"  class="text-white hover:text-gray-400">CONTACT US</a></li>
                            <li><a href="#"  class="text-white hover:text-gray-400">ADVERTISE</a></li>
                        </ul>
                        <div class="flex space-x-4 sm:justify-center  ">
                            <a href="#"  class="w-9 h-9 rounded-full bg-gray-800 flex justify-center items-center hover:bg-indigo-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path id="Vector" d="M11.3214 8.93666L16.4919 3.05566H15.2667L10.7772 8.16205L7.1914 3.05566H3.05566L8.47803 10.7774L3.05566 16.9446H4.28097L9.022 11.552L12.8088 16.9446H16.9446L11.3211 8.93666H11.3214ZM9.64322 10.8455L9.09382 10.0765L4.72246 3.95821H6.60445L10.1322 8.8959L10.6816 9.66481L15.2672 16.083H13.3852L9.64322 10.8458V10.8455Z" fill="white"/>
                                </svg>
                                    
                            </a>
                            <a href="#"  class="w-9 h-9 rounded-full bg-gray-800 flex justify-center items-center hover:bg-indigo-600">
                                <svg class="w-[1.25rem] h-[1.125rem] text-white" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.70975 7.93663C4.70975 6.65824 5.76102 5.62163 7.0582 5.62163C8.35537 5.62163 9.40721 6.65824 9.40721 7.93663C9.40721 9.21502 8.35537 10.2516 7.0582 10.2516C5.76102 10.2516 4.70975 9.21502 4.70975 7.93663ZM3.43991 7.93663C3.43991 9.90608 5.05982 11.5025 7.0582 11.5025C9.05658 11.5025 10.6765 9.90608 10.6765 7.93663C10.6765 5.96719 9.05658 4.37074 7.0582 4.37074C5.05982 4.37074 3.43991 5.96719 3.43991 7.93663ZM9.97414 4.22935C9.97408 4.39417 10.0236 4.55531 10.1165 4.69239C10.2093 4.82946 10.3413 4.93633 10.4958 4.99946C10.6503 5.06259 10.8203 5.07916 10.9844 5.04707C11.1484 5.01498 11.2991 4.93568 11.4174 4.81918C11.5357 4.70268 11.6163 4.55423 11.649 4.39259C11.6817 4.23095 11.665 4.06339 11.6011 3.91109C11.5371 3.7588 11.4288 3.6286 11.2898 3.53698C11.1508 3.44536 10.9873 3.39642 10.8201 3.39635H10.8197C10.5955 3.39646 10.3806 3.48424 10.222 3.64043C10.0635 3.79661 9.97434 4.00843 9.97414 4.22935ZM4.21142 13.5892C3.52442 13.5584 3.15101 13.4456 2.90286 13.3504C2.57387 13.2241 2.33914 13.0738 2.09235 12.8309C1.84555 12.588 1.69278 12.3569 1.56527 12.0327C1.46854 11.7882 1.3541 11.4201 1.32287 10.7431C1.28871 10.0111 1.28189 9.79119 1.28189 7.93669C1.28189 6.08219 1.28927 5.86291 1.32287 5.1303C1.35416 4.45324 1.46944 4.08585 1.56527 3.84069C1.69335 3.51647 1.84589 3.28513 2.09235 3.04191C2.3388 2.79869 2.57331 2.64813 2.90286 2.52247C3.1509 2.42713 3.52442 2.31435 4.21142 2.28358C4.95417 2.24991 5.17729 2.24319 7.0582 2.24319C8.9391 2.24319 9.16244 2.25047 9.90582 2.28358C10.5928 2.31441 10.9656 2.42802 11.2144 2.52247C11.5434 2.64813 11.7781 2.79902 12.0249 3.04191C12.2717 3.2848 12.4239 3.51647 12.552 3.84069C12.6487 4.08513 12.7631 4.45324 12.7944 5.1303C12.8285 5.86291 12.8354 6.08219 12.8354 7.93669C12.8354 9.79119 12.8285 10.0105 12.7944 10.7431C12.7631 11.4201 12.6481 11.7881 12.552 12.0327C12.4239 12.3569 12.2714 12.5882 12.0249 12.8309C11.7784 13.0736 11.5434 13.2241 11.2144 13.3504C10.9663 13.4457 10.5928 13.5585 9.90582 13.5892C9.16306 13.6229 8.93994 13.6296 7.0582 13.6296C5.17645 13.6296 4.95395 13.6229 4.21142 13.5892ZM4.15307 1.03424C3.40294 1.06791 2.89035 1.18513 2.4427 1.3568C1.9791 1.53408 1.58663 1.77191 1.19446 2.1578C0.802277 2.54369 0.56157 2.93108 0.381687 3.38797C0.207498 3.82941 0.0885535 4.3343 0.0543922 5.07358C0.0196672 5.81402 0.0117188 6.05074 0.0117188 7.93663C0.0117188 9.82252 0.0196672 10.0592 0.0543922 10.7997C0.0885535 11.539 0.207498 12.0439 0.381687 12.4853C0.56157 12.9419 0.802334 13.3297 1.19446 13.7155C1.58658 14.1012 1.9791 14.3387 2.4427 14.5165C2.89119 14.6881 3.40294 14.8054 4.15307 14.839C4.90479 14.8727 5.1446 14.8811 7.0582 14.8811C8.9718 14.8811 9.212 14.8732 9.96332 14.839C10.7135 14.8054 11.2258 14.6881 11.6737 14.5165C12.137 14.3387 12.5298 14.1014 12.9219 13.7155C13.3141 13.3296 13.5543 12.9419 13.7347 12.4853C13.9089 12.0439 14.0284 11.539 14.062 10.7997C14.0962 10.0587 14.1041 9.82252 14.1041 7.93663C14.1041 6.05074 14.0962 5.81402 14.062 5.07358C14.0278 4.33424 13.9089 3.82913 13.7347 3.38797C13.5543 2.93135 13.3135 2.5443 12.9219 2.1578C12.5304 1.7713 12.137 1.53408 11.6743 1.3568C11.2258 1.18513 10.7135 1.06735 9.96388 1.03424C9.21256 1.00058 8.97236 0.992188 7.05876 0.992188C5.14516 0.992188 4.90479 1.00002 4.15307 1.03424Z" fill="currentColor"/>
                                    </svg>
                                    
                            </a>
                            <a href="javascript:;"  class="w-9 h-9 rounded-full bg-gray-800 flex justify-center items-center hover:bg-indigo-600">
                                <svg class="w-[1rem] h-[1rem] text-white" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.8794 11.5527V3.86835H0.318893V11.5527H2.87967H2.8794ZM1.59968 2.81936C2.4924 2.81936 3.04817 2.2293 3.04817 1.49188C3.03146 0.737661 2.4924 0.164062 1.61666 0.164062C0.74032 0.164062 0.167969 0.737661 0.167969 1.49181C0.167969 2.22923 0.723543 2.8193 1.5829 2.8193H1.59948L1.59968 2.81936ZM4.29668 11.5527H6.85698V7.26187C6.85698 7.03251 6.87369 6.80255 6.94134 6.63873C7.12635 6.17968 7.54764 5.70449 8.25514 5.70449C9.18141 5.70449 9.55217 6.4091 9.55217 7.44222V11.5527H12.1124V7.14672C12.1124 4.78652 10.8494 3.68819 9.16483 3.68819C7.78372 3.68819 7.17715 4.45822 6.84014 4.98267H6.85718V3.86862H4.29681C4.33023 4.5895 4.29661 11.553 4.29661 11.553L4.29668 11.5527Z" fill="currentColor"/>
                                    </svg>
                                    
                            </a>
                            <a href="javascript:;"  class="w-9 h-9 rounded-full bg-gray-800 flex justify-center items-center hover:bg-indigo-600">
                                <svg class="w-[1.25rem] h-[0.875rem] text-white" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9346 1.13529C14.5684 1.30645 15.0665 1.80588 15.2349 2.43896C15.5413 3.58788 15.5413 5.98654 15.5413 5.98654C15.5413 5.98654 15.5413 8.3852 15.2349 9.53412C15.0642 10.1695 14.5661 10.669 13.9346 10.8378C12.7886 11.1449 8.19058 11.1449 8.19058 11.1449C8.19058 11.1449 3.59491 11.1449 2.44657 10.8378C1.81277 10.6666 1.31461 10.1672 1.14622 9.53412C0.839844 8.3852 0.839844 5.98654 0.839844 5.98654C0.839844 5.98654 0.839844 3.58788 1.14622 2.43896C1.31695 1.80353 1.81511 1.30411 2.44657 1.13529C3.59491 0.828125 8.19058 0.828125 8.19058 0.828125C8.19058 0.828125 12.7886 0.828125 13.9346 1.13529ZM10.541 5.98654L6.72178 8.19762V3.77545L10.541 5.98654Z" fill="currentColor"/>
                                    </svg>
                                    
                            </a>
                        </div>
                    </div>
                    <!--Grid-->
                    <div class="py-7 border-t border-gray-700">
                        <div class="flex items-center justify-center">
                            <span class="text-white ">©<a href="https://pagedone.io/">AlaskaList</a>2024, All rights reserved.</span>
                        </div>
                    </div>
                </div>
            </footer>
    </div>
    @livewireScripts
</body>
</html>