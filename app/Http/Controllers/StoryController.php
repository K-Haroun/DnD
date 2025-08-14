<?php

namespace App\Http\Controllers;

use App\Http\Resources\StoryResource;
use App\Models\Story;
use Illuminate\Http\RedirectResponse;

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
    
    public function store(): RedirectResponse
    {

        $validatedStory = request()->validate([
            'title' => 'required|unique:stories|min:3|max:22|alpha_num',
        ]);

        Story::create($validatedStory);

        return to_route('stories.index');
    }
}
