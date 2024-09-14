<?php

use Livewire\Volt\Component;

new class extends Component {
    public $prohibitedModal = false;
}; ?>

<div 
    x-data="{ 
        prohibitedModal: localStorage.getItem('prohibitedModal') === 'true'
    }"
    x-init="
        if (localStorage.getItem('prohibitedModal') == null) {
            localStorage.setItem('prohibitedModal', 'true');
        }
    "
    @keydown.escape.window="prohibitedModal = false; localStorage.setItem('prohibitedModal', 'false')"
    class="relative z-50 w-auto h-auto">
    <template x-teleport="body">
        <div x-show="prohibitedModal" class="fixed inset-0 z-50 flex p-4 overflow-auto bg-black bg-opacity-30" x-cloak>
            <!-- Overlay -->
            <div x-show="prohibitedModal"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="prohibitedModal = false"
                class="absolute inset-0">
            </div>

            <!-- Modal Content -->
            <div x-show="prohibitedModal"
                x-trap.inert.noscroll="prohibitedModal"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative w-full max-w-2xl p-6 m-auto space-y-6 bg-white shadow-lg rounded-2xl"
                @click.outside="prohibitedModal = false; localStorage.setItem('prohibitedModal', 'false')"
                >
                
                <!-- Content -->
                <div class="relative">
                    <!-- Close Button -->
                    <button type="button" @click="prohibitedModal = false; localStorage.setItem('prohibitedModal', 'false')" class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-100">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>  
                    </button>
                    <h2 class="mb-4 mr-5 text-2xl font-bold">Full List of Prohibited Items</h2>
                    <p class="mb-6 text-gray-700">
                        To ensure the safety and integrity of our platform, please note that the following items are prohibited:
                    </p>
                    <ul class="pl-5 space-y-2 text-gray-700 list-disc">
                        <li>Counterfeit or imitation goods that infringe on trademarks.</li>
                        <li>Stolen property or items obtained illegally.</li>
                        <li>Adult content, including explicit materials and services.</li>
                        <li>Illegal drugs and paraphernalia.</li>
                        <li>Hazardous materials or substances.</li>
                        <li>Any items that violate our community guidelines or terms of service.</li>
                        <li>Animals or pets that are not allowed by local regulations.</li>
                    </ul>
                    <p class="mt-6 text-gray-600">
                        For further information or to report violations, please contact our support team.
                    </p>
                </div>
            </div>
        </div>
    </template>
</div>
