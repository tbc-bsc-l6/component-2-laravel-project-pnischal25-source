<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">Welcome Back</h2>
    <p class="text-center text-gray-600 text-sm mb-6">Sign in to continue to your dashboard</p>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label class="block font-medium text-sm text-gray-700 mb-2" for="email">Email Address</label>
            <input id="email" class="block w-full bg-slate-50 border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 rounded-lg shadow-sm text-slate-900 transition-all duration-200 px-4 py-3" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="your@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label class="block font-medium text-sm text-gray-700 mb-2" for="password">Password</label>
            <input id="password" class="block w-full bg-slate-50 border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 rounded-lg shadow-sm text-slate-900 transition-all duration-200 px-4 py-3" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="rounded bg-slate-50 border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 focus:ring-2 transition-all duration-200" name="remember">
                <span class="ms-2 text-sm text-gray-700 group-hover:text-gray-900 transition-colors">{{ __('Remember me') }}</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-600 hover:text-indigo-700 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors duration-200" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-3 px-4 rounded-lg shadow-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2" style="background-color: #0f172a; color: white;">
            {{ __('Sign In') }}
        </button>
        
        <div class="mt-6 text-center">
             <span class="text-sm text-gray-600">Don't have an account? <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-700 font-medium transition-colors">Create one</a></span>
        </div>
    </form>
</x-guest-layout>
