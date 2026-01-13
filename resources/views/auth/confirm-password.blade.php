<x-guest-layout>
    <div class="mb-4 text-sm text-gray-400">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <label class="block font-medium text-sm text-gray-300" for="password">Password</label>
            <input id="password" class="block mt-1 w-full bg-gray-900/50 border-gray-600 focus:border-purple-500 focus:ring-purple-500/50 rounded-lg shadow-sm text-white transition-all placeholder-gray-500" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <button class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-500 focus:bg-purple-500 active:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-purple-500/20">
                {{ __('Confirm') }}
            </button>
        </div>
    </form>
</x-guest-layout>
