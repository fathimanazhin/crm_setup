<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center px-4">

        <div class="w-full max-w-md bg-indigo-900/60 backdrop-blur-md p-6 rounded-xl shadow-lg text-center">

            <!-- Message -->
            <div class="mb-4 text-sm text-gray-300">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-green-400" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-4 text-left">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-300" />

                    <x-text-input id="email"
                        class="block mt-1 w-full bg-indigo-950 border border-indigo-700 text-white focus:ring-cyan-400"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required autofocus />

                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                </div>

                <div class="flex justify-center mt-4">
                    <x-primary-button class="bg-gradient-to-r from-indigo-600 to-cyan-500 hover:opacity-90">
                        {{ __('Email Password Reset Link') }}
                    </x-primary-button>
                </div>
            </form>

        </div>

    </div>
</x-guest-layout>