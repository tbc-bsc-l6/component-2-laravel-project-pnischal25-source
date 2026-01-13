<x-guest-layout>
    <div class="mb-4 text-sm text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label class="block font-medium text-sm text-gray-700 mb-2" for="email">Email</label>
            <input id="email" class="block w-full bg-white border-2 border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/30 rounded-xl shadow-sm text-gray-900 transition-all duration-300 placeholder-gray-400 px-4 py-3 hover:border-gray-400" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-center mt-6">
            <button class="inline-flex items-center px-4 py-2 bg-gray-900 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 focus:bg-gray-800 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg" style="background-color: #111827; color: white;">
                {{ __('Email Password Reset Link') }}
            </button>
        </div>
    </form>
</x-guest-layout>
