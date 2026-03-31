<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Lead;
use App\Models\Task;
use App\Models\ActivityLog;
use Barryvdh\DomPDF\Facade\Pdf;


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

        // ✅ Activities with date filter
        $date = request('date');

        if (auth()->user()->role == 'sales') {

            $query = ActivityLog::with('user')
                ->where('user_id', auth()->id());

        } else {

            $query = ActivityLog::with('user');
        }

        if ($date) {
            $query->whereDate('created_at', $date);
        }

        $activities = $query->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalCustomers',
            'totalLeads',
            'pendingTasks',
            'activities'
        ));
    }

    public function downloadActivities()
    {
        $date = request('date');

        if (auth()->user()->role == 'sales') {

            $query = ActivityLog::with('user')
                ->where('user_id', auth()->id());

        } else {

            $query = ActivityLog::with('user');
        }

        if ($date) {
            $query->whereDate('created_at', $date);
        }

        $activities = $query->latest()
            ->take(20)
            ->get();

        $pdf = Pdf::loadView('pdf.activities', compact('activities'));

        return $pdf->download('recent-activities.pdf');
    }
}