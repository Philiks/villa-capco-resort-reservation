@props(['value'])

<h2 {{ $attributes->merge(['class' => 'font-bold text-2xl text-primary-fg']) }}>
    {{ $value ?? $slot }}
</h2>
