<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
    <div class="sponsored-listing swiper w-full">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <div class="swiper-slide min-w-fit">
                <div class="flex items-center justify-center overflow-hidden">
                    <img class="max-h-full object-contain" src="https://picsum.photos/seed/1/576/300" alt="Image 1">
                </div>
            </div>
            <div class="swiper-slide min-w-fit">
                <div class="flex items-center justify-center overflow-hidden">
                    <img class="max-h-full object-contain" src="https://picsum.photos/seed/2/576/300" alt="Image 2">
                </div>
            </div>
            <div class="swiper-slide min-w-fit">
                <div class="flex items-center justify-center overflow-hidden">
                    <img class="max-h-full object-contain" src="https://picsum.photos/seed/3/576/300" alt="Image 3">
                </div>
            </div>
            <div class="swiper-slide min-w-fit">
                <div class="flex items-center justify-center overflow-hidden">
                    <img class="max-h-full object-contain" src="https://picsum.photos/seed/4/576/300" alt="Image 4">
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
