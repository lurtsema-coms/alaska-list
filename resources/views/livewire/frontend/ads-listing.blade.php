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
        $today = now()->toDateTimeString();

        return Advertisement::withoutTrashed()
            ->where('from_date', '<=', $today)
            ->where('to_date', '>=', $today)
            ->get();
    }

}; ?>

<div>
    @if (count($campaigns) != 0)
        <div class="w-full swiper-add-listing-item swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                @foreach ($campaigns as $campaign)
                    <div class="swiper-slide " wire:key="ad-listing-{{ $campaign->id }}">
                        <div class="swiper-slide">
                            <img class="object-cover w-full h-48 rounded-2xl" src="{{ asset($campaign->file_path) }}" alt="{{ $campaign->uuid }}" loading="lazy">
                        </div>
                    </div>
                @endforeach
            </div>  
        </div>
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
            delay: 10000, 
            disableOnInteraction: false,
        },
    });
</script>
@endscript