<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpellResource extends JsonResource
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
            'character' => CharacterResource::make($this->character),
            'npc' => NPCResource::make($this->npc),
            'name' => $this->name,
            'description' => $this->description,
            'quantity' => $this->quantity,
        ];
    }
}
