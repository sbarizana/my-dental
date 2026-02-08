<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = ['name', 'description', 'price', 'user_id_created', 'user_id_updated'];

    protected $dates = ['deleted_at'];

    // Relationships
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id_created');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'user_id_updated');
    }

    public function paymentDetails()
    {
        return $this->hasMany(PaymentDetail::class, 'product_id');
    }
}
