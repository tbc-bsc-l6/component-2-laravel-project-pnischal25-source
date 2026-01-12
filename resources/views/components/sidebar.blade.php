<div class="hidden md:flex flex-col w-64 bg-white border-r border-gray-100 h-full fixed top-0 left-0 bottom-0 z-50">
    <div class="flex items-center justify-center h-20 border-b border-gray-100">
        <div class="flex items-center gap-2">
            <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5L12 22l10-8.5-5-2.5-5 2.5z"/></svg>
            <span class="text-xl font-bold text-gray-800 tracking-tight">SchoolHub</span>
        </div>
    </div>
    
    <div class="overflow-y-auto overflow-x-hidden flex-grow">
        <ul class="flex flex-col py-4 space-y-1">
            <li class="px-5">
                <div class="flex flex-row items-center h-8">
                    <div class="text-xs font-semibold tracking-wide text-gray-400 uppercase">Menu</div>
                </div>
            </li>
            
            <li>
                <a href="{{ route('dashboard') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-blue-50 text-gray-600 hover:text-blue-600 border-l-4 border-transparent hover:border-blue-500 pr-6 pl-4 transition-colors duration-200 {{ request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600 border-blue-500' : '' }}">
                    <span class="inline-flex justify-center items-center ml-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </span>
                    <span class="ml-2 text-sm font-medium tracking-wide truncate">Dashboard</span>
                </a>
            </li>

            <!-- Admin Links -->
            @if(Auth::user()->userRole && Auth::user()->userRole->role === 'Admin')
                <!-- We can add specific links to scroll to sections or separate pages if they existed -->
            @endif

            <li class="px-5 mt-4">
                <div class="flex flex-row items-center h-8">
                    <div class="text-xs font-semibold tracking-wide text-gray-400 uppercase">Other</div>
                </div>
            </li>
            
            <li>
                <a href="{{ route('profile.edit') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-blue-50 text-gray-600 hover:text-blue-600 border-l-4 border-transparent hover:border-blue-500 pr-6 pl-4 transition-colors duration-200 {{ request()->routeIs('profile.edit') ? 'bg-blue-50 text-blue-600 border-blue-500' : '' }}">
                    <span class="inline-flex justify-center items-center ml-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </span>
                    <span class="ml-2 text-sm font-medium tracking-wide truncate">Profile</span>
                </a>
            </li>
             <li>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full text-left relative flex flex-row items-center h-11 focus:outline-none hover:bg-red-50 text-gray-600 hover:text-red-600 border-l-4 border-transparent hover:border-red-500 pr-6 pl-4 transition-colors duration-200">
                        <span class="inline-flex justify-center items-center ml-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </span>
                        <span class="ml-2 text-sm font-medium tracking-wide truncate">Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>
