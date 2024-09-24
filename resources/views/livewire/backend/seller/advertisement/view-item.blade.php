<?php

use App\Traits\ListingOption;
use App\Models\Advertisement;
use App\Models\AdvertisingPlan;
use Livewire\WithFileUploads;
use Livewire\Volt\Component;

new class extends Component {

    use ListingOption;
    use WithFileUploads;
    
    public $uuid;
    public $advertisement;
    public $advertising_plan_id;
    public $plans;
    public $from_date = '';
    public $to_date = '';
    public $file_name = '';
    public $file_path;
    public $photo = '';
    public $inc = 1;
    
    public function mount()
    {
        $advertisement_id = request()->route('id');
        $this->advertisement = Advertisement::with(['advertisingPlan', 'boostedProduct'])->withTrashed()->find($advertisement_id);
        $this->advertising_plan_id = $this->advertisement->advertising_plan_id;
        $this->uuid = $this->advertisement->uuid;
        $this->from_date = $this->advertisement->from_date;
        $this->to_date = $this->advertisement->to_date;
        $this->file_path = $this->advertisement->file_path;
        $this->plans = AdvertisingPlan::get();
    }

    public function editAdvertisement()
    {
        $photo = $this->photo;
        
        if ($photo) {
            $base_photo = base64_encode(file_get_contents($photo->getRealPath()));
            $photo_img = Image::make($base_photo);
            
            if ($this->checkResponsiveImage($photo_img)) {
                $this->addError('image_constraint', 'The image width must not exceed 1920 pixels, and the height must not exceed 1080 pixels.');
                return;
            }
            
            $this->advertisement->update([
                'from_date' => $this->formatIso($this->from_date),
                'to_date' => $this->formatIso($this->to_date),
                'advertising_plan_id' => $this->advertising_plan_id,
                'updated_by' => auth()->user()->id,
            ]);

            $this->storePhoto($this->advertisement->file_name, $photo_img->getWidth(), $photo_img->getHeight(), 'advertisement', $photo);
        }

        session()->flash('alert-success', 'Featured Listing Successfully Edited');
        $this->redirect(route('seller-advertisement'), navigate: true);
    }

    public function clearPhoto()
    {
        $this->reset('photo');
    }
}; ?>

