@props(['wireSubmit' =>'', 'formClass' => ''])

<form wire:submit.prevent="{{ $wireSubmit }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-5/12 mx-auto {{ $formClass }}">
    {{ $slot }}
</form>
