<?php

namespace App\Http\Controllers;

use App\Http\Resources\StoryResource;
use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function index()
    {
        return inertia('Stories/Index', [
            'stories' => StoryResource::collection(Story::paginate()),
        ]);
    }

    public function show(Story $story)
    {
        return inertia('Stories/Show', [
            'story' => StoryResource::make($story),
        ]);
    }
}
