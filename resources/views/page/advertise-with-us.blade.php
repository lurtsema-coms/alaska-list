@extends('frontend-layout')

@section('body-content')
<div data-aos="zoom-in-up">
    <div class="relative bg-search-gradient h-80">
        <div class="absolute w-full h-full bg-top bg-cover" style="background-image: url('{{ asset('frontend/alaska-bg.jpg') }}'); background-position: 30% 60%;">
        </div>
        <div class="absolute inset-0 z-20 w-full h-full bg-search-gradient opacity-70">
        </div>
        {{-- <div class="absolute inset-0 z-30 flex items-center justify-center">
            <div class="container px-5 mx-auto font-sans font-semibold text-white text-shadow-custom sm:text-4xl">
                <p class="text-4xl">Advertise with us</p>
                <p class="text-lg">Boost your listing to the top and gain maximum visibility!</p>
            </div>
        </div> --}}
    </div>
    <div class="container relative z-30 px-10 pt-10 mx-auto bg-gray-50 -top-7 rounded-2xl">
        <div class="flex flex-col justify-between gap-8 md:flex-row">
            <div>
                <div id="advertise-with-us">
                    <div class="mb-6">
                        <h3 class="text-2xl font-semibold text-gray-700">Advertising Plans</h3>
                        <p class="mt-2 text-gray-600">Boost your listing to the top and gain maximum visibility!</p>
                        
                        <div class="mt-8">
                            <div class="max-w-4xl">
                                <h3 class="text-xl font-semibold text-gray-700">Boosted Listings ✅</h3>
                                <p class="mt-2 text-gray-600">Enhance your visibility and drive more traffic to your product with our Boosted Listings! These packages are tailored to get your offerings in front of more potential customers, ensuring your brand stands out in a crowded market.</p>
                                @php
                                    $plans = App\Models\AdvertisingPlan::all(); // Fetch all products
                                @endphp
                                <div class="mt-8 space-y-4">
                                    @foreach ($plans as $plan)
                                        <div class="w-full max-w-xl p-4 border rounded-md shadow-md bg-gray-50">
                                            <h4 class="text-lg font-semibold text-gray-800">{{ $plan->name }}</h4>
                                            <p class="text-gray-600">{{ $plan->description }}.</p>
                                        </div>
                                    @endforeach
                                </div>
                                <p class="mt-8 text-gray-600">For just an additional $1.00, pair any Featured Listing with a Boosted Listing. This combo maximizes your exposure, ensuring your product is not just listed, but prominently showcased!</p>
                            </div>
                        </div>
                    </div>

                    <div class="max-w-4xl">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-700">Alaska Life Highlights ✅</h3>
                            <p class="mt-2 text-gray-600">Take your marketing to the next level with our exclusive Alaska Life Highlights for $500. This premium advertising option offers unparalleled exposure through:</p>
                            <div class="mt-4">
                                <ul class="pl-5 space-y-2 text-gray-600 list-disc">
                                    <li>
                                        <span class="font-bold">Organic Posts on Our Facebook and Instagram Alaska Life Pages</span>: Leverage our engaged audience for increased visibility.
                                    </li>
                                    <li>
                                        <span class="font-bold">Listing on Our Website with Backlinks</span>: Improve your search engine optimization (SEO) and drive traffic to your site.
                                    </li>
                                    <li>
                                        <span class="font-bold">Personalized Marketing Consultation</span>: Get expert advice tailored to your brand to maximize your advertising impact.
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <p class="font-semibold text-gray-700">Impressive Reach Metrics:</p>
                            <div class="mt-4">
                                <ul class="pl-5 space-y-2 text-gray-600 list-disc">
                                    <li>
                                        866K Average Number of Followers
                                    </li>
                                    <li>
                                        8.5K Average Reach per post
                                    </li>
                                    <li>
                                        78K Average Impressions
                                    </li>
                                    <li>
                                        87% Engagement Rate
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <p class="mt-4 text-gray-600">These metrics demonstrate the effectiveness of our platforms in connecting you with your target audience.</p>
                    </div>

                    <div class="max-w-4xl mt-8">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-700">Split Test Advertising ✅</h3>
                            <p class="mt-2 text-gray-600">Optimize your campaign further with our Split Test Advertising for an additional $5 per day. We’ll conduct a split test to evaluate different messaging and graphics across four posts. This test will analyze key performance indicators such as engagement, click-through rates, impressions, and reach. With these insights, we can fine-tune your marketing strategy to ensure the best possible results.</p>
                            <div class="mt-4">
                                <p class="mb-4 font-semibold text-gray-700">What’s Included:</p>
                                <ul class="pl-5 space-y-2 text-gray-600 list-disc">
                                    <li>
                                        <span class="font-bold">Promotion on Facebook Groups</span>: Extend your reach by tapping into relevant community groups.
                                    </li>
                                    <li>
                                        <span class="font-bold">Analytical Report with Results</span>: Gain valuable insights into how your advertising is performing.
                                    </li>
                                    <li>
                                        <span class="font-bold">Upgraded Website Listing</span>: Ensure your product gets premium placement on our site.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    
                    <div class="mt-8">
                        <div class="mx-auto max-w-7xl">
                            <div class="max-w-2xl">
                                <h3 class="text-xl font-semibold text-gray-700">Why Choose Our Advertising Options ?</h3>
                            </div>
                            <div class="max-w-2xl mt-8 lg:max-w-4xl">
                            <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
                                <div class="relative pl-16">
                                <dt class="text-base font-semibold leading-7 text-gray-700">
                                    <div class="absolute top-0 left-0 flex items-center justify-center w-10 h-10 bg-[#285680] rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                        </svg>
                                    </div>
                                    Prominent Placement
                                </dt>
                                <dd class="mt-2 text-base leading-7 text-gray-600">Your product will be featured at the top of our listings, ensuring it grabs the attention of every visitor.</dd>
                                </div>
                                <div class="relative pl-16">
                                <dt class="text-base font-semibold leading-7 text-gray-700">
                                    <div class="absolute top-0 left-0 flex items-center justify-center w-10 h-10 bg-[#285680] rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </div>
                                    Enhanced Exposure
                                </dt>
                                <dd class="mt-2 text-base leading-7 text-gray-600">Our Boosted Listings increase the likelihood of your product being seen by those actively searching for similar items, giving you a competitive edge.</dd>
                                </div>
                                <div class="relative pl-16">
                                <dt class="text-base font-semibold leading-7 text-gray-700">
                                    <div class="absolute top-0 left-0 flex items-center justify-center w-10 h-10 bg-[#285680] rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                        </svg>
                                    </div>
                                    Target Audience
                                </dt>
                                <dd class="mt-2 text-base leading-7 text-gray-600">Our platform draws in users specifically interested in Alaskan products, allowing you to connect directly with potential buyers who are ready to engage.</dd>
                                </div>
                                <div class="relative pl-16">
                                <dt class="text-base font-semibold leading-7 text-gray-700">
                                    <div class="absolute top-0 left-0 flex items-center justify-center w-10 h-10 bg-[#285680] rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                                        </svg>
                                    </div>
                                    Flexible Plans
                                </dt>
                                <dd class="mt-2 text-base leading-7 text-gray-600">With a range of options, you can choose the promotion that best aligns with your marketing goals and budget.</dd>
                                </div>
                            </dl>
                            </div>
                        </div>
                    </div>
            
                </div>
            </div>
            <div>
                <livewire:frontend.sidebar-sponsor>
            </div> 
        </div>

        <div class="py-16 my-10 bg-white">
            <div class="max-w-2xl px-6 mx-auto lg:max-w-7xl lg:px-8">
                <p class="max-w-lg mx-auto mt-2 text-4xl font-medium tracking-tight text-center text-pretty text-gray-950 sm:text-3xl">Everything you need in advertising.</p>
                <div class="grid gap-4 mt-10 sm:mt-16 lg:grid-cols-3 lg:grid-rows-2">
                <div class="relative lg:row-span-2">
                    <div class="absolute inset-px rounded-lg bg-white lg:rounded-l-[2rem]"></div>
                    <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(theme(borderRadius.lg)+1px)] lg:rounded-l-[calc(2rem+1px)]">
                        <div class="px-8 pt-8 pb-3 sm:px-10 sm:pb-0 sm:pt-10">
                            <p class="mt-2 font-medium tracking-tight text-lg/7 text-gray-950 max-lg:text-center">How It Works</p>
                            <div class="flex flex-col gap-2">                        
                                <div>
                                    <p class="max-w-lg mt-2 font-medium text-gray-950 max-lg:text-center">1. Send a Message in the Contact Form.</p>
                                    <p class="max-w-lg mt-2 text-gray-600 max-lg:text-center">Begin the process by filling out our contact form with your product details and specific promotion requirements. This helps us understand your needs.</p>
                                </div>
                                <div>
                                    <p class="max-w-lg mt-2 font-medium text-gray-950 max-lg:text-center">2. Coordinate with Us</p>
                                    <p class="max-w-lg mt-2 text-gray-600 max-lg:text-center">Our dedicated team will reach out promptly to discuss the best promotional plan tailored to your goals. We’re here to answer your questions and guide you through the process.</p>
                                </div>
                                <div>
                                    <p class="max-w-lg mt-2 font-medium text-gray-950 max-lg:text-center">3. Your Product is at the Top of the Listing</p>
                                    <p class="max-w-lg mt-2 text-gray-600 max-lg:text-center">Once we finalize the details, your product will be prominently displayed at the top of our listings. This strategic placement ensures maximum visibility, leading to increased interest and potential sales.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pointer-events-none absolute inset-px rounded-lg shadow ring-1 ring-black/5 lg:rounded-l-[2rem]"></div>
                </div>
                <div class="relative max-lg:row-start-1">
                    <div class="absolute inset-px rounded-lg bg-white max-lg:rounded-t-[2rem]"></div>
                    <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(theme(borderRadius.lg)+1px)] max-lg:rounded-t-[calc(2rem+1px)]">
                        <div class="px-8 py-8 sm:px-10">
                            <p class="mt-2 font-medium tracking-tight text-lg/7 text-gray-950 max-lg:text-center">Terms and Conditions</p>
                            <p class="max-w-lg mt-2 text-gray-600 max-lg:text-center">All Boosted and Featured Listings are subject to approval.</p>
                            <p class="max-w-lg mt-2 text-gray-600 max-lg:text-center">Prices are subject to change and may vary based on promotional offerings and demand.</p>
                            <p class="max-w-lg mt-2 text-gray-600 max-lg:text-center">Boosted Listings are not guaranteed to remain at the top indefinitely, as they may rotate based on other active promotions.</p>
                        </div>
                    </div>
                    <div class="pointer-events-none absolute inset-px rounded-lg shadow ring-1 ring-black/5 max-lg:rounded-t-[2rem]"></div>
                </div>
                <div class="relative max-lg:row-start-3 lg:col-start-2 lg:row-start-2">
                    <div class="absolute bg-white rounded-lg inset-px"></div>
                    <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(theme(borderRadius.lg)+1px)]">
                    <div class="px-8 pt-8 sm:px-10 sm:pt-10">
                        <p class="mt-2 font-medium tracking-tight text-lg/7 text-gray-950 max-lg:text-center">Security</p>
                        <p class="max-w-lg mt-2 text-gray-600 max-lg:text-center">All payments are secure, ensuring that your personal and financial information is protected.</p>
                    </div>
                    <div class="flex flex-1 items-center [container-type:inline-size] max-lg:py-6 lg:pb-2">
                        <img class="h-[min(152px,40cqw)] object-cover object-center" src="https://tailwindui.com/plus/img/component-images/bento-03-security.png" alt="">
                    </div>
                    </div>
                    <div class="absolute rounded-lg shadow pointer-events-none inset-px ring-1 ring-black/5"></div>
                </div>
                <div class="relative lg:row-span-2">
                    <div class="absolute inset-px rounded-lg bg-white lg:rounded-r-[2rem]"></div>
                    <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(theme(borderRadius.lg)+1px)] lg:rounded-r-[calc(2rem+1px)]">
                    <div class="px-8 pt-8 pb-3 sm:px-10 sm:pb-0 sm:pt-10">
                        <p class="mt-2 font-medium tracking-tight text-lg/7 text-gray-950 max-lg:text-center">Take Action Now!</p>
                        <p class="max-w-lg mt-2 text-gray-600 max-lg:text-center">Don’t let your product go unnoticed in a competitive marketplace! By choosing our advertising options, you are investing in your brand’s visibility and success. Let us help you reach a broader audience and get your product seen by more people—start boosting your visibility on The Alaska List today!</p>
                        <div class="inline-block mt-8">
                            <a href="{{ route('register') }}" wire:navigate>
                                <div class="bg-[#2171a7] px-8 py-3 rounded-full text-white font-bold text-lg shadow-lg hover:bg-[#1a5b8a] transition-transform transform hover:scale-105 cursor-pointer">
                                    BE A SELLER NOW!
                                </div>
                            </a>
                        </div>
                    </div>
                    </div>
                    <div class="pointer-events-none absolute inset-px rounded-lg shadow ring-1 ring-black/5 lg:rounded-r-[2rem]"></div>
                </div>
                </div>
            </div>
            </div>

        </div>

            

        {{-- Get In Touch --}}
        <div id="get-in-touch" class="container mx-auto my-28" data-aos="zoom-in">
            <div class="px-5 md:px-0">
                <div class="flex w-full max-w-6xl mx-auto overflow-hidden rounded-2xl shadow-lg max-h-[50rem]  xl:shadow">
                    <div class="hidden w-full mb-4 xl:block xl:w-1/2 md:mb-0">
                        <img class="object-cover w-full h-auto bg-center" src="{{ asset('frontend/contact.jpg') }}" alt="Contact Image" loading="lazy">
                    </div>
                    <div class="flex items-center justify-center w-full p-5 lg:w-full xl:w-1/2 lg:bg-white">
                        <livewire:frontend.contact-us>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection