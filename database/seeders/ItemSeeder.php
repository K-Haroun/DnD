<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Character;
use App\Models\NPC;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $characters = Character::all();
        $npcs = NPC::all();

        foreach ($characters as $character) {
            Item::factory()->count(2)->ownedByCharacter($character)->create();
        }

        foreach ($npcs as $npc) {
            Item::factory()->count(2)->ownedByNPC($npc)->create();
        }
    }
}
