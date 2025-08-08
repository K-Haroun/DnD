<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Spell;
use App\Models\Character;
use App\Models\NPC;

class SpellSeeder extends Seeder
{
    public function run(): void
    {
        $characters = Character::all();
        $npcs = NPC::all();

        foreach ($characters as $character) {
            Spell::factory()->count(2)->ownedByCharacter($character)->create();
        }

        foreach ($npcs as $npc) {
            Spell::factory()->count(2)->ownedByNPC($npc)->create();
        }
    }
}
