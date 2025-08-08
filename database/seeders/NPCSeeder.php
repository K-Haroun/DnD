<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NPC;
use App\Models\Story;

class NPCSeeder extends Seeder
{
    public function run(): void
    {
        $stories = Story::all();

        foreach ($stories as $story) {
            NPC::factory()->count(3)->forStory($story)->create();
        }
    }
}
