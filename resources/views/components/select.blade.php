@props(['label' => '', 'id' => '', 'model' => '', 'options' => []])

<div class="mb-4">
    @if($label)
        <label for="{{ $id }}" class="block text-gray-700 text-sm font-bold mb-2">{{ $label }}</label>
    @endif
    <select
        id="{{ $id }}"
        wire:model="{{ $model }}"
        {{ $attributes->merge(['class' => 'shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline']) }}
    >
        <option value="">-- Select an option --</option>
        @foreach($options as $value)
            <option value="{{ $value->id }}">{{ $value->name }}</option>
        @endforeach
    </select>
</div>
