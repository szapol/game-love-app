<?php

namespace App\Enums;

enum GameCategory: string
{
    case Slots = 'slots';
    case TableGames = 'table_games';
    case LiveGames = 'live_games';
}
