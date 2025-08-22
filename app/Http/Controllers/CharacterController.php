<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CharacterResource;
use App\Models\Character;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{
    public function index()
    {
        
        $characters = Character::with(['items', 'spells'])
        ->where('user_id', Auth::id())
        ->get();

        return inertia('Characters/Index', [
            'characters' => CharacterResource::collection($characters),
        ]);
    }

    public function store(Request $request)
    {

        $userId = Auth::id();

        $validatedData = $request->validate([
            'name' => [
                'required',
                'unique:characters',
                'min:3',
                'max:22',
                'regex:/^[\p{L}\p{N}\s]+$/u',
        ],
            'race' => [
                'required',
                'min:3',
                'max:22',
                'regex:/^[\p{L}\p{N}\s]+$/u',
            ],
            'class' => [
                'required',
                'min:3',
                'max:22',
                'regex:/^[\p{L}\p{N}\s]+$/u',
            ],
            'alignment' => [
                'required',
                'min:3',
                'max:22',
                'regex:/^[\p{L}\p{N}\s]+$/u',
            ],
            'backstory' => [
                'nullable',
                'string',
                'max:255'
            ],
            'level' => [
                'required',
                'integer',
                'min:1'
            ],
            'current_hp' => [
                'required',
                'integer',
                'min:1'
            ],
            'max_hp' => [
                'required',
                'integer',
                'min:1'
            ],
            'armor_class' => [
                'required',
                'integer',
                'min:1'
            ],
            'initiative' => [
                'required',
                'integer',
                'min:1'
            ],
            'speed' => [
                'required',
                'integer',
                'min:1'
            ],
            'strength' => [
                'required',
                'integer',
                'min:1'
            ],
        ]);

        $validatedData['user_id'] = $userId;
        $validatedData['story_id'] = $request->story_id;
        
        Character::create($validatedData);

        return to_route('stories.show', $request->story_id)->with('message', 'Character created successfully!');
    }
}
