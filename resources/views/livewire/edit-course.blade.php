<?php

use Livewire\Volt\Component;
use App\Models\Course;

new class extends Component {
    public object $courses;
    public string $name;
    public string $description;
    public string $amount;
    public string $duration;
    public ?int $selectedCourse = null;

    public function mount(): void
    {
        $this->courses = Course::all();
    }

    public function save(): void
    {
        $validated = $this->validate([
            'selectedCourse' => 'required',
            'name' => 'required|string',
            'description' => 'required|string',
            'amount' => 'required|numeric|gt:0',
            'duration' => 'required',
        ]);

        $course = Course::findOrFail($validated['selectedCourse']);

        $course->update($validated);

        session()->flash('success', 'Course modified successfully!');
        $this->courses = Course::all();
        $this->reset(['name', 'description', 'amount', 'duration']);
    }
}; ?>


<div>
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center mb-8">
            Edit Courses
        </h1>

        @if (session('success'))
            <x-alert type="success" message="{{ session('success') }}"/>
        @endif

        <x-form wireSubmit="save" formClass="">
            <div class="mb-4">
                <x-select label="Courses" id="Courses" model="selectedCourse" :options="$courses" class="" />

                @error('courseId')
                    <x-alert type="error" message="{{ $message }}" />
                @enderror
            </div>

            <div class="mb-4">
                <x-input label="Name" id="name" model="name"/>

                @error('name')
                    <x-alert type="error" message="{{ $message }}"/>
                @enderror
            </div>

            <div class="mb-4">
                <x-input label="Description" id="Description" model="description"/>

                @error('description')
                    <x-alert type="error" message="{{ $message }}"/>
                @enderror
            </div>

            <div class="mb-4">
                <x-input label="Amount" id="Amount" type="number" model="amount"/>

                @error('amount')
                    <x-alert type="error" message="{{ $message }}"/>
                @enderror
            </div>

            <div class="mb-4">
                <x-input label="Duration" id="Duration" type="time" model="duration"/>

                @error('duration')
                    <x-alert type="error" message="{{ $message }}"/>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <x-button type="submit" variant="primary" text="Confirm" class=""/>
            </div>
        </x-form>
    </div>
</div>
