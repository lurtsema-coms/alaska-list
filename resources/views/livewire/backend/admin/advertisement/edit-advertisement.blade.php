<?php

use App\Models\AdvertisingPlan;
use App\Models\Advertisement;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Intervention\Image\Facades\Image as Image;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    
    use WithFileUploads;

    public $advertisement_id;
    public $uuid = '';
    public $advertising_plan = '';
    public $from_date = '';
    public $to_date = '';
    public $file_name = '';
    public $file_path;
    public $photo = '';
    public $inc = 1;
    public $edit_advertisement = false;

    public function mount($advertisement)
    {
        $this->advertisement_id = $advertisement->id;
        $this->uuid = $advertisement->uuid;
        $this->advertising_plan = $advertisement->advertising_plan_id;
        $this->from_date = $advertisement->from_date;
        $this->to_date = $advertisement->to_date;
        $this->file_path = $advertisement->file_path;
    }

    public function with(): array
    {
        return [
            'plans' => $this->loadAdvertisingPlans(),
        ];
    }

    public function loadAdvertisingPlans(){
        return AdvertisingPlan::get();
    }

    public function editSpecialBoost()
    {
        $photo = $this->photo;
        
        if($photo){
            $photo_img = Image::make($photo);
            $photo_height = $photo_img->getHeight();
            $photo_width = $photo_img->getWidth();
            
            if($photo_width > 1920 || $photo_height > 1080){
                $this->addError('image_constraint', 'The image width must be exceed 653 pixels, and the height must be 914 pixels.');
                return;
            }
        }

        $advertisement = Advertisement::with('advertisingPlan')->withTrashed()->find($this->advertisement_id);
        $advertisement->update([
            'from_date' => $this->formatIso($this->from_date),
            'to_date' => $this->formatIso($this->to_date),
            'advertising_plan_id' => $this->advertising_plan,
            'updated_by' => auth()->user()->id
        ]);

        if(!empty($photo)) {
            // Replace Photo
            $file_name = $advertisement->file_name;
            // Store the file in the public disk
            $path = $photo->storeAs(
                path: "public/photos/advertisement",
                name: $file_name
            );

            // Optimize image
            $file_path = storage_path("app/" . $path);
            $image = Image::make($file_path);
            $image->resize($photo_width, $photo_height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $image->fit($photo_width, $photo_height);
            $image->save($file_path, 80);

            $f_path = "storage/photos/advertisement/$file_name";
        }


        $this->resetData(['photo']);
        $this->edit_advertisement = false;
        $this->inc++;
        $this->dispatch('alert-success');
    }

    public function formatISO($date)
    {        
        $format_date = Carbon::parse($date, 'UTC');
        return $format_date->format('Y-m-d H:i:s');
    }


    public function resetData($data)
    {
        $this->reset($data);
    }
}; ?>

<div style="font-size: 16px;"
    x-data="{ edit_advertisement: $wire.entangle('edit_advertisement') }" x-init="$watch('edit_advertisement', value => {
        if (value) {
            document.body.classList.add('overflow-hidden');
        } else {
            document.body.classList.remove('overflow-hidden');
        }
    })">
    <button class="px-4 py-2 text-sm text-white bg-blue-400 rounded-lg shadow-md hover:bg-blue-500"
    @click="edit_advertisement=true;">
        EDIT
    </button>
    
    <div class="fixed top-0 left-0 z-10 w-full h-full overflow-auto bg-black position bg-opacity-30"
        x-show="edit_advertisement"
        x-transition
        x-cloak>
        <div class="flex h-full p-5">
            <div class="w-full max-w-xl m-auto overflow-hidden bg-white shadow-lg rounded-2xl"
            @click.outside="edit_advertisement=false; $wire.call('resetData', ['photo'])">
                <div class="p-10 max-h-[35rem] overflow-auto">
                    <form wire:submit="editSpecialBoost">
                        <p class="mb-6 text-lg font-bold tracking-wide pointer-events-none text-slate-700">Edit Boost</p>
                        <div class="space-y-4">
                            <div class="flex flex-col gap-4 sm:flex-row">
                                <div class="flex-1 space-y-2">
                                    <p class="font-medium text-slate-700">Item Code</p>
                                    <input class="text-base w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" wire:model="uuid" readonly>
                                </div>
                                <div class="flex-1 space-y-2">
                                    <p class="font-medium text-slate-700">Advertising Plan</p>
                                    <select 
                                        class="text-base w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" 
                                        id="advertising-plan-{{ $uuid }}"
                                        wire:model="advertising_plan" 
                                        required>
                                        <option value="" disabled selected>Select at least one</option>
                                        @foreach ($plans as $plan)
                                            <option value="{{ $plan->duration_days }}" data-advertising-id="{{ $plan->id }}">{{ $plan->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="flex flex-col gap-4 sm:flex-row">
                                <div 
                                    class="flex-1 space-y-2" 
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
                                        required
                                    >
                                </div>
                                <div 
                                    class="flex-1 space-y-2"
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
                                        required
                                    >
                                </div>
                            </div>
                            @if (!empty($file_path))                                
                                <div class="flex flex-col space-y-2">
                                    <label class="font-medium text-slate-700">Current Image</label>
                                    <img class="object-contain w-full h-56"
                                            src="{{ asset($file_path) }}?v={{ md5_file(public_path($file_path)) }}"
                                            alt="Image">
                                </div>
                            @endif
                            <div class="flex flex-col space-y-2">
                                <label class="font-medium text-slate-700">Replace New Photo</label>
                                <input class="text-md w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="file" wire:model="photo" id="upload-{{ $inc }}">
                            </div>
                            @error('image_constraint')                                
                                <div class="flex flex-col space-y-2">
                                    <label class="mb-2 text-sm text-red-600">
                                        Note: {{ $message }}
                                    </label>
                                </div>
                            @enderror
                            {{-- Loading Animation --}}
                            <div class="w-full text-center" wire:loading>
                                <div class="flex items-center justify-center gap-2">
                                    <svg class="animate-spin h-5 w-5 text-[#1F4B55]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 2.042.777 3.908 2.05 5.334l1.95-2.043z"></path>
                                    </svg>
                                    <span class="font-medium text-md text-slate-600">Saving post...</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-8">
                            <button class="px-4 py-2 rounded-lg shadow text-slate-600 hover:opacity-70" type="button"
                                @click="edit_advertisement=false; $wire.call('resetData', ['photo'])">
                                Cancel
                            </button>
                            <button class="text-white bg-[#1F4B55] shadow py-2 px-4 rounded-lg hover:opacity-70" type="submit">Save</button>
                        </div>
                    </form>
                </div>
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
        
        function computedPlanDate() {
            const duration = parseInt($('#advertising-plan-{{ $uuid }}').val(), 10);
            const fromDate = $('#from-date-{{ $uuid }}').val();

            if (fromDate === '' || isNaN(duration)) return;

            const fromDateISO = new Date(fromDate);
            
            // Calculate the new date by adding the duration
            const toDateISO = new Date(fromDateISO);
            toDateISO.setDate(toDateISO.getDate() + duration);

            // Format the to_date as DD-MM-YYYY for display
            const toDateFormatted = `${String(toDateISO.getMonth() + 1).padStart(2, '0')}/${String(toDateISO.getDate()).padStart(2, '0')}/${toDateISO.getFullYear()}`;

            // Update the component and the display
            component.from_date = fromDateISO.toISOString();
            component.to_date = toDateISO.toISOString();
            
            $('#to-date-{{ $uuid }}').val(toDateFormatted);
        }
    });
</script>
@endscript