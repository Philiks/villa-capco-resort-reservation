@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-sm text-secondary-fg']) }}>
    {{ $value ?? $slot }}
</label>
