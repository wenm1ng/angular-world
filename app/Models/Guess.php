<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guess extends Model
{
    use SoftDeletes;

    protected $table = 'guesses';

    protected $connection = 'mysql';

    protected $hidden = ['deleted_at'];

    protected $fillable = ['game_id', 'user_id', 'bet_result'];

    protected $appends = ['user'];

    public function getUserAttribute()
    {
        if (!empty($this->user_id)) {
            return User::find($this->user_id);
        }
        return null;
    }
}
