<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Player;
use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Game::factory()
            ->has(Player::factory(rand(1, 3))
                ->has(Game::factory(rand(1, 3)), 'lovedGames'),
                'lovedByPlayers')
            ->count(10)
            ->create();
    }
}
