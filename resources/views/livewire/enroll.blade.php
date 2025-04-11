<?php

use Livewire\Volt\Component;
use App\Models\Father;
use App\Models\Student;
use App\Models\Course;
use App\Models\Tuition;
use App\Models\Payment;

new class extends Component {
    public object $course;
    public string $studentName = '';
    public string $studentLastName = '';
    public string $studentBirthDate;
    public ?int $selectedFather = null;
    public object $fathers;
    public ?string $paymentMethod = null;

    public function mount($courseId): void
    {
        $this->course = Course::with('school')->findOrFail($courseId);
        $this->fathers = Father::all();
    }

    public function save(): void
    {
        $validated = $this->validate([
            'selectedFather' => 'required',
            'studentName' => 'required',
            'studentLastName' => 'required',
            'studentBirthDate' => 'required',
            'paymentMethod' => 'required',
        ]);

        $student = Student::create([
            'name' => $validated['studentName'],
            'last_name' => $validated['studentLastName'],
            'birth_date' => $validated['studentBirthDate'],
            'father_id' => $validated['selectedFather'],
        ]);

        $tuition = Tuition::create([
            'student_id' => $student->id,
            'course_id' => $this->course->id,
        ]);

        Payment::create([
            'tuition_id' => $tuition->id,
            'type' => $validated['paymentMethod'],
            'amount' => $this->course->amount,
            'date' => now(),
        ]);

        session()->flash('success', 'Enrollment completed successfully!');
        $this->reset(['selectedFather', 'studentName', 'studentLastName', 'studentBirthDate', 'paymentMethod']);
    }
}; ?>


<div>
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center mb-8">
            Enrollment Process in School {{ $course->school->name }} and Course {{ $course->name }}
        </h1>

        @if (session('success'))
            <x-alert type="success" message="{{ session('success') }}"/>
        @endif

        <x-form wireSubmit="save" formClass="">

            <div class="mb-4">
                <x-select label="Fathers" id="Father" model="selectedFather" :options="$fathers" class=""/>

                @error('selectedFather')
                    <x-alert type="error" message="{{ $message }}"/>
                @enderror
            </div>

            <div class="mb-4">
                <x-input label="Student Name" id="StudentName" model="studentName"/>

                @error('studentName')
                    <x-alert type="error" message="{{ $message }}"/>
                @enderror
            </div>

            <div class="mb-4">
                <x-input label="Student LastName" id="StudentLastName" model="studentLastName"/>

                @error('studentLastName')
                    <x-alert type="error" message="{{ $message }}"/>
                @enderror
            </div>

            <div class="mb-4">
                <x-input label="Student Birth Date" id="StudentBirthDate" type="date" model="studentBirthDate"/>

                @error('studentBirthDate')
                    <x-alert type="error" message="{{ $message }}"/>
                @enderror
            </div>

            <div class="mb-4">
                <label for="paymentMethod" class="block text-gray-700 text-sm font-bold mb-2">Payment Method:</label>
                <select wire:model="paymentMethod" id="paymentMethod"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">-- Select Payment Method --</option>
                    <option value="cash">Cash</option>
                    <option value="bank_transfer">Bank Transfer</option>
                </select>
            </div>

            <div class="flex items-center justify-between">
                <x-button type="submit" variant="primary" text="Confirm" class=""/>
            </div>
        </x-form>
    </div>
</div>
