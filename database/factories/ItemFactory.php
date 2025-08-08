<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;
use App\Models\Character;
use App\Models\NPC;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition(): array
    {
        return [
            'character_id' => Character::factory(), // Creates and assigns a new Character
            'npc_id' => null, // Default to null unless overridden
            'name' => $this->faker->randomElement([
                'Iron Sword', 'Healing Potion', 'Leather Armor', 'Magic Scroll',
                'Torch', 'Lockpick Set', 'Enchanted Ring', 'Crossbow'
            ]),
            'description' => $this->faker->optional()->sentence(12),
            'quantity' => $this->faker->numberBetween(1, 5),
        ];
    }

    /**
     * Assign the item to an NPC instead of a Character.
     */
    public function forNPC(): self
    {
        return $this->state(fn () => [
            'character_id' => null,
            'npc_id' => NPC::factory(),
        ]);
    }

    /**
     * Assign the item to a specific Character.
     */
    public function ownedByCharacter(Character $character): self
    {
        return $this->state(fn () => [
            'character_id' => $character->id,
            'npc_id' => null,
        ]);
    }

    /**
     * Assign the item to a specific NPC.
     */
    public function ownedByNPC(NPC $npc): self
    {
        return $this->state(fn () => [
            'character_id' => null,
            'npc_id' => $npc->id,
        ]);
    }
}

