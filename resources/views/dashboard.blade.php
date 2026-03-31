@extends('layouts.app')

@section('content')

<div>

    <!-- TOP BAR -->
    <div class="flex justify-between items-center mb-6">

        <h1 class="text-xl font-semibold">Dashboard</h1>

        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-indigo-600 rounded-full"></div>
            <span>{{ auth()->user()->name }}</span>
        </div>

    </div>

    <!-- STATS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

        <div class="bg-indigo-900/60 p-6 rounded-xl shadow-lg backdrop-blur-md">
            <p class="text-sm text-gray-300">Total Customers</p>
            <h2 class="text-3xl font-bold mt-2">{{ $totalCustomers }}</h2>
        </div>

        <div class="bg-indigo-900/60 p-6 rounded-xl shadow-lg backdrop-blur-md">
            <p class="text-sm text-gray-300">Total Leads</p>
            <h2 class="text-3xl font-bold mt-2">{{ $totalLeads }}</h2>
        </div>

        <div class="bg-indigo-900/60 p-6 rounded-xl shadow-lg backdrop-blur-md">
            <p class="text-sm text-gray-300">Pending Tasks</p>
            <h2 class="text-3xl font-bold mt-2">{{ $pendingTasks }}</h2>
        </div>

    </div>

    <!-- ACTIVITIES HEADER -->
    <div class="flex items-center justify-between mb-4">

        <h3 class="text-lg font-semibold">Recent Activities</h3>

        <div class="flex items-center gap-3">

            <form method="GET" action="{{ route('dashboard') }}" class="flex items-center gap-2">

                <input type="date" name="date"
                    value="{{ request('date') }}"
                    class="bg-indigo-900 border border-indigo-700 px-2 py-1 rounded text-sm text-white">

                <button type="submit" class="text-cyan-400 hover:text-cyan-200">
                    Filter
                </button>

            </form>

            <a href="{{ route('activities.download', ['date' => request('date')]) }}"
               class="text-cyan-400 hover:text-cyan-200">
                Download
            </a>

        </div>

    </div>

    <!-- ACTIVITIES -->
    <div class="bg-indigo-900/60 rounded-xl p-6 backdrop-blur-md">

        @if($activities->isEmpty())
            <p class="text-gray-400">No activities found</p>
        @else

            <div class="space-y-4">

                @foreach($activities as $activity)

                    <div class="flex justify-between items-start border-b border-indigo-800 pb-3 hover:bg-indigo-800/40 px-3 py-2 rounded transition">

                        <div>

                            <div class="flex items-center gap-2">

                                <p class="font-medium">
                                    {{ $activity->user->name ?? 'Unknown User' }}
                                </p>

                                @php $action = strtolower($activity->action); @endphp

                                @if(str_contains($action, 'create'))
                                    <span class="text-xs bg-green-500/20 text-green-400 px-2 py-1 rounded">Created</span>
                                @elseif(str_contains($action, 'update'))
                                    <span class="text-xs bg-yellow-500/20 text-yellow-400 px-2 py-1 rounded">Updated</span>
                                @elseif(str_contains($action, 'delete'))
                                    <span class="text-xs bg-red-500/20 text-red-400 px-2 py-1 rounded">Deleted</span>
                                @else
                                    <span class="text-xs bg-blue-500/20 text-blue-400 px-2 py-1 rounded">Other</span>
                                @endif

                            </div>

                            <p class="text-gray-300 text-sm mt-1">
                                {{ $activity->action }}
                            </p>

                            <p class="text-xs text-gray-400 mt-1">
                                {{ $activity->description }}
                            </p>

                        </div>

                        <div class="text-xs text-gray-500">
                            {{ $activity->created_at->diffForHumans() }}
                        </div>

                    </div>

                @endforeach

            </div>

        @endif

    </div>

</div>

@endsection