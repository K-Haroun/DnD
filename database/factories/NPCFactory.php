<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\NPC;
use App\Models\Story;

class NPCFactory extends Factory
{
    protected $model = NPC::class;

    public function definition(): array
    {
        return [
            'story_id' => Story::factory(), // Automatically creates and links a Story
            'name' => $this->faker->unique()->name(),
            'description' => $this->faker->paragraph(3),
        ];
    }

    /**
     * Assign the NPC to a specific Story.
     */
    public function forStory(Story $story): self
    {
        return $this->state(fn () => [
            'story_id' => $story->id,
        ]);
    }
}

