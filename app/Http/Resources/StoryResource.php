<?php

namespace App\Http\Resources;

use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
            'users' => $this->whenLoaded('users', fn () => UserResource::collection($this->users)),
            'characters' => $this->whenLoaded('characters', fn () => CharacterResource::collection($this->characters)),
            'npcs' => $this->whenLoaded('npcs', fn () => NPCResource::collection($this->npcs)),
            'notes' => $this->whenLoaded('notes', fn () => NoteResource::collection($this->notes)),
            'title' => $this->title,
            'plot' => $this->plot,
            'map' => $this->map,
            'map_url' => $this->map ? Storage::url($this->map) : null,
            'join_code' => $this->join_code,
        ];
    }
}
