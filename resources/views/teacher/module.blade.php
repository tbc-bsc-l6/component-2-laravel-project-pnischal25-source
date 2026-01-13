<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-slate-800 leading-tight">
            {{ __('Module: ' . $module->module) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('teacher.dashboard') }}" class="text-slate-500 hover:text-slate-700 flex items-center transition-colors">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to Dashboard
                </a>
                <span class="text-slate-500 font-medium flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Total Enrollment: {{ $enrollments->count() }}/10
                </span>
            </div>

            <!-- Search -->
            <form method="GET" action="{{ route('teacher.modules.show', $module->id) }}" class="mb-6">
                 <div class="relative max-w-md">
                    <input type="text" name="search" placeholder="Search students..." value="{{ request('search') }}" class="w-full bg-white text-slate-900 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 pl-10 pr-4 py-3 transition-all duration-300 placeholder-gray-400 shadow-sm">
                    <div class="absolute left-3 top-3 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>
            </form>

            <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-slate-600">
                        <thead class="bg-slate-50 uppercase text-xs text-slate-500 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 font-semibold">Student Name</th>
                                <th class="px-6 py-4 font-semibold">Email</th>
                                <th class="px-6 py-4 font-semibold">Enrolled Date</th>
                                <th class="px-6 py-4 font-semibold">Status</th>
                                <th class="px-6 py-4 font-semibold">Grading</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($enrollments as $enrollment)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-slate-900">{{ $enrollment->user->name }}</td>
                                <td class="px-6 py-4">{{ $enrollment->user->email }}</td>
                                <td class="px-6 py-4">{{ $enrollment->enrolled_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4">
                                    @if($enrollment->status === 'enrolled')
                                        <span class="px-2 py-1 rounded text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">In Progress</span>
                                    @elseif($enrollment->status === 'pass')
                                        <span class="px-2 py-1 rounded text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">Passed</span>
                                    @else
                                        <span class="px-2 py-1 rounded text-xs font-semibold bg-red-50 text-red-700 border border-red-200">Failed</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($enrollment->status === 'enrolled')
                                        <form action="{{ route('teacher.enrollments.grade', $enrollment) }}" method="POST" class="inline-block space-x-2">
                                            @csrf
                                            @method('PATCH')
                                            <button name="status" value="pass" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-medium transition-all duration-300 shadow-sm hover:shadow-md" onclick="return confirm('Mark as Pass?')" style="background-color: #059669; color: white;">Pass</button>
                                            <button name="status" value="fail" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition-all duration-300 shadow-sm hover:shadow-md" onclick="return confirm('Mark as Fail?')" style="background-color: #dc2626; color: white;">Fail</button>
                                        </form>
                                    @else
                                        <span class="text-sm text-slate-500">Graded on {{ $enrollment->completed_at ? $enrollment->completed_at->format('M d, Y') : '-' }}</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-slate-500">No students found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
