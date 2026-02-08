<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use SoftDeletes;

    protected $table = 'branches';

    protected $fillable = ['name', 'address', 'phone', 'latitude', 'longitude', 'user_id_created', 'user_id_updated'];

    protected $dates = ['deleted_at'];
}
