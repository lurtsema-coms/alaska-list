<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Aos -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Timeago.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/timeago.js/4.0.2/timeago.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/css/lightgallery.min.css" integrity="sha512-F2E+YYE1gkt0T5TVajAslgDfTEUQKtlu4ralVq78ViNxhKXQLrgQLLie8u1tVdG2vWnB3ute4hcdbiBtvJQh0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/lightgallery.min.js" integrity="sha512-jEJ0OA9fwz5wUn6rVfGhAXiiCSGrjYCwtQRUwI/wRGEuWRZxrnxoeDoNc+Pnhx8qwKVHs2BRQrVR9RE6T4UHBg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/css/lg-thumbnail.min.css" integrity="sha512-GRxDpj/bx6/I4y6h2LE5rbGaqRcbTu4dYhaTewlS8Nh9hm/akYprvOTZD7GR+FRCALiKfe8u1gjvWEEGEtoR6g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/plugins/thumbnail/lg-thumbnail.min.js" integrity="sha512-VBbe8aA3uiK90EUKJnZ4iEs0lKXRhzaAXL8CIHWYReUwULzxkOSxlNixn41OLdX0R1KNP23/s76YPyeRhE6P+Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen font-sans antialiased bg-gray-50 text-slate-800">
    <div class="flex flex-col w-full min-h-screen">
        {{-- Navbar --}}
        <livewire:frontend.navbar>
        <div class="flex-1">
            @yield('body-content')
        </div>
        {{-- Footer --}}
        <livewire:frontend.footer>
        <x-scroll-up/>
    </div>
    @livewireScripts
    <script data-navigate-once>
        document.addEventListener('livewire:navigated', () => {
            AOS.init();

            if (window.location.hash === '#get-in-touch') {
                var element = document.getElementById('get-in-touch');
                if (element) {
                    var navbarHeight = 74;
                    var offsetPosition = element.offsetTop - navbarHeight - 20;

                    window.scrollTo({
                        top: element.offsetTop+170,
                        behavior: 'smooth'
                    });
                } 
            }
            
            const swiperContainer = document.querySelector(".sponsored-listing");
            if (swiperContainer) {
                const slides = swiperContainer.querySelectorAll('.swiper-slide');
                
                const swiper = new Swiper(".sponsored-listing", {
                    grabCursor: false,
                    centeredSlides: isSingleImage(),
                    allowTouchMove: false,
                    autoplay: {
                        delay: 5000, 
                        disableOnInteraction: false,
                    },
                    loop: false,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    breakpointsBase: 'container',
                    breakpoints: {
                        576: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        },
                        650: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        },
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 20,
                        },
                        1024: {
                            slidesPerView: 4,
                            spaceBetween: 20,
                        },
                        1300: {
                            slidesPerView: 4,
                            spaceBetween: 30,
                        },
                    },
                });
            }

            function isSingleImage() {
                const swiperContainer = document.querySelector(".sponsored-listing");
                if (swiperContainer) {
                    const slides = swiperContainer.querySelectorAll('.swiper-slide');
                    return slides.length === 1;
                }
                return false;
            }
        });
    </script>
</body>
</html>