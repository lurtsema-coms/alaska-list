@extends('frontend-layout')

@section('body-content')
<div class="mt-14 mb-28 px-5">
    <div class="min-h-[55rem] container mx-auto relative" data-aos="zoom-in-up">
        <a class="inline-block font-medium text-sky-600 mb-4" href="{{ route('listing-page') }}" wire:navigate>
            <span class="flex items-center space-x-2 hover:opacity-70 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span>Back to Listing page</span>
            </span>
        </a>
        <div class="max-w-4xl">
            <p class="text-xl font-bold">Title</p>
            <p class="mb-4 text-slate-600">Place</p>
            <div class="space-y-8">
                <div class="shadow-md px-5 py-10 rounded-xl">
                    <div class="swiper-product-item swiper w-full">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper" id="lightgallery">
                            <div class="swiper-slide min-w-fit lg-item" data-src="https://picsum.photos/seed/1/576/300">
                                <div class="flex items-center justify-center overflow-hidden">
                                    <img class="max-h-full object-contain cursor-pointer" src="https://picsum.photos/seed/1/576/300" alt="Image 1">
                                </div>
                            </div>
                            <div class="swiper-slide min-w-fit lg-item" data-src="https://picsum.photos/seed/2/576/300">
                                <div class="flex items-center justify-center overflow-hidden">
                                    <img class="max-h-full object-contain cursor-pointer" src="https://picsum.photos/seed/2/576/300" alt="Image 2">
                                </div>
                            </div>
                            <div class="swiper-slide min-w-fit lg-item" data-src="https://picsum.photos/seed/3/576/300">
                                <div class="flex items-center justify-center overflow-hidden">
                                    <img class="max-h-full object-contain cursor-pointer" src="https://picsum.photos/seed/3/576/300" alt="Image 3">
                                </div>
                            </div>
                            <div class="swiper-slide min-w-fit lg-item" data-src="https://picsum.photos/seed/4/576/300">
                                <div class="flex items-center justify-center overflow-hidden">
                                    <img class="max-h-full object-contain cursor-pointer" src="https://picsum.photos/seed/4/576/300" alt="Image 4">
                                </div>
                            </div>
                        </div>
                        <!-- If we need pagination -->
                        <div class="swiper-pagination"></div>
                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
                <div class="space-y-2">
                    <p class="font-bold">Description</p>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cumque voluptates ducimus quos fugit dolore perspiciatis ad accusantium incidunt eius reiciendis.</p>
                    <p>ID: 123456789</p>
                </div>
                <div class="space-y-2">
                    <p class="font-bold">Additional Information</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore dignissimos quo sunt corrupti repellendus, fugiat ea ipsum earum nesciunt adipisci doloremque iusto minima rerum, eos est odio facere consectetur quas.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid, ipsum. Distinctio quasi dolorum animi, quaerat eos odio doloribus facilis delectus reiciendis atque sunt, ratione impedit vel. Hic magni eveniet amet facilis ea ex eaque, dignissimos, dolor autem eligendi pariatur nobis sequi voluptatum mollitia labore. Culpa ipsam reprehenderit alias atque obcaecati.</p>
                </div>
            </div>
        </div>
        <div class="absolute top-0 right-0 z-20"
            x-data="{ ads:true }"
            x-show="ads">
            <div class="h-auto w-96 bg-white shadow-xl p-5 space-y-4">
                <div class="flex justify-between items-center">
                    <p>Some Ads Here</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 text-slate-400 cursor-pointer hover:text-slate-500"
                    @click="ads = false;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </div>
                <livewire:frontend.sponsored-listing/>

                <!-- Content for Advertisers -->
                <div class="mt-6 p-4 bg-slate-100 rounded-md">
                    <h3 class="text-xl font-bold text-center mb-4 text-teal-700">Advertise with Us!</h3>
                    <p class="text-gray-700 leading-relaxed mb-2">
                        Looking to reach a larger audience and get your message noticed? 
                        Our platform offers premium ad placement opportunities for businesses and individuals looking to boost their visibility.
                    </p>
                    <h4 class="text-lg font-semibold mt-4 mb-2">Why Advertise Here?</h4>
                    <ul class="list-disc list-inside text-gray-600">
                        <li>Flexible ad formats to suit your needs and budget.</li>
                        <li>Dedicated support to help you maximize your ad performance.</li>
                    </ul>
                    
                    <h4 class="text-lg font-semibold mt-4 mb-2">Boost Your Listings!</h4>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        By boosting your listings, you can ensure that they appear at the top of relevant pages, gaining more visibility and attracting more potential customers.
                    </p>
                    <div class="text-center mt-6 mb-2">
                        <a href="/advertise-with-us" class="bg-teal-700 text-white py-2 px-4 rounded hover:bg-teal-800">
                            Learn More About Advertising
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script data-navigate-once>
    document.addEventListener('livewire:navigated', function () {
        const swiper = new Swiper('.swiper-product-item', {
            centeredSlides: true,
            allowTouchMove: false,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

        lightGallery(document.getElementById('lightgallery'), {
            speed: 500,
            plugins: [lgThumbnail],
            enableDrag: false,
            enableSwipe: false
        });
    });
</script>
@endsection
