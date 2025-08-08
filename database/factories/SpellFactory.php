<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Spell;
use App\Models\Character;
use App\Models\NPC;

class SpellFactory extends Factory
{
    protected $model = Spell::class;

    public function definition(): array
    {
        return [
            'character_id' => Character::factory(), // Default: owned by a new Character
            'npc_id' => null, // Can be overridden
            'name' => $this->faker->randomElement([
                'Fireball', 'Healing Light', 'Shadow Cloak', 'Arcane Blast',
                'Frost Nova', 'Summon Familiar', 'Lightning Surge', 'Time Warp'
            ]),
            'description' => $this->faker->optional()->sentence(12),
            'quantity' => $this->faker->numberBetween(1, 3),
        ];
    }

    /**
     * Assign the spell to an NPC instead of a Character.
     */
    public function forNPC(): self
    {
        return $this->state(fn () => [
            'character_id' => null,
            'npc_id' => NPC::factory(),
        ]);
    }

    /**
     * Assign the spell to a specific Character.
     */
    public function ownedByCharacter(Character $character): self
    {
        return $this->state(fn () => [
            'character_id' => $character->id,
            'npc_id' => null,
        ]);
    }

    /**
     * Assign the spell to a specific NPC.
     */
    public function ownedByNPC(NPC $npc): self
    {
        return $this->state(fn () => [
            'character_id' => null,
            'npc_id' => $npc->id,
        ]);
    }
}

