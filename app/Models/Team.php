<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes;

    protected $table = 'teams';

    protected $connection = 'mysql';

    protected $hidden = ['deleted_at'];

    protected $fillable = ['name', 'description'];
}
