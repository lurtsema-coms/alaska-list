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
        $today = now()->toDateTimeString();

        return SpecialBoost::with('product')
            ->where('from_date', '<=', $today)
            ->where('to_date', '>=', $today)
            ->whereHas('product', function ($query) {
                $query->where('status', '!=', 'DELETED');
            })
            ->get();
    }
}; ?>

<div>
    @if (count($sponsors) == 0)
        <p class="text-sm text-center text-gray-600">No other products are boosted at the moment. Take advantage of this opportunity to get your product noticed first.</p>
    @endif
    <div class="w-full sponsored-listing swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            @foreach ($sponsors as $sponsor)
                <div class="swiper-slide " wire:key="sponsor-listing-{{ $sponsor->id }}">
                    <div class="swiper-slide py-6">
                        <a class="overflow-hidden w-full" href="{{ route('listing-page-item', $sponsor->product->id) }}" wire:navigate>
                            <div class="overflow-hidden max-h-96 max-w-80 border border-gray-200 rounded-xl shadow-lg m-auto hover:border-blue-400">
                                <div class="relative">
                                    @if ($sponsor->file_path)
                                        <img class="w-full object-cover h-48" src="{{ asset($sponsor->file_path) }}" alt="{{ $sponsor->product->name }}" loading="lazy">
                                        @else
                                            @if ($sponsor->product->file_path)
                                                @php
                                                    $paths = explode(',', $sponsor->product->file_path);
                                                    $firstPath = trim($paths[0]); // Ensure there are no leading or trailing spaces
                                                @endphp
                                                <img class="w-full object-cover h-48" src="{{ asset($firstPath) }}" alt="{{ $sponsor->product->name }}" loading="lazy">
                                            @endif
                                    @endif
                                    <div class="bg-white rounded-full py-1 px-3 shadow-lg absolute bottom-4 left-4">
                                        <p class="font-medium text-gray-600">
                                            ${{ number_format($sponsor->product->price, fmod($sponsor->product->price, 1) !== 0.00 ? 2 : 0) }}
                                        </p>
                                    </div>
                                </div>
                                <div class="p-4 bg-white">
                                    <p class="text-lg font-semibold text-gray-800">{{ \Illuminate\Support\Str::words($sponsor->product->name, 15, '...') }}</p>
                                    <p class="text-sm text-gray-600 mt-2">Available: {{ $sponsor->product->qty }}</p>
                                    <p class="text-sm text-gray-600 mt-2">{{ \Carbon\Carbon::parse($sponsor->product->created_at)->format('F j, Y') }}</p>
                                </div>
                            </div>
                        </a>
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
