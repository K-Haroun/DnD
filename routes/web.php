<?php

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

Route::get('test', function () {
    return [
        UserResource::make(User::find(1)),
        StoryResource::make(Story::find(1)),
        CharacterResource::make(Character::find(1)),
        NPCResource::make(NPC::find(1)),
        ItemResource::make(Item::find(1)),
        SpellResource::make(Spell::find(1))
    ];
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
