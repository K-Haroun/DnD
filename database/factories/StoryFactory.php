<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Story;
use Illuminate\Support\Str;

class StoryFactory extends Factory
{
    protected $model = Story::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->catchPhrase(),
            'plot' => $this->faker->paragraphs(3, true),
            'map' => $this->faker->optional()->word() . '_map.png', // Simulated map filename
            'join_code' => strtoupper(Str::random(6)),
        ];
    }
}
