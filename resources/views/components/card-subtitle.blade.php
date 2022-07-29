@props(['value'])

<h2 {{ $attributes->merge(['class' => 'font-bold text-xl text-primary-fg']) }}>
    {{ $value ?? $slot }}
</h2>
