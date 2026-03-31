<x-guest-layout>
    <body class="min-h-screen bg-gradient-to-br from-indigo-900 via-indigo-700 to-cyan-500 flex items-center justify-center">

        <div class="w-full max-w-md bg-white/90 backdrop-blur-lg shadow-2xl rounded-2xl p-10">

            <!-- Title -->
            <h2 class="text-3xl font-bold text-center text-indigo-800 mb-6">
                Welcome Back
            </h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-input-error :messages="$errors->all()" class="mb-4" />

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Email
                    </label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-400 focus:outline-none"
                    >
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Password
                    </label>
                    <input
                        type="password"
                        name="password"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-400 focus:outline-none"
                    >
                </div>

                <!-- Remember + Forgot -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="remember" class="rounded">
                        Remember me
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-indigo-600 hover:underline">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-indigo-600 to-cyan-500 text-white py-2 rounded-lg font-semibold hover:opacity-90 transition"
                >
                    Log in
                </button>

                <!-- Register -->
                <p class="text-center text-sm text-gray-600">
                    Don’t have an account?
                    <a href="{{ route('register') }}" class="text-indigo-600 font-medium hover:underline">
                        Register
                    </a>
                </p>

            </form>

        </div>

    </body>
</x-guest-layout>