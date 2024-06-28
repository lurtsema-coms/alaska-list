@props(['value'])

<label {{ $attributes->merge(['class' => 'block  text-sm ']) }}>
    {{ $value ?? $slot }}
</label>