<div class="py-8">
    <div class="px-4 py-8 mx-auto space-y-8 bg-white shadow sm:container sm:rounded-lg sm:px-6 lg:px-8">
        <a class="inline-block mb-4 font-medium text-sky-600" href="{{ route('seller-advertisement') }}" wire:navigate>
            <span class="flex items-center space-x-2 cursor-pointer hover:opacity-70">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span>Back to Featured Listing</span>
            </span>
        </a>
        <div class="grid pb-8 xl:gap-8 xl:grid-cols-2">
            <div>
                <form wire:submit="editAdvertisement">
                    <div class="grid grid-cols-2 gap-x-8 gap-y-4">
                        <div class="space-y-2">
                            <p class="font-medium text-slate-700">Featured Code</p>
                            <input class="text-base w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" wire:model="uuid" readonly>
                        </div>
                        <div class="space-y-2">
                            <p class="font-medium text-slate-700">Advertising Plan</p>
                            <select 
                                class="text-base w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55] disabled:border-slate-300" 
                                id="advertising-plan-{{ $uuid }}"
                                wire:model="advertising_plan_id" 
                                required
                                disabled
                            >
                                <option value="" disabled selected>Select at least one</option>
                                @foreach ($plans as $plan)
                                    <option value="{{ $plan->duration_days }}" data-advertising-id="{{ $plan->id }}">{{ $plan->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div
                            class="space-y-2"
                            x-data="{ 
                                from_date: moment(new Date(`${{ $from_date }} UTC`)).format('YYYY-MM-DDTHH:mm') 
                            }"
                        >
                            <p class="font-medium text-slate-700">From Date</p>
                            <input 
                                class="text-base w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" 
                                id="from-date-{{ $uuid }}"
                                type="datetime-local" 
                                x-model="from_date"
                                readonly
                                required
                            >
                        </div>
                        <div 
                            class="space-y-2"
                            x-data="{ 
                                to_date: moment(new Date(`${{ $to_date }} UTC`)).format('MM/DD/YYYY') 
                            }"
                        >
                            <p class="font-medium text-slate-700">To Date</p>
                                <input 
                                class="text-base w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" 
                                id="to-date-{{ $uuid }}"
                                type="text"
                                x-model="to_date"
                                readonly
                                required
                            >
                        </div>
                        <div class="flex flex-col col-span-2 space-y-2">
                            <label class="font-medium text-slate-700">Replace New Photo </label>
                            <input 
                                class="text-md w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" 
                                type="file" 
                                wire:model="photo" 
                                id="upload-{{ $inc }}"
                            >
                        </div>
                        @error('image_constraint')                                
                            <div class="flex flex-col col-span-2 space-y-2">
                                <label class="mb-2 text-sm text-red-600">
                                    Note: {{ $message }}
                                </label>
                            </div>
                        @enderror
                        {{-- Loading Animation --}}
                        <div class="w-full text-center" wire:loading>
                            <div class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5 text-[#1F4B55]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 2.042.777 3.908 2.05 5.334l1.95-2.043z"></path>
                                </svg>
                                <span class="font-medium text-md text-slate-600">Saving post...</span>
                            </div>
                        </div>
                        @if ($photo)                            
                            <div class="flex col-span-2 gap-2">
                                <button
                                    class="px-4 py-2 text-white bg-red-500 rounded-lg hover:bg-red-600"
                                    type="button"
                                    wire:click="clearPhoto"
                                >
                                    Remove Photo
                                </button>
                                <button 
                                    class="text-white bg-[#1F4B55] shadow py-2 px-4 rounded-lg hover:opacity-70" 
                                    type="submit"
                                >
                                    Save
                                </button>

                            </div>
                        @endif
                        @if($advertisement->boostedProduct)
                            <div class="col-span-2 space-y-4">
                                <span>Boosted Listing</span>
                                <div class="max-w-96">                                    
                                    <a href="{{ route('listing-page-item', $advertisement->boostedProduct->id) }}" class="block mb-8 overflow-hidden transition duration-300 bg-white border shadow-lg border-yellow-50 rounded-2xl hover:border-yellow-600 hover:no-underline" wire:navigate wire:key="{{ 'product-item-listing-'.$advertisement->boostedProduct->id }}">
                                        <div class="flex flex-col h-full">
                                            @php
                                                $images = explode(',', $advertisement->boostedProduct->file_path);
                                                $firstImage = trim($images[0]);
                                            @endphp 
            
                                            <div class="relative">
                                                <img class="object-cover w-full h-56 rounded-t-xl" src="{{ asset($firstImage) }}" alt="{{ $advertisement->boostedProduct->name }}">
                                                <div class="absolute px-3 py-1 text-xs font-bold text-white bg-yellow-500 rounded-full top-4 left-4">Boosted</div>
                                            </div>
                                            
                                            <div class="flex-1 p-6 bg-gradient-to-b from-yellow-50 to-white">
                                                <p class="mb-2 text-lg font-semibold text-gray-800">{{ $advertisement->boostedProduct->name }}</p>
                                                <p class="mb-2 text-sm text-gray-600">{{ Str::limit($advertisement->boostedProduct->description, 150) }}</p>
                                                @if ($advertisement->boostedProduct->price)
                                                    <p class="mb-4 text-lg font-semibold text-yellow-600">${{ number_format($advertisement->boostedProduct->price, fmod($advertisement->boostedProduct->price, 1) !== 0.00 ? 2 : 0) }}</p>
                                                @endif
                                                <div class="flex items-center my-4 space-x-2">
                                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $advertisement->boostedProduct->subCategory->name }}</span>
                                                </div>
                                                @if ($advertisement->boostedProduct->qty)
                                                    <p class="text-sm text-gray-600">Available: <span class="text-gray-500">{{ $advertisement->boostedProduct->qty }}</span></p>
                                                @endif
                                            </div>
                                            
                                            <div class="p-6 border-t border-yellow-200 bg-yellow-50 rounded-b-xl">
                                                <div class="flex flex-wrap items-center justify-between gap-4 mb-4" wire:ignore>
                                                    <p class="font-bold text-green-500 timeago text-md" datetime="{{ $advertisement->boostedProduct->created_at }} {{ config('app.timezone') }}"></p>
                                                    <p class="text-gray-600">
                                                        📍 {{ $advertisement->boostedProduct->location ? $advertisement->boostedProduct->location : '' }}
                                                    </p>
                                                </div>
                                                <button class="px-4 py-2 font-bold text-white bg-yellow-500 rounded-xl hover:bg-yellow-600">
                                                    View Details
                                                </button>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
            <div class="w-full">
                @if (!empty($file_path))                                
                    <div class="flex flex-col space-y-4">
                        <label class="font-medium xl:text-right text-slate-700">Featured Image</label>
                        @if ($photo)
                            
                            <img 
                                class="object-contain w-full max-h-96"
                                src="{{ $photo->temporaryUrl() }}"
                                alt="Temporary Image"
                            >
                            @else
                            <img 
                                class="object-contain w-full max-h-96"
                                src="{{ asset($file_path) }}?v={{ md5_file(public_path($file_path)) }}"
                                alt="Image"
                            >
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@script
<script data-navigate-once>
    $(document).ready(function() {

        let component = @this;

        $('#advertising-plan-{{ $uuid }}, #from-date-{{ $uuid }}').on('change', function(){
            component.advertising_plan = $('#advertising-plan-{{ $uuid }}').find('option:selected').data('advertising-id');
            computedPlanDate();
        })

        function initializeTimeago() {
            const timeagoNodes = document.querySelectorAll('.timeago');
            if (timeagoNodes.length) {
                timeagoInstance = timeago.render(timeagoNodes);
            }
        }

        initializeTimeago();
        
        function computedPlanDate() {
            const duration = parseInt($('#advertising-plan-{{ $uuid }}').val(), 10);
            const fromDate = $('#from-date-{{ $uuid }}').val();

            if (fromDate === '' || isNaN(duration)) return;

            const fromDateISO = new Date(fromDate);
            
            // Calculate the new date by adding the duration
            const toDateISO = new Date(fromDateISO);
            toDateISO.setDate(toDateISO.getDate() + duration);

            // Format the to_date as YYYY-MM-DD for display
            const toDateFormatted = toDateISO.toISOString().split('T')[0];

            // Update the component and the display
            component.from_date = fromDateISO.toISOString();
            component.to_date = toDateISO.toISOString();
            
            $('#to-date-{{ $uuid }}').val(toDateFormatted);
        }
    });
</script>
@endscript