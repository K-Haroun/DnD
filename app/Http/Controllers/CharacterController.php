<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CharacterResource;

class CharacterController extends Controller
{
    public function index()
    {
        return inertia('Characters/Index', [
            'characters' => CharacterResource::collection(Character::latest()),
        ]);
    }
}
