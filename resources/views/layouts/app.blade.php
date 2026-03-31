<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .sidebar-link {
            transition: all 0.2s ease;
        }

        .sidebar-link:hover {
            transform: translateX(4px);
            color: #60a5fa !important;
        }

        .sidebar-link.active {
            background: rgba(79, 70, 229, 0.6);
            color: #ffffff !important;
            font-weight: 600;
        }

        .sidebar-link:hover {
            text-shadow: 0 0 5px rgba(96,165,250,0.6);
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-indigo-950 via-indigo-900 to-cyan-700 text-white">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    @if (!isset($noSidebar))

    <div class="w-64 bg-indigo-950/70 backdrop-blur-lg border-r border-indigo-800 p-6 hidden md:block">

        <h2 class="text-xl font-bold mb-8">CRM</h2>

        <ul class="space-y-3">

            <li>
                <a href="{{ route('dashboard') }}" 
                   class="block px-4 py-2 rounded-lg sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('customers.index') }}" 
                   class="block px-4 py-2 rounded-lg sidebar-link {{ request()->routeIs('customers.*') ? 'active' : '' }}">
                    Customers
                </a>
            </li>

            <li>
                <a href="{{ route('leads.index') }}" 
                   class="block px-4 py-2 rounded-lg sidebar-link {{ request()->routeIs('leads.*') ? 'active' : '' }}">
                    Leads
                </a>
            </li>

            <li>
                <a href="{{ route('tasks.index') }}" 
                   class="block px-4 py-2 rounded-lg sidebar-link {{ request()->routeIs('tasks.*') ? 'active' : '' }}">
                    Tasks
                </a>
            </li>

            <li>
                <a href="{{ route('calendar.index') }}" 
                   class="block px-4 py-2 rounded-lg sidebar-link {{ request()->routeIs('calendar.*') ? 'active' : '' }}">
                    Calendar
                </a>
            </li>

        </ul>

    </div>

    @endif

    <!-- Main Content -->
    <div class="flex-1">

        <!-- Top Navbar -->
        <div class="bg-white shadow p-4 flex justify-between items-center text-black">
            <h1 class="text-lg font-semibold">
                {{ ucfirst(request()->segment(1) ?? 'Dashboard') }}
            </h1>

            <div class="flex items-center space-x-4">
                <span>{{ Auth::user()->name }}</span>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700 font-medium">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Page Content -->
        <div class="p-6">
            @yield('content')
        </div>

    </div>

</div>

</body>
</html>