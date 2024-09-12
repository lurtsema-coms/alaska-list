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
        $this->validate();
        
        $search = $this->search;
        $category_id = $this->search_category_id;
        $location = $this->search_location;

        $this->redirect("/listing-page?category_id=$category_id&location=$location&search=$search", navigate: true);
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

<div>
    <form wire:submit="submitSearch">        
        <div class="max-w-5xl mx-auto bg-white shadow-lg h-14">
            <div class="flex items-center h-full">
                <div class="flex flex-col flex-1 md:flex-row">
                    <select class="md:max-w-56 text-md w-full px-4 border-none focus:outline-none focus:ring-0 focus:border-[#1F4B55]" name="" id="" required wire:model="search_category_id">
                        <option value="" disabled selected>Category...</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <div class="w-[1px] h-10 bg-gray-200 md:block hidden"></div>
                    <input class="flex-1 border-none focus:outline-none focus:ring-0" placeholder="Search for ..." type="text" wire:model="search" required>
                    <div class="w-[1px] h-10 bg-gray-200 md:block hidden"></div>
                    <select class="flex-1 text-md w-full px-4 md:shadow-none shadow-lg border-none focus:outline-none focus:ring-0 focus:border-[#1F4B55]" name="" id="" required wire:model="search_location">
                        <option value="" disabled selected>Location...</option>
                        @foreach ($locations as $location)
                            <option value="{{ $location }}" wire:key="home-{{ $location }}">{{ $location }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="max-w-40 text-lg font-bold w-full text-white h-full bg-[#2171a7] hover:bg-[#1a5b8a] hidden lg:block">Search</button>
            </div>
            <button class="mt-12 md:mt-8 max-w-40 text-lg font-bold w-full text-white py-2 bg-[#2171a7] hover:bg-[#1a5b8a] block lg:hidden">Search</button>
        </div>
    </form>
</div>
