@extends('frontend-layout')

@section('body-content')
<div class="mt-14 mb-28 px-5">
    <div class="container mx-auto space-y-8 sm:px-5" data-aos="zoom-in-up">
        <div>
            <h2 class=" text-4xl text-gray-800">Listing Page</h2>
        </div>
        <div class="space-y-10">
            <livewire:frontend.sponsored-listing>
            <div class="max-h-80 p-4 bg-white w-full mx-auto shadow-md rounded-xl space-y-4 overflow-y-auto">
                <p class="text-xl font-semibold text-gray-800 mb-4">Categories</p>
                <div class="flex flex-wrap -mx-2">
                    <!-- First column -->
                    <div class="flex-grow basis-1/3 min-w-fit px-2 mb-4">
                        <p class="text-lg font-medium text-gray-700 mb-2">Lorem</p>
                        <div class="flex flex-wrap gap-4">
                            <div class="flex-1 space-y-3">
                                <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-100 rounded-lg p-2 transition-all">
                                    <input type="radio" name="group1" value="option1" class="form-radio text-blue-600 h-5 w-5">
                                    <span class="text-gray-600">1 Lorem ipsum dolor sit amet.</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-100 rounded-lg p-2 transition-all">
                                    <input type="radio" name="group1" value="option2" class="form-radio text-blue-600 h-5 w-5">
                                    <span class="text-gray-600">2</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-100 rounded-lg p-2 transition-all">
                                    <input type="radio" name="group1" value="option3" class="form-radio text-blue-600 h-5 w-5">
                                    <span class="text-gray-600">3</span>
                                </label>
                            </div>
                            <div class="flex-1 space-y-3">
                                <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-100 rounded-lg p-2 transition-all">
                                    <input type="radio" name="group2" value="option4" class="form-radio text-blue-600 h-5 w-5">
                                    <span class="text-gray-600">1</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-100 rounded-lg p-2 transition-all">
                                    <input type="radio" name="group2" value="option5" class="form-radio text-blue-600 h-5 w-5">
                                    <span class="text-gray-600">2</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-100 rounded-lg p-2 transition-all">
                                    <input type="radio" name="group2" value="option6" class="form-radio text-blue-600 h-5 w-5">
                                    <span class="text-gray-600">3</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- Second column -->
                    <div class="flex-grow basis-1/3 min-w-fit px-2 mb-4">
                        <p class="text-lg font-medium text-gray-700 mb-2">Lorem</p>
                        <div class="flex flex-wrap gap-4">
                            <div class="flex-1 space-y-3">
                                <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-100 rounded-lg p-2 transition-all">
                                    <input type="radio" name="group3" value="option7" class="form-radio text-blue-600 h-5 w-5">
                                    <span class="text-gray-600">1</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-100 rounded-lg p-2 transition-all">
                                    <input type="radio" name="group3" value="option8" class="form-radio text-blue-600 h-5 w-5">
                                    <span class="text-gray-600">2</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-100 rounded-lg p-2 transition-all">
                                    <input type="radio" name="group3" value="option9" class="form-radio text-blue-600 h-5 w-5">
                                    <span class="text-gray-600">3</span>
                                </label>
                            </div>
                            <div class="flex-1 space-y-3">
                                <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-100 rounded-lg p-2 transition-all">
                                    <input type="radio" name="group4" value="option10" class="form-radio text-blue-600 h-5 w-5">
                                    <span class="text-gray-600">1</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-100 rounded-lg p-2 transition-all">
                                    <input type="radio" name="group4" value="option11" class="form-radio text-blue-600 h-5 w-5">
                                    <span class="text-gray-600">2</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-100 rounded-lg p-2 transition-all">
                                    <input type="radio" name="group4" value="option12" class="form-radio text-blue-600 h-5 w-5">
                                    <span class="text-gray-600">3</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 2xl:grid-cols-4 gap-4">
                <!-- Replace with your product cards or items -->
                <a class="" href="{{ route('listing-page-item') }}" wire:navigate>
                    <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg hover:border-blue-400">
                        <p>Product 1</p>
                        <p>Product 1</p>
                    </div>
                </a>
                <a class="" href="{{ route('listing-page-item') }}" wire:navigate>
                    <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg hover:border-blue-400">
                        <p>Product 1</p>
                    </div>            
                </a>
                <a class="" href="{{ route('listing-page-item') }}" wire:navigate>
                    <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg hover:border-blue-400">
                        <p>Product 1</p>
                    </div>            
                </a>
                <a class="" href="{{ route('listing-page-item') }}" wire:navigate>
                    <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg hover:border-blue-400">
                        <p>Product 1</p>
                    </div>            
                </a>
                <a class="" href="{{ route('listing-page-item') }}" wire:navigate>
                    <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg hover:border-blue-400">
                        <p>Product 1</p>
                    </div>            
                </a>
                <a class="" href="{{ route('listing-page-item') }}" wire:navigate>
                    <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg hover:border-blue-400">
                        <p>Product 1</p>
                    </div>            
                </a>
                <a class="" href="{{ route('listing-page-item') }}" wire:navigate>
                    <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg hover:border-blue-400">
                        <p>Product 1</p>
                    </div>            
                </a>
                <a class="" href="{{ route('listing-page-item') }}" wire:navigate>
                    <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg hover:border-blue-400">
                        <p>Product 1</p>
                    </div>            
                </a>
                <a class="" href="{{ route('listing-page-item') }}" wire:navigate>
                    <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg hover:border-blue-400">
                        <p>Product 1</p>
                    </div>            
                </a>
                <a class="" href="{{ route('listing-page-item') }}" wire:navigate>
                    <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg hover:border-blue-400">
                        <p>Product 1</p>
                    </div>            
                </a>
                <a class="" href="{{ route('listing-page-item') }}" wire:navigate>
                    <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg hover:border-blue-400">
                        <p>Product 1</p>
                    </div>            
                </a>
    
                <!-- Add more product cards as needed -->
            </div>
        </div>
    </div>
</div>
@endsection