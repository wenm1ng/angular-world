<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Lottery extends Model
{
    use SoftDeletes;

    protected $table = 'lotteries';

    protected $connection = 'mysql';

    protected $hidden = ['deleted_at'];

    protected $fillable = ['game_id', 'user_id', 'result'];

    protected $appends = ['user'];

    public function getUserAttribute()
    {
        if (!empty($this->user_id)) {
            return User::find($this->user_id);
        }
        return null;
    }
}
