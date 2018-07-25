<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BadCodes extends Model
{
    use SoftDeletes;

    protected $table = 'bad_codes';

    protected $connection = 'mysql';

    protected $hidden = [];

    protected $fillable = [
        'codes', 'status'];

    public function getUserAttribute()
    {
        if (!empty($this->user_id)) {
            return User::find($this->user_id);
        }
        return null;
    }

}
