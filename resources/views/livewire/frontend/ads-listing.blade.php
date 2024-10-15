<?php

use App\Models\Advertisement;
use Livewire\Volt\Component;
use Illuminate\Http\Request;

new class extends Component {

    public function with(): array
    {
        return [
            'campaigns' => $this->loadAds(),
        ];
    }

    public function placeholder()
    {
        return view('location-skeleton');
    }

    public function loadAds()
    {
        $today = now();

        return Advertisement::withoutTrashed()
            ->where('from_date', '<=', $today)
            ->where('to_date', '>=', $today)
            ->get();
    }

}; ?>

<div x-init="
    const swiper = new Swiper('.swiper-add-listing-item', {
        navigation: false,
        grabCursor: false,
        centeredSlides: true,
        allowTouchMove: false,
        autoplay: {
            delay: 5000, 
            disableOnInteraction: false,
        },
    });
">
    @if (count($campaigns) != 0)
        <div class=" swiper-add-listing-item swiper">
            <div class="swiper-wrapper">
                @foreach ($campaigns as $campaign)
                <div class="swiper-slide" wire:key="{{ str()->random(50) }}">
                        <a href="{{ $campaign->product_id ? route('listing-page-item', $campaign->product_id) : '#' }}" >
                            <img class="object-contain m-auto rounded-2xl" src="{{ asset($campaign->file_path) . '?' . now()->timestamp }}" alt="{{ $campaign->uuid }}">
                        </a>
                    </div>
                @endforeach
            </div>  
        </div>
        @else
            <div x-data="{ isHomePage: window.location.pathname === '/' }">
                <template x-if="!isHomePage">
                    <div class="p-4 overflow-auto border border-gray-200 divide-gray-200 rounded shadow max-h-96">
                        <p class="pb-4 mb-4 font-medium border-b">Location</p>
                        <div class="grid grid-cols-2 gap-2 text-slate-500">
                            @foreach (config('global.us_states') as $location)
                                <a href="{{ "listing-page?location=$location" }}" wire:navigate>
                                    <span>{{ $location }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </template>
            </div>
    @endif
</div>