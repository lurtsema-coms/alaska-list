<?php

use App\Models\SpecialBoost;
use Livewire\Volt\Component;
use App\Models\Advertisement;

new class extends Component {

    public function with(): array
    {
        return [
            'sponsors' => $this->loadSpecialBoost(),
            'campaigns' => $this->loadAds(),
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

    public function loadAds()
    {
        $today = now()->toDateString();

        return Advertisement::withoutTrashed()
            ->whereDate('from_date', '<=', $today)
            ->whereDate('to_date', '>=', $today)
            ->get();
    }
}; ?>

<div class="w-full h-full md:w-80">
    <div class="sticky space-y-4 top-36">
        @if (count($campaigns) != 0)
        <div class="text-right">
            <p class="font-bold">ADVERTISEMENT</p>
        </div>
        @endif
        <livewire:frontend.ads-listing lazy/>
        {{-- @if (count($sponsors) != 0)
            <p class="mb-2 font-bold text-gray-600">You might also like</p>
        @endif --}}
        {{-- <livewire:frontend.sponsored-listing/> --}}
    </div>
</div>