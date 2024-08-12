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
    <div class="fixed bottom-0 right-0 z-10"
        x-data="{ ads:true }"
        x-show="ads">
        <div class="h-auto p-5 space-y-4 bg-white border shadow-xl w-80 xsm:w-96">
            <div class="flex items-center justify-between">
                <p class="font-bold">ADVERTISEMENT</p>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer size-8 text-slate-400 hover:text-slate-500"
                @click="ads = false;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </div>
            <livewire:frontend.sponsored-listing/>

            <!-- Content for Advertisers -->
            @if (count($sponsors) == 0)
                <div class="p-4 mt-6 rounded-md bg-slate-100">
                    <h3 class="mb-4 text-xl font-bold text-center text-teal-700">Advertise Your Product with Us!</h3>
                    <p class="mb-4 leading-relaxed text-gray-700 text-center">
                        Are you looking to showcase your product to a larger audience? Our platform offers excellent advertising opportunities for businesses and individuals who want to boost their visibility and reach potential customers effectively.
                    </p>
                    <div class="mt-6 mb-2 text-center">
                        <a href="{{ route('advertise-with-us') }}" class="px-4 py-2 text-white bg-teal-700 rounded hover:bg-teal-800" wire:navigate>
                            Get Started with Advertising
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>