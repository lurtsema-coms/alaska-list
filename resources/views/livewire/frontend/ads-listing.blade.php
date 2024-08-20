<?php

use App\Models\Advertisement;
use Livewire\Volt\Component;

new class extends Component {
    
    public function with(): array
    {
        return [
            'campaigns' => $this->loadAds(),
        ];
    }

    public function loadAds()
    {
        $today = now()->toDateString();

        return Advertisement::withoutTrashed()
            ->whereDate('from_date', '<=', $today)
            ->whereDate('to_date', '>=', $today)
            ->get();
    }

}; ?>

<div>
    @if (count($campaigns) != 0)
        <div class="w-full h-full swiper-add-listing-item swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                @foreach ($campaigns as $campaign)
                    <div class="swiper-slide " wire:key="{{ str()->random(50) }}">
                        <div class="swiper-slide">
                            <img class="object-cover w-full h-full rounded-2xl" src="{{ asset($campaign->file_path) }}" alt="{{ $campaign->uuid }}" loading="lazy">
                        </div>
                    </div>
                @endforeach
            </div>  
        </div>
        @else
            <img class="object-cover w-full max-w-2xl m-auto rounded-2xl" src="{{ asset('frontend/ads.jpg') }}" alt="">
    @endif
</div>

@script
<script data-navigate-once>
    const swiper = new Swiper(".swiper-add-listing-item", {
        navigation: false,
        grabCursor: false,
        centeredSlides: true,
        allowTouchMove: false,
        autoplay: {
            delay: 5000, 
            disableOnInteraction: false,
        },
    });
</script>
@endscript