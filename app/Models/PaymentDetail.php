<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentDetail extends Model
{
    use SoftDeletes;

    protected $table = 'payment_details';

    protected $fillable = ['user_id_created', 'user_id_updated'];

    protected $dates = ['deleted_at'];
}
