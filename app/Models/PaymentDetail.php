<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentDetail extends Model
{
    use SoftDeletes;

    protected $table = 'payment_details';

    protected $fillable = ['payment_id', 'product_id', 'user_id_created', 'user_id_updated'];

    protected $dates = ['deleted_at'];

    // Relationships
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id_created');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'user_id_updated');
    }
}
