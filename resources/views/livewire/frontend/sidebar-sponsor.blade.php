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
        <livewire:frontend.sponsored-listing/>
    </div>
</div>