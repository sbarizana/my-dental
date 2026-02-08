<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $table = 'employees';

    protected $fillable = ['phone', 'email', 'role_id', 'branch_id', 'user_id_created', 'user_id_updated'];

    protected $dates = ['deleted_at'];

    // Relationships
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
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
