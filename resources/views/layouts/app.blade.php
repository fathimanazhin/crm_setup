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
</head>

<body class="font-sans antialiased bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <div class="w-64 bg-gray-800 text-white p-5">

        <h2 class="text-2xl font-bold mb-6">CRM</h2>

        <ul class="space-y-4">
            <li>
                <a href="{{ route('dashboard') }}" class="block hover:text-blue-400">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('customers.index') }}" class="block hover:text-blue-400">Customers</a>
            </li>
            <li>
                <a href="{{ route('leads.index') }}" class="block hover:text-blue-400">Leads</a>
            </li>
            <li>
                <a href="{{ route('tasks.index') }}" class="block hover:text-blue-400">Tasks</a>
            </li>
        </ul>

    </div>

    <!-- Main Content -->
    <div class="flex-1">

        <!-- Top Navbar -->
        <div class="bg-white shadow p-4 flex justify-between items-center">
            <h1 class="text-lg font-semibold">Dashboard</h1>

            <div class="flex items-center space-x-4">
                <span>{{ Auth::user()->name }}</span>

                <!-- Correct Logout Form/Button -->
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