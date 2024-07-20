<?php

use App\Models\Product;
use Livewire\Volt\Component;

new class extends Component {
    
    public $product_id;
    public $uuid;
    public $sub_category = '';
    public $title_name = '';
    public $price = '';
    public $qty = '';
    public $description = '';
    public $additional_information = '';
    public $photos = [];
    public $posted_by;
    public $contact;

    public function mount()
    {
        $product_id = request()->route('id');
        $product = Product::with('subCategory', 'createdBy')->find($product_id);
        
        $this->uuid = $product->uuid;
        $this->product_id = $product->id;
        $this->posted_by = $product->createdBy->first_name." ".$product->createdBy->last_name;
        $this->contact = $product->createdBy->contact_number;
        $this->sub_category = $product->subCategory->id;
        $this->title_name = $product->name;
        $this->price = $product->price;
        $this->qty = $product->qty;
        $this->description = $product->description;
        $this->additional_information = $product->additional_information;

        if(!empty($product->file_name)){
            $file_names = explode(',', $product->file_name);
            $file_paths = explode(',', $product->file_path);
            $count = count($file_names);

            for ($i = 0; $i < $count; $i++) {
                $this->photos[$i] = [
                    'file_names' => $file_names[$i],
                    'file_paths' => $file_paths[$i],
                ];
            }
        }        
    }
}; ?>

<div>
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
                    <p class="text-right mb-4">
                        @if ($qty === 0)                            
                            <span class="inline-block bg-red-100 text-red-700 rounded-full px-4 py-1 text-sm font-semibold shadow-sm">
                                Not Available
                            </span>
                        @else
                            <span class="inline-block bg-green-100 text-green-700 rounded-full px-4 py-1 text-sm font-semibold shadow-sm">
                                Available
                            </span>
                        @endif
                    </p>
                    <div class="swiper-product-item swiper w-full">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper" id="lightgallery">
                            @foreach ($photos as $index => $file)
                                <div class="swiper-slide min-w-fit" data-src="{{ asset($file['file_paths']) }}">
                                    <div class="flex items-center justify-center overflow-hidden">
                                        <img class="max-h-96 max-w-xl object-contain cursor-pointer" src="{{ asset($file['file_paths']) }}" alt="{{ asset($file['file_names']) }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- If we need pagination -->
                        <div class="swiper-pagination"></div>
                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
                <div class="space-y-2">
                    <p><span class="font-bold">Posted by: </span>{{ $posted_by }}</p>
                    <p><span class="font-bold">Contact: </span>{{ $contact }}</p>
                    <p><span class="font-bold">Price: </span><span class="text-green-600">${{ $price }}</span></p>
                </div>
                <div class="space-y-2">
                    <p class="font-bold">Description</p>
                    <p>{!! nl2br(e($description)) !!}</p>
                    <p><span class="font-bold">ID: </span>{{ $uuid }}</p>
                </div>
                <div class="space-y-2">
                    <p class="font-bold">Additional Information</p>
                    <p>{!! nl2br(e($additional_information)) !!}</p>
                </div>
            </div>
        </div>
        <div class="absolute top-0 right-0 z-20"
            x-data="{ ads:true }"
            x-show="ads">
            <div class="h-auto w-80 bg-white shadow-xl p-5 space-y-4 xsm:w-96">
                <div class="flex justify-between items-center">
                    <p class="font-bold">ADVERTISEMENT</p>
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
                        <a href="{{ route('advertise-with-us') }}" class="bg-teal-700 text-white py-2 px-4 rounded hover:bg-teal-800" wire:navigate>
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
        lightGallery(document.getElementById('lightgallery'), {
            speed: 500,
            plugins: [lgThumbnail],
            enableDrag: false,
            enableSwipe: false
        });

        const swiper = new Swiper(".swiper-product-item", {
            grabCursor: true,
            centeredSlides: true,
            allowTouchMove: false,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    });
</script>