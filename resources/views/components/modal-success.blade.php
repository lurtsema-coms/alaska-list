<div x-data="{ successModalOpen: $wire.entangle('successModalOpen') }"
    @keydown.escape.window="successModalOpen = false"
    class="relative z-50 w-auto h-auto">
    <template x-teleport="body">
        <div x-show="successModalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen p-5" x-cloak>
            <div x-show="successModalOpen" 
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="successModalOpen=false" class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
            <div x-show="successModalOpen"
                x-trap.inert.noscroll="successModalOpen"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative w-full py-6 bg-white rounded-2xl px-7 sm:max-w-lg">
                <div class="flex items-center justify-between pb-2">
                    <button type="button" @click="successModalOpen=false" class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>  
                    </button>
                </div>
                <div class="relative w-auto text-center">
                    <div class="flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-green-600 size-20">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <p class="text-lg text-gray-700 ">Success!</p>
                        <p class="max-w-sm mt-2 text-sm text-gray-500">{{ $message }}</p>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
