<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameResource;
use App\Models\Player;

class PlayerController extends Controller
{
    public function getAllLovedGames(Player $player)
    {
        $games = $player->lovedGames()->get();

        return GameResource::collection($games);
    }
}
