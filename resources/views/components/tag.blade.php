@props(['value'])

<div {{ $attributes->merge(['class' => 'inline-block font-semibold text-sm rounded-lg mr-1 mt-3 px-2 py-1 text-white']) }}>
    {{ $value ?? $slot }}
</div>
