<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $table = 'roles';

    protected $fillable = ['name', 'level', 'user_id_created', 'user_id_updated'];

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

    public function employees()
    {
        return $this->hasMany(Employee::class, 'role_id');
    }
}
