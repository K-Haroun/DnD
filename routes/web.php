<?php

use App\Http\Controllers\StoryController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Stories
Route::get('/stories', [StoryController::class, 'index'])->name('stories.index');
Route::get('/stories/create', [StoryController::class, 'create'])->name('stories.create');
Route::get('/stories/{story}', [StoryController::class, 'show'])->name('stories.show');
Route::post('/stories', [StoryController::class, 'store'])->name('stories.store');
Route::patch('/stories/{story}', [StoryController::class, 'update'])->name('stories.update');
Route::delete('/stories/{story}', [StoryController::class, 'destroy'])->name('stories.delete');
Route::post('/stories/join', [StoryController::class, 'joinWithCode'])->name('stories.joinWithCode')->middleware('auth');

// Notes
Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
Route::patch('/notes/{note}', [NoteController::class, 'update'])->name('notes.update');
Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.delete');

// Characters
Route::get('/characters', [CharacterController::class, 'index'])->name('characters.index');
Route::post('/characters', [CharacterController::class, 'store'])->name('characters.store');
Route::patch('/characters/{character}', [CharacterController::class, 'update'])->name('characters.update');


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
