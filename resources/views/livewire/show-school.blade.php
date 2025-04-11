<?php

use Livewire\Volt\Component;
use App\Models\School;

new class extends Component {
    public object $schools;

    public function mount(): void
    {
        $this->schools = School::with('courses')->get();
    }

    public function deletedSchool(int $id)
    {

    }
}; ?>

<div>
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center mb-8 text-gray-800 dark:text-white">Schools</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($schools as $school)
                <div class="bg-white dark:bg-zinc-700 shadow-md hover:shadow-lg rounded-lg p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">{{ $school->name }}</h2>
                    <p class="text-gray-600 dark:text-gray-300">{{ $school->description }}</p>
                    <h3 class="text-xl font-bold mt-4 text-gray-800 dark:text-white">Courses:</h3>
                    <ul class="mt-2 space-y-2">
                        @foreach ($school->courses as $course)
                            <a href="{{ route('enroll-student', $course->id) }}">
                                <li class="bg-gray-100 dark:bg-zinc-600 p-3 rounded">
                                    <h4 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $course->name }}</h4>
                                    <p class="text-gray-600 dark:text-gray-300">{{ $course->description }}</p>
                                    <p class="text-gray-800 dark:text-white font-bold">Cost: ${{ $course->amount }}</p>
                                    <p class="text-gray-600 dark:text-gray-300">Duration: {{ \Carbon\Carbon::createFromFormat('H:i:s', $course->duration)->format('H:i') }} hours</p>
                                </li>
                            </a>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</div>
