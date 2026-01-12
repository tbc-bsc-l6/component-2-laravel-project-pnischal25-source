<header class="flex items-center justify-between h-20 px-6 sm:px-10 bg-white border-b border-gray-100 sticky top-0 z-40">
    <div class="flex items-center">
        <!-- Search -->
        <div class="relative w-full max-w-md hidden sm:block">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none">
                    <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </span>
            <input type="text" class="w-full py-2 pl-10 pr-4 text-gray-700 bg-gray-50 border-none rounded-full focus:bg-white focus:ring-2 focus:ring-blue-100 focus:outline-none transition-all duration-200" placeholder="Search">
        </div>
    </div>
    
    <div class="flex items-center gap-4">
        <!-- Notifications -->
        <button class="relative p-2 text-gray-400 hover:text-gray-600 transition-colors">
            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
        </button>
        
        <!-- Profile -->
        <div class="flex items-center gap-3 pl-4 border-l border-gray-100">
            <div class="hidden md:block text-right">
                <div class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</div>
                <div class="text-xs text-gray-500">{{ Auth::user()->userRole->role ?? 'User' }}</div>
            </div>
            <img class="w-10 h-10 rounded-full border-2 border-white shadow-sm object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" alt="Profile">
        </div>
    </div>
</header>
