<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $table = 'payments';

    protected $fillable = ['method_payment', 'total', 'customer_id', 'branch_id', 'dentist_employee_id', 'cashier_employee_id', 'user_id_created', 'user_id_updated'];

    protected $dates = ['deleted_at'];

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function dentist()
    {
        return $this->belongsTo(Employee::class, 'dentist_employee_id');
    }

    public function cashier()
    {
        return $this->belongsTo(Employee::class, 'cashier_employee_id');
    }

    public function paymentDetails()
    {
        return $this->hasMany(PaymentDetail::class, 'payment_id');
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
