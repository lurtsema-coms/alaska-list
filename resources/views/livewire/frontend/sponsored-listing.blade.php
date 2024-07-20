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
        $today = now()->toDateString();

        return SpecialBoost::with('product')
            ->where('from_date', '<=', $today)
            ->where('to_date', '>', $today)
            ->get();
    }
}; ?>

<div>
    @if (count($sponsors) == 0)
        <p class="text-center text-sm text-gray-600">No other products are boosted at the moment. Take advantage of this opportunity to get your product noticed first.</p>
    @endif
    <div class="sponsored-listing swiper w-full">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            @foreach ($sponsors as $sponsor)
                <div class="max-h-[300px] swiper-slide min-w-fit" wire:key="sponsor-listing-{{ $sponsor->id }}">
                    <div class="flex items-center justify-center overflow-hidden">
                        <a href="{{ route('listing-page-item', $sponsor->product->id) }}" wire:navigate>
                            <img class="h-[300px] object-contain" src="{{ asset($sponsor->file_path) }}" alt="Image 1">
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
