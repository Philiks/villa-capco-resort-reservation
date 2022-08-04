@props(['value'])

@php
    $price = number_format(App\Facades\Format::moneyForDisplay($value), 2);
@endphp

<div {{ $attributes->merge(['class' => 'block font-semibold text-md w-fit rounded-lg my-2 px-2 py-0.5 text-white bg-secondary-bg']) }}>
    &#8369 {{ $price }}
</div>
