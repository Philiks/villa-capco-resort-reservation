@props(['value', 'is_multiple_price' => false])

@php
    $price = number_format(App\Facades\Format::moneyForDisplay($value), 2);
@endphp

<div {{ $attributes->merge(['class' => ($is_multiple_price ? 'inline' : 'block') . ' italic font-semibold text-md w-fit rounded-lg my-2 px-2 py-0.5 text-white bg-gray-500']) }}>
    &#8369 {{ $price }}
</div>
