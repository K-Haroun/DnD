<?php

namespace App\Http\Controllers;

use App\Http\Resources\StoryResource;
use App\Models\Story;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

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

        $story->load(['users', 'characters.items', 'characters.spells', 'characters.user', 'npcs']);

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
        'join_code' => strtoupper(Str::random(6))
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

    public function joinWithCode(Request $request)
    {
        $validated = $request->validate([
            'join_code' => 'required|string|max:6|exists:stories,join_code',
        ]);

        $story = Story::where('join_code', $validated['join_code'])->first();
        $user = Auth::user();

        // Prevent duplicate joins
        if ($story->users()->where('user_id', $user->id)->exists()) {
            return back()->with('message', 'You already joined this story.');
        }

        $story->users()->attach($user->id, ['role' => 'player']);

        return redirect()->route('stories.show', $story)
                        ->with('message', 'You joined the story!');
    }

}
