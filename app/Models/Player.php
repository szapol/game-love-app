<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\PlayerFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Player
 *
 * @property int $id
 * @property string $first_name
 * @property string|null $last_name
 * @property Carbon|null $date_of_birth
 * @property float $balance
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Collection<int, Game> $lovedGames
 */
class Player extends Model
{
    /** @use HasFactory<PlayerFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'balance',
    ];

    /**
     * @var list<string>
     */
    protected $casts = [
        'date_of_birth' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function lovedGames(): BelongsToMany
    {
        return $this->belongsToMany(
            Game::class,
            'game_player',
            'player_id',
            'game_id',
        )->withTimestamps();
    }
}
