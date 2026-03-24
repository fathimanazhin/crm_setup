<?php

use App\Models\ActivityLog;

if (!function_exists('logActivity')) {
    function logActivity($action, $description = null, $related_type = null, $related_id = null)
    {
        if (auth()->check()) {
            // Only create log if related_id is set or optional
            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => $action,
                'description' => $description,
                'related_type' => $related_type,  // 'Customer', 'Lead', 'Task'
                'related_id' => $related_id,      // id of customer, lead, or task
            ]);
        }
    }
}