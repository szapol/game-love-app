<?php


use App\Models\Game;
use App\Models\Player;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class GameTest extends TestCase
{
    use RefreshDatabase;

    public function test_player_can_love_game(): void
    {
        $player = Player::factory()->create();
        $game = Game::factory()->create();

        $data = [
          'player_id' => $player->id,
          'game_id' => $game->id,
        ];

        $response = $this->post('/api/games/love', $data);

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseHas('game_player', [
            'player_id' => $data['player_id'],
            'game_id' => $data['game_id'],
        ]);
    }

    public function test_player_can_unlove_game(): void
    {
        $player = Player::factory()->create();
        $game = Game::factory()->create();

        $player->lovedGames()->attach($game->id);

        $this->assertDatabaseHas('game_player', [
            'player_id' => $player->id,
            'game_id' => $game->id,
        ]);

        $data = [
            'player_id' => $player->id,
            'game_id' => $game->id,
        ];

        $response = $this->post('/api/games/unlove', $data);

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('game_player', [
            'player_id' => $player->id,
            'game_id' => $game->id,
        ]);
    }
}
