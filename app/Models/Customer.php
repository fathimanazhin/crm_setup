<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

class Customer extends Model
{
    protected $fillable = [
    'name',
    'email',
    'phone',
    'company_name',
    'address',
    'status',
    'created_by'
];

    public function tasks()
    {
        return $this->morphMany(Task::class, 'related');
    }
}