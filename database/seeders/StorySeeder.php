<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Story;
use App\Models\User;

class StorySeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        Story::factory()->count(5)->create()->each(function ($story) use ($users) {
            $assignedUsers = $users->random(3);

            foreach ($assignedUsers as $index => $user) {
                $story->users()->attach($user->id, [
                    'role' => $index === 0 ? 'game_master' : 'player',
                ]);
            }
        });
    }
}
