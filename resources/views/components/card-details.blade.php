@props(['value'])

@php
    $details = explode(',', $value);
@endphp

<ul {{ $attributes->merge(['class' => 'mt-2 text-md text-justify']) }}>
    @foreach ($details as $detail)
        <li><x-tag class="bg-secondary-bg" :value="$detail" /></li>
    @endforeach
</ul>
