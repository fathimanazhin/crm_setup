<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index() {
        if(auth()->user()->role == 'sales') {
            $logs = ActivityLog::where(function($query) {
                $query->whereHas('customer', fn($q) => $q->where('created_by', auth()->id()))
                      ->orWhereHas('lead', fn($q) => $q->where('assigned_to', auth()->id()))
                      ->orWhereHas('task', fn($q) => $q->where('assigned_to', auth()->id()));
            })->latest()->get();
        } else {
            $logs = ActivityLog::latest()->get();
        }

        return view('activity_logs.index', compact('logs'));
    }
}