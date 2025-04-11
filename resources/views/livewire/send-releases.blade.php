<?php

use Livewire\Volt\Component;
use App\Notifications\FatherReleases;
use App\Models\Release;
use App\Models\Course;
use App\Models\Father;
use Illuminate\Support\Facades\Notification;

new class extends Component {
    public string $title = '';
    public string $message = '';
    public ?int $selectedCourse = null;
    public ?int $selectedAge = null;
    public object $courses;

    public function mount(): void
    {
        $this->courses = Course::all();
    }

    public function send(): void
    {
        $validated = $this->validate([
            'title' => 'required',
            'message' => 'required',
            'selectedCourse' => 'required',
            'selectedAge' => 'required',
        ]);

        $emailsByCourse = Father::getEmailsByCourse($validated['selectedCourse']);

        $emailsByAge = Father::getEmailsByAge($validated['selectedAge']);


        $allEmails = array_unique(array_merge($emailsByCourse, $emailsByAge));

        Notification::route('mail', 'mendozajeyker1178@gmail.com')
            ->notify(new FatherReleases($validated['title'], $validated['message'], $allEmails));

        Release::create([
            'title' => $validated['title'],
            'message' => $validated['message'],
            'date_send' => now(),
        ]);

        session()->flash('success', 'Communication sent successfully!');
    }
}; ?>

<div>
    @if (session('success'))
        <x-alert type="success" message="{{ session('success') }}" />
    @endif

    <x-form wireSubmit="send" formClass="">
        <div class="mb-4">
            <x-input label="Title" id="Title" model="title"/>

            @error('title')
                <x-alert type="error" message="{{ $message }}"/>
            @enderror
        </div>

        <div class="mb-4">
            <x-input label="Message" id="Message" model="message"/>

            @error('message')
                <x-alert type="error" message="{{ $message }}"/>
            @enderror
        </div>

        <div class="mb-4">
            <x-select label="Courses" id="Courses" model="selectedCourse" :options="$courses" class="" />

            @error('selectedCourse')
                <x-alert type="error" message="{{ $message }}" />
            @enderror
        </div>

        <div class="mb-4">
            <x-input label="Student Age" id="Student Age" model="selectedAge"/>

            @error('selectedAge')
                <x-alert type="error" message="{{ $message }}"/>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Send Release
            </button>
        </div>
    </x-form>
</div>
