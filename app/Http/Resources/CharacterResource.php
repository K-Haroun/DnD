<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CharacterResource extends JsonResource
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
            'user' => $this->whenLoaded('user', fn () => UserResource::make($this->user)),
            'items' => ItemResource::collection($this->items),
            'spells' => SpellResource::collection($this->spells),
            'name' => $this->name,
            'race' => $this->race,
            'class' => $this->class,
            'alignment' => $this->alignment,
            'level' => $this->level,
            'current_hp' => $this->current_hp,
            'max_hp' => $this->max_hp,
            'backstory' => $this->backstory,
            'armor_class' => $this->armor_class,
            'initiative' => $this->initiative,
            'speed' => $this->speed,
            'strength' => $this->strength,
        ];
    }
}
