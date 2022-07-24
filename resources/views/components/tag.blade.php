@props(['value'])

<div {{ $attributes->merge(['class' => 'inline-block font-semibold text-sm rounded-lg mr-1 mt-3 px-1 py-0.5 text-white']) }}>
    {{ $value ?? $slot }}
</div>
