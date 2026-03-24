<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Task;

class Lead extends Model
{
    protected $fillable = [
    'lead_name',
    'email',
    'phone',
    'source',
    'status',
    'assigned_user_id',
    'created_by', // ← ADD THIS
];

    // Lead belongs to a user
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    // One Lead → Many Tasks
    public function tasks()
{
    return $this->morphMany(Task::class, 'related');
}
}