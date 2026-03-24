<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'action',
    'description',
    'related_type',
    'related_id',
];

   public function user()
{
    return $this->belongsTo(User::class);
}
    public function customer()
{
    return $this->belongsTo(\App\Models\Customer::class, 'related_id')->where('related_type', 'Customer');
}

public function lead()
{
    return $this->belongsTo(\App\Models\Lead::class, 'related_id')->where('related_type', 'Lead');
}

public function task()
{
    return $this->belongsTo(\App\Models\Task::class, 'related_id')->where('related_type', 'Task');
}
}