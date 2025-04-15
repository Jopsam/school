<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Father;
use App\Models\Release;
use App\Notifications\FatherReleases;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Notification;

class ReleaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Collection
    {
        return Release::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'message' => 'required|string',
            'student_age' => 'required|numeric|integer',
            'course_id' => 'required|numeric|exists:courses,id',
        ]);

        $emailsByCourse = Father::getEmailsByCourse($validated['course_id']);

        $emailsByAge = Father::getEmailsByAge($validated['student_age']);

        $allEmails = array_unique(array_merge($emailsByCourse, $emailsByAge));

        Notification::route('mail', 'school@test.com')
            ->notify(new FatherReleases($validated['title'], $validated['message'], $allEmails));

        $realese = Release::create([
            'title' => $validated['title'],
            'message' => $validated['message'],
            'date_send' => now(),
        ]);

        return response()->json($realese, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Release::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $release = Release::findOrFail($id);

        $emailsByCourse = Father::getEmailsByCourse($request->input('course_id'));

        $emailsByAge = Father::getEmailsByAge($request->input('student_age'));

        $allEmails = array_unique(array_merge($emailsByCourse, $emailsByAge));

        Notification::route('mail', 'school@test.com')
            ->notify(new FatherReleases($request->input('title'), $request->input('message'), $allEmails));

        $release->update($request->all());

        return response()->json($release);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        Release::destroy($id);

        return response()->json(['message' => 'Release deleted successfully'], Response::HTTP_NO_CONTENT);
    }
}
