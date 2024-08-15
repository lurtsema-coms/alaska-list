@extends('frontend-layout')

@section('body-content')
    <div class="relative w-full pt-14 pb-28" data-aos="fade-in">
        <div class="absolute top-0 w-full -z-10 h-[20rem]">
            <div class="absolute w-full h-full bg-search-gradient">
            </div>
        </div>
        <div class="container px-5 mx-auto sm:px-5">
            <livewire:frontend.listing-page-section />
        </div>
    </div>
@endsection