<div 
    class="fixed bottom-5 right-5" 
    x-data="{ scrolled: window.scrollY > 0 }" 
    @scroll.window="scrolled = window.scrollY > 0" 
    x-init="scrolled = window.scrollY > 0"
>
    <div 
        class="flex items-center justify-center w-12 h-12 bg-white border rounded-full shadow-sm cursor-pointer hover:opacity-70" 
        x-show="scrolled"
        @click="window.scrollTo({top: 0, behavior: 'smooth'})"
    >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75 12 3m0 0 3.75 3.75M12 3v18" />
        </svg>
    </div>
</div>