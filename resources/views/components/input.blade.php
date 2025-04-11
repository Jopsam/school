@props(['type' => 'text', 'label' => '', 'id' => '', 'placeholder' => '', 'model' => ''])

<div class="mb-4">
    @if($label)
        <label for="{{ $id }}" class="block text-gray-700 text-sm font-bold mb-2">{{ $label }}</label>
    @endif
    <input
        type="{{ $type }}"
        id="{{ $id }}"
        wire:model="{{ $model }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline']) }}
    />
</div>
