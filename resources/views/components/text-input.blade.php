@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-[#1F4B55] focus:ring-[#1F4B55] rounded-md shadow-sm']) !!}>
