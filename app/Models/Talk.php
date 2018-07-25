<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Talk extends Model
{
    use SoftDeletes;

    protected $table = 'talks';

    protected $connection = 'mysql';

    protected $hidden = ['deleted_at'];

    protected $fillable = ['user_id', 'content'];

    protected $appends = ['user'];

    public function getUserAttribute()
    {
        if (!empty($this->user_id)) {
            return User::find($this->user_id);
        }
        return null;
    }
}