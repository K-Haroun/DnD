<?php

namespace App\Http\Controllers;

use App\Http\Resources\StoryResource;
use App\Models\Story;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class StoryController extends Controller
{
    public function index()
    {
        return inertia('Stories/Index', [
            'stories' => StoryResource::collection(Story::latest()->paginate()),
        ]);
    }

    public function show(Story $story)
    {

        $story->load(['users', 'characters.items', 'characters.spells', 'npcs']);

        $user = Auth::user();

        $isGameMaster = $user->isGameMaster($story);

        return inertia('Stories/Show', [
            'story' => StoryResource::make($story),
            'isGameMaster' => $isGameMaster,
        ]);
    }

    public function create()
    {
        return inertia('Stories/CreateModal');
    }
    
    public function store(Request $request): RedirectResponse
    {

    $validatedData = $request->validate([
        'title' => [
            'required',
            'unique:stories',
            'min:3',
            'max:22',
            'regex:/^[\p{L}\p{N}\s]+$/u',
        ],
        'plot' => 'nullable|string',
        'map' => 'nullable|file|mimes:pdf,jpg,png,webp|max:5000', // max: 5MB
    ]);

    $path = null;
    if ($request->hasFile('map')) {
        // Store the file in the 'maps' folder on the 'public' disk
        $path = $request->file('map')->store('maps', 'public');
    }

    $storyData = [
        'title' => $validatedData['title'],
        'plot' => $validatedData['plot'] ?? null,
        'map' => $path,
    ];

    $story = Story::create($storyData);

    $user = Auth::user();

    // User is set to game master.
    $story->users()->attach($user->id, ['role' => 'game_master']);

    return to_route('stories.index');
    }

    public function update(Request $request, Story $story) {

        $validatedData = $request->validate([
            'plot' => ['string', 'nullable']
        ]);

        $story->update($validatedData);

        return to_route('stories.show', [ 'story' => $story]);
    }

    public function destroy(Story $story) {

        Gate::authorize('delete', $story);

        $story->delete();

        return redirect()->route('stories.index')
                         ->with('message', 'Story deleted successfully!');
    }
}
