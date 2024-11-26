<?php

use Livewire\Volt\Component;

new class extends Component {
    public $currentDate;
    public $month;
    public $year;

    public function mount()
    {
        // Set the current date in the specified timezone
        $now = new \DateTime('now', new \DateTimeZone(config('app.timezone')));
        $this->currentDate = $now->format('Y-m-d');
        $this->month = $now->format('m'); // Month in numeric format
        $this->year = $now->format('Y');
    }

}; ?>
<div class="flex flex-col items-center px-6 py-8 mt-10 space-y-4">
    <!-- Calendar -->
    <div class="border rounded-lg p-4 w-full">
        <span class="text-lg font-bold text-[#2171a7] flex justify-center item-center self-center">Calendar</span>
        <hr class=" my-2">
        <div class="flex justify-between items-center mb-4">
            @php
                $currentDateTime = new \DateTime('now', new \DateTimeZone(config('app.timezone')));
                $currentMonthYear = $currentDateTime->format('F Y');
            @endphp
            <span class="text-lg font-bold text-[#2171a7]  ">{{ $currentMonthYear }}</span>
        </div>
        <!-- Days of the Week -->
        <div class="grid grid-cols-7 gap-2 text-center font-semibold text-[#2171a7] lg-max:text-sm">
            <div>Sun</div>
            <div>Mon</div>
            <div>Tue</div>
            <div>Wed</div>
            <div>Thu</div>
            <div>Fri</div>
            <div>Sat</div>
        </div>
        <!-- Days of the Month -->
        <div class="grid grid-cols-7 gap-2 mt-2 text-center">
            @php
                $firstDayOfMonth = new \DateTime("$year-$month-01", new \DateTimeZone(config('app.timezone')));
                $daysInMonth = $firstDayOfMonth->format('t'); // Number of days in the month
                $startDay = $firstDayOfMonth->format('w'); // Day of the week the month starts on (0 = Sunday, 6 = Saturday)
            @endphp
            @for ($i = 0; $i < $startDay; $i++)
                <div class="text-gray-300"></div> <!-- Empty cells for days before the month starts -->
            @endfor
            @for ($day = 1; $day <= $daysInMonth; $day++)
                @php
                    $date = sprintf('%04d-%02d-%02d', $year, $month, $day);
                @endphp
                <div class="{{ $date === $currentDate ? 'bg-[#2171a7] text-white' : 'text-gray-600' }}">
                    {{ $day }}
                </div>
            @endfor
        </div>
    </div>

<div class="border border-gray-200 divide-gray-200 rounded shadow w-full">
    <p class="p-4 mb-4 border-b text-lg font-bold text-[#2171a7]">Browse Items by Location</p>
    <div class="grid grid-cols-1 gap-2 pl-6 pb-5 text-gray-600 overflow-auto max-h-96  scrollbar-thumb-[#2171a7] scrollbar-track-transparent scrollbar-thin  ">
        @foreach (config('global.us_states') as $location)
            <a href="{{ "listing-page?location=$location" }}" wire:navigate>
                <span>{{ $location }}</span>
            </a>
        @endforeach
    </div>
</div>

    
</div>





