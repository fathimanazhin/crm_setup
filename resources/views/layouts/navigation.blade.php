<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between h-16 items-center">

            <!-- Left Menu -->
            <div class="flex space-x-6">
                <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 font-medium">Dashboard</a>
                <a href="{{ route('customers.index') }}" class="text-gray-700 hover:text-blue-600 font-medium">Customers</a>
                <a href="{{ route('leads.index') }}" class="text-gray-700 hover:text-blue-600 font-medium">Leads</a>
                <a href="{{ route('tasks.index') }}" class="text-gray-700 hover:text-blue-600 font-medium">Tasks</a>
            </div>

            <!-- Right Menu -->
            <div class="flex items-center space-x-4">
                <span class="text-gray-600">{{ Auth::user()->name }}</span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700 font-medium">
                        Logout
                    </button>
                </form>
            </div>

        </div>
    </div>
</nav>