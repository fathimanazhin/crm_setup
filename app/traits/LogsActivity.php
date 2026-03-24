<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

trait LogsActivity
{
    // Renamed method to avoid conflict
    public function recordActivity(string $action, ?Model $related = null)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'related_type' => $related ? get_class($related) : null,
            'related_id' => $related ? $related->id : null,
        ]);
    }
}