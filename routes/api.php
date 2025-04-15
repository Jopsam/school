<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\ReleaseController;
use App\Http\Controllers\Api\TuitionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::apiResource('courses', CourseController::class)->middleware('auth:api');
Route::apiResource('tuitions', TuitionController::class)->middleware('auth:api');
Route::apiResource('releases', ReleaseController::class)->middleware('auth:api');
