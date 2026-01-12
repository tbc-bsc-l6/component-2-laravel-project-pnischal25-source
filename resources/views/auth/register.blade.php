<x-guest-layout>
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">Create Account</h2>
    <p class="text-center text-gray-600 text-sm mb-6">Join us and start your learning journey</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label class="block font-medium text-sm text-gray-700 mb-2" for="name">Full Name</label>
            <input id="name" class="block w-full bg-white border-2 border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/30 rounded-xl shadow-sm text-gray-900 transition-all duration-300 placeholder-gray-400 px-4 py-3 hover:border-gray-400" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label class="block font-medium text-sm text-gray-700 mb-2" for="email">Email Address</label>
            <input id="email" class="block w-full bg-white border-2 border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/30 rounded-xl shadow-sm text-gray-900 transition-all duration-300 placeholder-gray-400 px-4 py-3 hover:border-gray-400" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="your@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label class="block font-medium text-sm text-gray-700 mb-2" for="password">Password</label>
            <input id="password" class="block w-full bg-white border-2 border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/30 rounded-xl shadow-sm text-gray-900 transition-all duration-300 placeholder-gray-400 px-4 py-3 hover:border-gray-400" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label class="block font-medium text-sm text-gray-700 mb-2" for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" class="block w-full bg-white border-2 border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/30 rounded-xl shadow-sm text-gray-900 transition-all duration-300 placeholder-gray-400 px-4 py-3 hover:border-gray-400" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit" class="w-full bg-gray-900 hover:bg-gray-800 text-white font-bold py-3 px-4 rounded-xl shadow-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2" style="background-color: #111827; color: white;">
            {{ __('Create Account') }}
        </button>
        
        <div class="mt-6 text-center">
            <span class="text-sm text-gray-600">Already have an account? <a href="{{ route('login') }}" class="text-teal-600 hover:text-teal-700 font-medium transition-colors">Sign in</a></span>
        </div>
    </form>
</x-guest-layout>
