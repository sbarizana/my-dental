<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $table = 'payments';

    protected $fillable = ['method_payment', 'total', 'user_id_created', 'user_id_updated'];

    protected $dates = ['deleted_at'];
}
