<?php

use Livewire\Volt\Component;

new class extends Component {
    public $sub_categories = [];
    public $sc_title = '';

    function saveCategory(){
        return $this->redirect('/admin-categories', navigate: true);
    }

    function addSubCategory(){
        if(!$this->sc_title) return;

        $this->sub_categories[] = $this->sc_title;
        $this->resetData(['sc_title']);
    }

    function deleteSubCategory($index){
        unset($this->sub_categories[$index]);
        $this->sub_categories = array_values($this->sub_categories);
    }

    function resetData($data) {
        $this->reset($data);
    }
}; ?>

<div 
    x-data="{ addCategory: false }" x-init="$watch('addCategory', value => {
        if (value) {
            document.body.classList.add('overflow-hidden');
        } else {
            document.body.classList.remove('overflow-hidden');
        }
    })">
    <button class="bg-blue-400 text-sm text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-500"
    @click="addCategory=true">
        New Category
    </button>
    <div class="position fixed h-full w-full top-0 left-0 bg-black bg-opacity-30 z-10 overflow-auto"
        x-show="addCategory"
        x-transition
        x-cloak>
        <div class="h-full flex p-5">
            <div class="bg-white w-full max-w-xl m-auto rounded-2xl shadow-lg overflow-hidden"
            @click.outside="addCategory=false; $wire.call('resetData', ['sc_title', 'sub_categories'])">
                <div class="p-10 max-h-[35rem] overflow-auto">
                    <form wire:submit="saveCategory">
                        <p class="font-bold text-lg text-slate-700 tracking-wide mb-6">Create Category</p>
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <p class="font-medium text-slate-700">Name</p>
                                <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" required>
                            </div>
                            <div class="space-y-2">
                                <p class="font-medium text-slate-700">Add Sub Category</p>
                                <input
                                    class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]"
                                    type="text"
                                    wire:model="sc_title"
                                    wire:keydown.enter.prevent="addSubCategory"
                                >
                            </div>
                            <button type="button" wire:click="addSubCategory">
                                <div class="inline-block rounded-full p-2 border border-orange-400 hover:bg-orange-400 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                </div>
                            </button>
                            <div>
                                <p class="text-gray-600 mb-2">Sub Categories Added</p>
                                <ol class="grid grid-cols-1 sm:grid-cols-2 gap-2 list-disc list-inside">
                                    @foreach ($sub_categories as $index => $sub_category)
                                        <li class="text-gray-800 break-words">
                                            <span>{{ $sub_category }}</span>
                                            <button type="button" wire:key="{{ $index }}" wire:click="deleteSubCategory({{ $index }})">
                                                <div class="relative left-1 top-0.5 inline-block rounded-full p-0.5 border border-red-400 hover:bg-red-400 cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                                    </svg>
                                                </div>
                                            </button>
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-8">
                            <button class="text-slate-600 shadow py-2 px-4 rounded-lg hover:opacity-70" type="button"
                                    @click="addCategory = false; $wire.call('resetData', ['sc_title', 'sub_categories'])">
                                Cancel
                            </button>
                            <button class="text-white bg-[#1F4B55] py-2 px-4 rounded-lg hover:opacity-70" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
