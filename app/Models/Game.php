<?php

namespace App\Models;

use App\Enums\GameCategory;
use Carbon\Carbon;
use Database\Factories\GameFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Game
 *
 * @property int $id
 * @property string $name
 * @property GameCategory $category
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Collection<int, Player> $lovedByPlayers
 */
class Game extends Model
{
    /** @use HasFactory<GameFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'category',
        'description',
    ];

    /**
     * @var list<string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return BelongsToMany
     */
    public function lovedByPlayers(): BelongsToMany
    {
        return $this->belongsToMany(
            Player::class,
            'game_player',
            'game_id',
            'player_id',
        )->withTimestamps();
    }
}
