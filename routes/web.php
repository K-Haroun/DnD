<?php

use App\Http\Controllers\StoryController;
use App\Http\Resources\CharacterResource;
use App\Http\Resources\ItemResource;
use App\Http\Resources\NPCResource;
use App\Http\Resources\SpellResource;
use App\Http\Resources\StoryResource;
use App\Http\Resources\UserResource;
use App\Models\Character;
use App\Models\Item;
use App\Models\NPC;
use App\Models\Spell;
use App\Models\Story;
use App\Models\User;
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
Route::post('/stories/store', [StoryController::class, 'store'])->name('stories.store');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
