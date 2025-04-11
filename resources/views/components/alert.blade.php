@props(['type', 'message'])

@php
    $bgColor = $type === 'success' ? 'bg-green-500' : 'bg-red-500';
    $textColor = 'text-white';
@endphp

<div class="{{ $bgColor }} {{ $textColor }} p-4 rounded-md">
    <p>{{ $message }}</p>
</div>
