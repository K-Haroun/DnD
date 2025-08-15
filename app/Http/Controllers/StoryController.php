<?php

namespace App\Http\Controllers;

use App\Http\Resources\StoryResource;
use App\Models\Story;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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

        $story->load(['characters', 'npcs']);

        return inertia('Stories/Show', [
            'story' => StoryResource::make($story),
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
        'map' => 'nullable|file|mimes:pdf,jpg,png|max:5000', // max: 5MB
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

    Story::create($storyData);

    return to_route('stories.index');
    }
}
