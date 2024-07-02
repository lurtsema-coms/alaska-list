@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-[#246567] focus:ring-[#246567] rounded-md shadow-sm']) !!}>
