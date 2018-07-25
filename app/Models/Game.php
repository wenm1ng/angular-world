<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use SoftDeletes;

    protected $table = 'games';

    protected $connection = 'mysql';

    protected $hidden = ['deleted_at'];

    protected $fillable = [
        'game_time', 'team_id', 'opponent_id', 'winner_id',
        'team_count', 'team_score', 'opponent_score', 'status', 'opponent_count'
        , 'first_prize', 'second_prize', 'third_prize', 'fourth_prize','five_prize'];

    protected $casts = [
        'team_id' => 'int',
        'opponent_id' => 'int',
        'status' => 'int'
    ];

    protected $appends = ['team', 'opponent', 'guessCount'];

    public function getTeamAttribute()
    {
        if (!empty($this->team_id)) {
            return Team::find($this->team_id);
        }
        return null;
    }

    public function getOpponentAttribute()
    {
        if (!empty($this->opponent_id)) {
            return Team::find($this->opponent_id);
        }
        return null;
    }

    public function getGuessCountAttribute()
    {
        return Guess::where('game_id', $this->id)->count();
    }
}
