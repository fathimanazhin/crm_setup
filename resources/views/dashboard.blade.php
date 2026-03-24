@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4">

    <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

        <div class="bg-blue-500 text-white p-4 rounded shadow">
            <h4>Total Customers</h4>
            <h2 class="text-2xl font-bold">{{ $totalCustomers }}</h2>
        </div>

        <div class="bg-green-500 text-white p-4 rounded shadow">
            <h4>Total Leads</h4>
            <h2 class="text-2xl font-bold">{{ $totalLeads }}</h2>
        </div>

        <div class="bg-yellow-500 text-white p-4 rounded shadow">
            <h4>Pending Tasks</h4>
            <h2 class="text-2xl font-bold">{{ $pendingTasks }}</h2>
        </div>

    </div>

    <!-- Recent Activities -->
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-lg font-semibold mb-3">Recent Activities</h3>

        @if($activities->isEmpty())
            <p class="text-gray-500">No activities found</p>
        @else
            <ul class="space-y-2">
                @foreach($activities as $activity)
                    <li class="border-b pb-2">
                        <strong>{{ $activity->user->name ?? 'Unknown User' }}</strong>
                        {{ $activity->action }}
                        <br>
                        <span class="text-sm text-gray-500">
                            {{ $activity->description }} • {{ $activity->created_at->diffForHumans() }}
                        </span>
                    </li>
                @endforeach
            </ul>
        @endif

    </div>

</div>

@endsection