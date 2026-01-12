<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Teacher Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3 class="text-xl font-bold mb-8 text-slate-900 uppercase tracking-wider">My Modules</h3>

            @if(session('success'))
                <div class="bg-emerald-500/10 border-l-4 border-emerald-500 text-emerald-400 p-4 mb-6 backdrop-blur-md" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($modules as $module)
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 group hover:-translate-y-1 overflow-hidden">
                    <div class="p-6 relative">
                        <div class="flex justify-between items-start mb-4 relative z-10">
                            <h4 class="text-xl font-bold text-slate-900 group-hover:text-indigo-600 transition-colors duration-300">{{ $module->module }}</h4>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $module->is_available ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-red-50 text-red-700 border border-red-200' }} transition-all duration-300">
                                {{ $module->is_available ? 'Active' : 'Archived' }}
                            </span>
                        </div>
                        <div class="flex items-center text-slate-500 mb-6 relative z-10">
                            <svg class="w-5 h-5 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            <span class="font-medium">{{ $module->enrollments_count }} / 10 Students</span>
                        </div>
                        <a href="{{ route('teacher.modules.show', $module->id) }}" class="relative block w-full text-center bg-slate-900 border border-transparent hover:bg-slate-800 text-white py-3 rounded-lg transition-all duration-300 font-semibold shadow-sm hover:translate-y-px" style="background-color: #0f172a; color: white;">
                            Manage Students
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-16 bg-white rounded-lg border border-dashed border-gray-300">
                    <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <p class="text-slate-500 text-lg">No modules assigned yet.</p>
                    <p class="text-slate-400 text-sm mt-2">Contact your administrator to get started.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
