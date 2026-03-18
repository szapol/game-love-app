<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetMostLovedGamesRequest;
use App\Http\Requests\LoveGameRequest;
use App\Http\Requests\UnloveGameRequest;
use App\Http\Resources\GameResource;
use App\Models\Game;
use App\Models\Player;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    const PER_PAGE = 12;

    public function index()
    {
        $games = Game::paginate(self::PER_PAGE);

        return GameResource::collection($games);
    }

    public function love(LoveGameRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $data = $request->validated();
            $player = Player::findOrFail($data['player_id']);

            $player->lovedGames()->syncWithoutDetaching($data['game_id']);

            return response()->noContent();
        });
    }

    public function unlove(UnloveGameRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $data = $request->validated();
            $player = Player::findOrFail($data['player_id']);

            $player->lovedGames()->detach($data['game_id']);

            return response()->noContent();
        });
    }

    public function getMostLoved(GetMostLovedGamesRequest $request)
    {
        $games = Game::select(['id'])
            ->withCount('lovedByPlayers')
            ->orderBy('loved_by_players_count', 'desc')
            ->take($request->limit)
            ->get();

        return GameResource::collection($games);
    }
}
