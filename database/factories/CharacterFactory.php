<?php

namespace Database\Factories;

use App\Models\Story;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Character>
 */
class CharacterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'story_id' => Story::factory(),

            'name' => $this->faker->firstName(),
            'race' => $this->faker->randomElement([
                'Human',
                'Elf',
                'Dwarf',
                'Halfling',
                'Orc',
                'Tiefling',
                'Dragonborn'
            ]),
            'class' => $this->faker->randomElement([
                'Fighter',
                'Wizard',
                'Rogue',
                'Cleric',
                'Paladin',
                'Ranger',
                'Bard'
            ]),
            'alignment' => $this->faker->randomElement([
                'Lawful Good',
                'Neutral Good',
                'Chaotic Good',
                'Lawful Neutral',
                'True Neutral',
                'Chaotic Neutral',
                'Lawful Evil',
                'Neutral Evil',
                'Chaotic Evil'
            ]),
            'level' => $this->faker->numberBetween(1, 20),
            'max_hp' => $this->faker->numberBetween(20, 120),
            'current_hp' => function (array $attributes) {
                return $this->faker->numberBetween(0, $attributes['max_hp']);
            },
            'backstory' => $this->faker->paragraphs(3, true),
            'armor_class' => $this->faker->numberBetween(10, 20),
            'initiative' => $this->faker->numberBetween(0, 5),
            'speed' => $this->faker->numberBetween(25, 40),
            'strength' => $this->faker->numberBetween(1, 20),
        ];
    }

    public function forUser(User $user): static
    {
        return $this->state(fn(array $attributes) => [
            'user_id' => $user->id,
        ]);
    }

    public function forStory(Story $story): static
    {
        return $this->state(fn(array $attributes) => [
            'story_id' => $story->id,
        ]);
    }
}
