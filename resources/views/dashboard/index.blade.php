@extends('layouts.app')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-gray-600">Total Customers</h2>
            <p class="text-3xl font-bold">{{ $totalCustomers }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-gray-600">Total Leads</h2>
            <p class="text-3xl font-bold">{{ $totalLeads }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-gray-600">Pending Tasks</h2>
            <p class="text-3xl font-bold">{{ $pendingTasks }}</p>
        </div>

    </div>

    <!-- Recent Activities -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Recent Activities</h2>

        <ul>
            @forelse($recentActivities as $activity)
                <li class="border-b py-2">
                    {{ $activity->description }}
                    <span class="text-sm text-gray-500">
                        ({{ $activity->created_at->diffForHumans() }})
                    </span>
                </li>
            @empty
                <li>No activities found</li>
            @endforelse
        </ul>
    </div>

</div>

@endsection