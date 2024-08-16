<?php

use Livewire\Volt\Component;
use App\Models\ProductIssue;
use Livewire\Attributes\Validate;

new class extends Component {
    public $product;
    #[Validate('required')]
    public $title = '';
    #[Validate('required')]
    public $description = '';
    #[Validate('email')]
    public $email = '';
    public $fullscreenModal = false;
    public $successModalOpen = false;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function productIssueSubmit()
    {
        $this->validate();

        $email = $this->email === '' ? null : $this->email;
        
        ProductIssue::create([
            'product_id' => $this->product->id,
            'title' => $this->title,
            'description' => $this->description,
            'email' => $email
        ]);

        $this->reset(['title', 'description', 'email']);

        $this->fullscreenModal = false;
        $this->successModalOpen = true;
    }
}; ?>

<div 
    x-data="{ fullscreenModal: $wire.entangle('fullscreenModal') }"
    x-init="
    $watch('fullscreenModal', function(value){
            if(value === true){
                document.body.classList.add('overflow-hidden');
            }else{
                document.body.classList.remove('overflow-hidden');
            }
        })
    "
    @keydown.escape="fullscreenModal=false"
    >
    <x-modal-success :message="'The problem has been reported successfully. We will look into it and get back to you shortly.'"/>
    <button @click="fullscreenModal=true;" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">Report</button>
    <template x-teleport="body">
        <div 
            x-show="fullscreenModal"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="flex fixed inset-0 z-[99] w-screen h-screen overflow-auto bg-white"
            >
            <button @click="fullscreenModal=false" class="absolute top-0 right-0 z-30 flex items-center justify-center px-3 py-2 mt-3 mr-8 space-x-1 text-xs font-medium uppercase border rounded-md border-neutral-200 text-neutral-600 hover:bg-neutral-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                <span>Close</span>
            </button>
            <div class="relative top-0 bottom-0 right-0 flex-shrink-0 hidden w-1/3 overflow-hidden bg-cover lg:block">
                <a href="#_" class="absolute bottom-0 left-0 z-30 inline-flex items-end mb-4 ml-3 font-sans text-2xl font-extrabold text-left text-white no-underline bg-transparent cursor-pointer group focus:no-underline">
                    <img class="max-w-24" src="{{ asset('img/logo/logo-white.png') }}" alt="">
                </a>
                <div class="absolute inset-0 z-20 w-full h-full opacity-70 bg-gradient-to-t from-black"></div>
                <img src="https://cdn.devdojo.com/images/may2023/pines-bg-1.png" class="z-10 object-cover w-full min-h-full" />
            </div>
            <div class="relative flex flex-wrap items-center w-full h-full px-8">
                    
                <div class="relative w-full max-w-sm mx-auto lg:mb-0">
                    <div class="relative text-center">
                        
                        <div class="flex flex-col mb-6 space-y-2">
                            <h1 class="text-2xl font-semibold tracking-tight">Report a Problem</h1>
                            <p class="text-sm text-neutral-500">Please describe the issue you're experiencing.</p>
                        </div>
                        <div class="flex flex-col mb-4 space-y-2">
                            <p class="text-sm text-left text-gray-500"><span class="text-black">Item Name:</span> {{ $product->name }}</p>
                            <p class="text-sm text-left text-gray-500"><span class="text-black">Product ID:</span> {{ $product->uuid }}</p>
                        </div>
                        <form wire:submit="productIssueSubmit" class="space-y-4">
                            <input type="text" class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Title" required wire:model="title">
                            @error('title') <p class="text-sm text-left text-red-400">{{ $message }}</p> @enderror
                            <textarea placeholder="Describe the problem..." class="flex w-full h-32 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" wire:model="description"></textarea>
                            @error('description') <p class="text-sm text-left text-red-400">{{ $message }}</p> @enderror
                            <input type="email" placeholder="Your email (optional)" class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" wire:model="email">
                            @error('email') <p class="text-sm text-left text-red-400">{{ $message }}</p> @enderror
                            <button 
                                type="submit" 
                                class="relative inline-flex items-center justify-center w-full h-10 px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none"
                                wire:loading.attr="disabled"
                            >
                                <span wire:loading>
                                    Loading...
                                </span>
                                <!-- Button Text -->
                                <span wire:loading.remove>
                                    Submit Report
                                </span>
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        

    </template>
</div>
