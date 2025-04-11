@props(['type' => 'button', 'variant' => 'primary', 'text' => ''])

@php
    $baseClass = 'font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline cursor-pointer';
    $variantClass = $variant === 'primary' ? 'bg-blue-500 hover:bg-blue-700 text-white' : 'bg-gray-500 hover:bg-gray-700 text-white';
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->merge(['class' => "$baseClass $variantClass"]) }}
>
    {{ $text }}
</button>
