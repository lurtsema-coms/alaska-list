<?php

use App\Models\Product;
use Livewire\Volt\Component;

new class extends Component {
    
    public $product;
    public $product_id;
    public $uuid;
    public $sub_category = '';
    public $title_name = '';
    public $price = '';
    public $qty = '';
    public $location = '';
    public $description = '';
    public $additional_information = '';
    public $photos = [];
    public $posted_by;
    public $posted_at;
    public $contact;
    public $is_boosted;

    public function mount()
    {
        $product_id = request()->route('id');
        $product = Product::with('subCategory', 'createdBy')->find($product_id);
        
        $this->product = $product;
        $this->uuid = $product->uuid;
        $this->product_id = $product->id;
        $this->posted_by = $product->createdBy->first_name." ".$product->createdBy->last_name;
        $this->contact = $product->createdBy->contact_number;
        $this->sub_category = $product->subCategory->id;
        $this->title_name = $product->name;
        $this->price = $product->price;
        $this->qty = $product->qty;
        $this->location = $product->location;
        $this->description = $product->description;
        $this->additional_information = $product->additional_information;
        $this->posted_at = $product->created_at;
        $this->is_boosted = $product->ActiveSpecialBoostCount;

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
    <div class="min-h-[55rem] container mx-auto relative mt-40" data-aos="zoom-in-up">
        <a class="inline-block mb-4 font-medium text-sky-600" href="{{ route('listing-page') }}" wire:navigate>
            <span class="flex items-center space-x-2 cursor-pointer hover:opacity-70">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span>Back to Listing page</span>
            </span>
        </a>
        <div class="max-w-4xl">
            <div class="flex flex-col-reverse justify-between gap-4 mb-4 md:items-center md:flex-row">
                <div class="flex-1">
                    <p class="max-w-lg text-xl font-bold">{{ $title_name }}</p>
                </div>
                <livewire:frontend.report-listing :product="$product"/>
            </div>
            <div class="space-y-8">
                <div class="px-5 py-10 shadow-md rounded-xl border {{ $is_boosted != 0 ? "!border-4 border-yellow-200 bg-gradient-to-b from-yellow-50 to-white" : "" }}">
                    <p class="mb-4 space-x-2 text-right">
                        @if ($is_boosted != 0)
                            <span class="inline-block px-4 py-1 text-sm font-semibold text-white bg-yellow-500 rounded-full shadow-sm">
                                Boosted
                            </span>
                        @endif
                        @if ($qty === 0)                            
                            <span class="inline-block px-4 py-1 text-sm font-semibold text-red-700 bg-red-100 rounded-full shadow-sm">
                                Not Available
                            </span>
                        @else
                            <span class="inline-block px-4 py-1 text-sm font-semibold text-white bg-green-500 rounded-full shadow-sm">
                                Available
                            </span>
                        @endif
                    </p>
                    <div class="w-full swiper-product-item swiper">
                        <!-- Additional required wrapper -->
                        <div class="flex items-center swiper-wrapper" id="lightgallery">
                            @foreach ($photos as $index => $file)
                                <div class="swiper-slide min-w-fit" data-src="{{ asset($file['file_paths']) }}">
                                    <div class="flex items-center justify-center overflow-hidden">
                                        <img class="object-contain cursor-pointer max-h-96" src="{{ asset($file['file_paths']) }}" alt="{{ asset($file['file_names']) }}">
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
                    <p class="mt-4 text-center">{{ count($photos) > 1 ? count($photos).' '.'Images' : '1 Image' }} Available</p>
                </div>
                <div class="space-y-2">
                    <p><span class="font-bold">Posted by: </span> <span class="text-gray-600">{{ $posted_by }}</span></p>
                    <p><span class="font-bold">Contact: </span> <span class="text-gray-600">{{ $contact }}</span></p>
                    @if($price)
                        <p><span class="font-bold">Price: </span> <span class="text-blue-600">${{ $price }}</span></p>
                    @endif
                    @if ($qty)
                        <p><span class="font-bold">Available: </span> <span class="text-gray-600">{{ $qty }}</span></p>
                    @endif
                    <p><span class="font-bold">ID: </span> <span class="text-gray-600">{{ $uuid }}</span></p>
                </div>
                <div class="space-y-2">
                    <p class="font-bold">Description</p>
                    <p class="text-gray-600">{!! nl2br(e($description)) !!}</p>
                </div>
                @if ($additional_information)                    
                    <div class="space-y-2">
                        <p class="font-bold">Additional Information</p>
                        <p class="text-gray-600">{!! nl2br(e($additional_information)) !!}</p>
                    </div>
                @endif
                <div class="space-y-2">
                    <p><span class="font-bold">Location: </span> <span class="text-gray-600">{{ $location ? $location : '' }}</span></p>
                    <p><span class="font-bold">Date Publish: </span> <span class="text-gray-600">{{ \Carbon\Carbon::parse($posted_at)->format('F j, Y') }}</span></p>
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