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

<div class="w-full h-full md:w-80">
    <div class="sticky space-y-4 top-28">
        <div class="text-right">
            <p class="font-bold">ADVERTISEMENT</p>
        </div>
        @persist('ads-listing')
        <livewire:frontend.ads-listing/>
        @endpersist
        <p class="font-bold text-gray-600">You might also like</p>
        <livewire:frontend.sponsored-listing/>

        <!-- Content for Advertisers -->
        @if (count($sponsors) == 0)
            <div class="p-4 mt-6 rounded-md bg-slate-100">
                <h3 class="mb-4 text-xl font-bold text-center text-teal-700">Advertise Your Product with Us!</h3>
                <p class="mb-4 leading-relaxed text-center text-gray-700">
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