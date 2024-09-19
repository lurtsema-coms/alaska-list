<?php

use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new class extends Component {

    #[Validate('required')]
    public $search = "";
    #[Validate('required')]
    public $search_category_id = "";
    #[Validate('required')]
    public $search_location = "";
    
    public function with(): array
    {
        return [
            'categories' => $this->loadCategories(),
            'locations' => $this->loadLocations(),
        ];
    }

    public function submitSearch()
    {
        $search = $this->search;
        $location = $this->search_location;

        $this->redirect("/listing-page?location=$location&search=$search", navigate: true);
    }

    public function loadCategories()
    {
        return Category::with('subCategories')
            ->get();
    }
    
    public function loadLocations()
    {
        return config('global.us_states');
    }
}; ?>

<div class="flex flex-row justify-center align-center">
    <form wire:submit="submitSearch" class="container flex flex-col justify-center max-w-screen-lg align-center md:mb-5 border border-[#2171a7] rounded-2xl" autocomplete="off">        
        <div class="flex flex-col justify-center md:flex-row align-center">
            <input name="search" class="py-3 pl-6 text-lg text-[#2171a7] border-none rounded-t-2xl md:rounded-tr-none md:rounded-l-2xl grow focus:outline-none focus:ring-0" type="text" placeholder="Looking for something specific?" wire:model="search">
            <select name="location" class="py-3 lg:min-w-[300px] text-[#2171a7] text-lg font-semibold  border-none focus:outline-none focus:ring-0 focus:border-[#1F4B55] " name="" id="" wire:model="search_location">
                <option value="" selected>All Location</option>
                @foreach ($locations as $location)
                    <option value="{{ $location }}" wire:key="home-{{ $location }}">{{ $location }}</option>
                @endforeach
            </select>
            <div class="flex items-center content-center px-3 py-3 bg-white search-btn-wrapper rounded-b-2xl md:rounded-bl-none md:rounded-r-2xl">
                <button class="flex flex-row justify-center flex-grow gap-2 px-5 py-2 text-lg text-white rounded-full hover:opacity-75 align-center bg-gradient-to-r from-[#143E7A] to-[#4988A5] hover:bg-[#1a5b8a]" type="submit"><p>Search</p> <span class="material-symbols-outlined">search</span></button>
            </div>
        </div>
    </form>
</div>
