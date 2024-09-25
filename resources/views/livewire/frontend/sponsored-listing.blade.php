<?php

use App\Models\SpecialBoost;
use Livewire\Volt\Component;

new class extends Component {
    
    public function with(): array
    {
        return [
            'sponsors' => $this->loadSpecialBoost(),
        ];
    }

    public function loadSpecialBoost()
    {
        $today = now();

        return SpecialBoost::with('product.subCategory')
            ->where('from_date', '<=', $today)
            ->where('to_date', '>=', $today)
            ->whereHas('product', function ($query) {
                $query->where('status', '!=', 'DELETED');
            })
            ->get();
    }
}; ?>

<div>
    <div class="w-full sponsored-listing swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            @if(!$sponsors->isEmpty())
                @foreach ($sponsors as $sponsor)
                    <div class="swiper-slide" wire:key="{{ str()->random(50) }}">
                        {{-- <div class="swiper-slide"> --}}
                            <a class="w-full overflow-hidden" href="{{ route('listing-page-item', $sponsor->product->id) }}" wire:navigate>
                                <div class="w-full m-auto overflow-hidden bg-white h-96 max-w-[80rem] rounded-xl {{ Request::segment(1) != '' ? "border border-gray-200" : '' }} hover:border hover:border-blue-400">
                                    <div class="relative">
                                        @if ($sponsor->file_path)
                                            <img class="object-cover w-full h-48" src="{{ asset($sponsor->file_path) }}" alt="{{ $sponsor->product->name }}" loading="lazy">
                                            @else
                                                @if ($sponsor->product->file_path)
                                                    @php
                                                        $paths = explode(',', $sponsor->product->file_path);
                                                        $firstPath = trim($paths[0]); // Ensure there are no leading or trailing spaces
                                                    @endphp
                                                    <img class="object-cover w-full h-48" src="{{ asset($firstPath) }}" alt="{{ $sponsor->product->name }}" loading="lazy">
                                                @endif
                                        @endif
                                        <div class="absolute px-3 py-1 bg-white rounded-full shadow-lg bottom-4 left-4">
                                            <p class="font-medium text-gray-600">
                                                ${{ number_format($sponsor->product->price, fmod($sponsor->product->price, 1) !== 0.00 ? 2 : 0) }}
                                            </p>
                                        </div>
                                        <div class="absolute px-3 py-1 bg-[#18396F] rounded-full shadow-lg top-4 left-4">
                                            <p class="font-medium text-white">
                                                {{ $sponsor->product->subCategory->name }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="p-4 bg-white">
                                        <p class="text-lg font-semibold text-gray-800">{{ \Illuminate\Support\Str::words($sponsor->product->name, 15, '...') }}</p>
                                        <p class="mt-2 text-sm text-gray-600">Location: {{ $sponsor->product->location }}</p>
                                        <p class="mt-2 text-sm text-gray-600">{{ \Carbon\Carbon::parse($sponsor->product->created_at)->format('F j, Y') }}</p>
                                    </div>
                                </div>
                            </a>
                        {{-- </div> --}}
                    </div>
                @endforeach
                @else
                    <img class="object-cover w-full max-w-lg m-auto border rounded-2xl" src="{{ asset('frontend/product.png') }}" alt="">
            @endif
        </div>  
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
        <!-- If we need navigation buttons -->
        {{-- <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div> --}}
    </div>
</div>
