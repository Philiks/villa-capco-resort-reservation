@props(['start_time', 'end_time'])

@php
    $schedule = date('h:i A', strtotime($start_time)) . ' - ' . date('h:i A', strtotime($end_time));
@endphp

<div {{ $attributes->merge(['class' => 'inline-block font-semibold text-sm rounded-lg mr-1 mt-3 px-2 py-1 text-white bg-secondary-bg']) }}>
    {{ $schedule ?? $slot }}
</div>
