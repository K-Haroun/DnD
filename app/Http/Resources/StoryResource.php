<?php

namespace App\Http\Resources;

use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'users' => UserResource::collection($this->users),
            'characters' => CharacterResource::collection($this->characters),
            'npcs' => NPCResource::collection($this->npcs),
            'title' => $this->title,
            'plot' => $this->plot,
            'map' => $this->map
        ];
    }
}
