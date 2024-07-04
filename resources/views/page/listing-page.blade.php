@extends('frontend-layout')

@section('body-content')
<div class="py-14 px-5">
    <div class="container mx-auto space-y-8 sm:px-5" data-aos="zoom-in-up">
        <div>
            <h2 class=" text-4xl text-gray-800">Listing Page</h2>
        </div>
        <livewire:frontend.sponsored-listing>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 2xl:grid-cols-4 gap-4">
            <!-- Replace with your product cards or items -->
            <div class=" ">
                <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg">
                    <p>Product 1</p>
                    <p>Product 1</p>
                </div>
            </div>
            <div class="">
                <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg">
                    <p>Product 1</p>
                </div>            
            </div>
            <div class="">
                <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg">
                    <p>Product 1</p>
                </div>            
            </div>
            <div class="">
                <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg">
                    <p>Product 1</p>
                </div>            
            </div>
            <div class="">
                <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg">
                    <p>Product 1</p>
                </div>            
            </div>
            <div class="">
                <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg">
                    <p>Product 1</p>
                </div>            
            </div>
            <div class="">
                <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg">
                    <p>Product 1</p>
                </div>            
            </div>
            <div class="">
                <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg">
                    <p>Product 1</p>
                </div>            
            </div>
            <div class="">
                <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg">
                    <p>Product 1</p>
                </div>            
            </div>
            <div class="">
                <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg">
                    <p>Product 1</p>
                </div>            
            </div>
            <div class="">
                <div class="bg-gray-50 border border-gray-100 p-4 shadow-md rounded-lg">
                    <p>Product 1</p>
                </div>            
            </div>

            <!-- Add more product cards as needed -->
        </div>
    </div>
</div>
@endsection