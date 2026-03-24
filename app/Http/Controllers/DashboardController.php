<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Lead;
use App\Models\Task;
use App\Models\ActivityLog;

class DashboardController extends Controller
{
    public function index()
    {
       if (auth()->user()->role == 'sales') {

    $totalCustomers = Customer::where('created_by', auth()->id())->count();

    $totalLeads = Lead::where('assigned_user_id', auth()->id())
    ->orWhere('created_by', auth()->id())
    ->count();

    $pendingTasks = Task::where('assigned_user_id', auth()->id())
                        ->where('status', 'Pending')
                        ->count();

} else {

    $totalCustomers = Customer::count();
    $totalLeads = Lead::count();
    $pendingTasks = Task::where('status', 'Pending')->count();
}

        if (auth()->user()->role == 'sales') {
    $activities = ActivityLog::with('user')
                    ->where('user_id', auth()->id())
                    ->latest()
                    ->take(5)
                    ->get();
} else {
    $activities = ActivityLog::with('user')
                    ->latest()
                    ->take(5)
                    ->get();
}

        return view('dashboard', compact(
            'totalCustomers',
            'totalLeads',
            'pendingTasks',
            'activities'
        ));
    }
}