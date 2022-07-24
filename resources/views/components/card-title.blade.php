@props(['value'])

<h2 {{ $attributes->merge(['class' => 'font-bold text-2xl text-gray-500']) }}>
    {{ $value ?? $slot }}
</h2>
