<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <!-- Logo Icon -->
            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
            </svg>
            <h2 class="font-semibold text-2xl text-white leading-tight">
                {{ __('Student Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-16">
            
            <!-- Active Enrollments -->
            <div>
                <h3 class="text-xl font-bold mb-6 text-slate-900 uppercase tracking-wider">My Active Modules</h3>
                
                @if(session('success'))
                    <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-6 relative" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 relative" role="alert">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif
                
                <div class="space-y-4">
                    @forelse($currentEnrollments as $enrollment)
                    <div class="bg-white border border-gray-200 p-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                        <div class="flex flex-col space-y-3">
                            <div>
                                <h4 class="text-xl font-bold text-slate-900 mb-1">{{ $enrollment->module->module }}</h4>
                                <p class="text-sm text-slate-500 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    Enrolled: {{ $enrollment->enrolled_at->format('M d, Y') }}
                                </p>
                            </div>
                            
                            <div>
                                <span class="inline-block px-4 py-1.5 text-xs font-medium text-slate-600 border border-gray-300 rounded-full">
                                    In Progress
                                </span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-8 text-center text-gray-500 bg-white rounded-lg border border-dashed border-gray-300">
                        <p>You are not enrolled in any modules.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Available Modules -->
            <div>
                <div class="flex justify-between items-end mb-6">
                     <h3 class="text-xl font-bold text-slate-900 uppercase tracking-wider">Available Modules</h3>
                     @if(!$canEnroll)
                        <span class="text-red-500 text-sm font-medium">You have reached the maximum of 4 active modules.</span>
                     @endif
                </div>
                
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-slate-600">
                            <thead class="bg-gradient-to-r from-blue-600 to-blue-800 uppercase text-xs text-white border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-4 font-semibold">Module Name</th>
                                    <th class="px-6 py-4 font-semibold">Availability</th>
                                    <th class="px-6 py-4 text-right font-semibold">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($availableModules as $module)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 font-medium text-slate-900">{{ $module->module }}</td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm text-slate-500">{{ $module->enrollments_count }}/10 Spots Taken</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        @if($canEnroll)
                                            <form action="{{ route('student.enroll') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="module_id" value="{{ $module->id }}">
                                                <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white px-5 py-2.5 rounded-lg text-sm font-semibold transition-all duration-300 shadow-sm transform hover:translate-y-px" style="background-color: #0f172a; color: white;">
                                                    Enroll Now
                                                </button>
                                            </form>
                                        @else
                                            <button disabled class="bg-gray-100 text-gray-400 px-4 py-2 rounded-lg text-sm font-medium cursor-not-allowed border border-gray-200">
                                                Limit Reached
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-8 text-center text-slate-500">No available modules found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
