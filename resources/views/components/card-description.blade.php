@props(['value'])

<p {{ $attributes->merge(['class' => 'mt-2 text-md font-semibold text-justify']) }}>
    {!! $value ?? $slot !!}
</p>
