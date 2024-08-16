<?php

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new class extends Component {

    public $reportOpenModal = false;
    public $productIssue;

    public function mount($productIssue)
    {
        $this->productIssue;
    }

}; ?>

<div 
    x-data="{ reportOpenModal: $wire.entangle('reportOpenModal') }" x-init="$watch('reportOpenModal', value => {
        if (value) {
            document.body.classList.add('overflow-hidden');
        } else {
            document.body.classList.remove('overflow-hidden');
        }
    })">
    <button class="px-4 py-2 text-sm text-white bg-yellow-400 rounded-lg shadow-md hover:bg-yellow-500"
    @click="reportOpenModal=true">
        REPORTS
    </button>
    
    <div class="fixed top-0 left-0 z-10 w-full h-full overflow-auto bg-black position bg-opacity-30"
        x-show="reportOpenModal"
        x-transition
        x-cloak>
        <div class="flex h-full p-5">
            <div class="w-full max-w-6xl m-auto overflow-hidden bg-white shadow-lg rounded-2xl"
            @click.outside="reportOpenModal=false;">
                <div class="p-10 max-h-[42rem] overflow-auto">
                    <div class="max-w-4xl m-auto space-y-4">
                        <p class="mb-6 text-lg font-bold tracking-wide pointer-events-none text-slate-700">Reports</p>
                        @php
                            use Carbon\Carbon;
                        @endphp
                        @if (count($productIssue) === 0)
                            <div class="flex items-center justify-center p-4 text-sm text-center rounded-md text-neutral-500 bg-neutral-100">
                                <span>✨ No Reported Issues ✨</span>
                            </div>
                        @else
                            <div class="space-y-6">
                                @foreach ($productIssue as $issue)
                                    <div class="p-4 bg-white border rounded-lg shadow-md">
                                        <h3 class="font-bold text-neutral-700">Title: {{ $issue->title }}</h3>
                                        <p class="mt-2 text-sm text-neutral-600">Description: {{ $issue->description }}</p>
                                        @if ($issue->email)
                                            <p class="mt-2 text-sm text-neutral-600">Email: {{ $issue->email }}</p>
                                        @endif
                                        <p class="mt-2 text-sm text-neutral-600">
                                            Created at: {{ Carbon::parse($issue->created_at)->format('F j, Y g:i A') }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <div class="!mt-8 text-right space-x-2">
                            <button class="px-4 py-2 rounded-lg shadow text-slate-600 hover:opacity-70" type="button" @click="reportOpenModal=false">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
