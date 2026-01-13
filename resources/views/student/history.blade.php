<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <h2 class="font-semibold text-2xl text-white leading-tight">
                {{ __('My History') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3 class="text-xl font-bold mb-6 text-slate-900 uppercase tracking-wider">Completed Modules</h3>

            <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-slate-600">
                        <thead class="bg-slate-50 uppercase text-xs text-slate-500 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 font-semibold">Module Name</th>
                                <th class="px-6 py-4 font-semibold">Completed Date</th>
                                <th class="px-6 py-4 font-semibold">Result</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($history as $enrollment)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-slate-900">{{ $enrollment->module->module }}</td>
                                <td class="px-6 py-4">{{ $enrollment->completed_at ? $enrollment->completed_at->format('M d, Y') : '-' }}</td>
                                <td class="px-6 py-4">
                                     @if($enrollment->status === 'pass')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            PASS
                                        </span>
                                    @elseif($enrollment->status === 'fail')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-200">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                                            FAIL
                                        </span>
                                    @else
                                        <span class="text-slate-400">Pending</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-slate-500">No completed modules found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            @if(auth()->user()->userRole->role === 'Old Student')
            <div class="mt-8 p-6 bg-blue-50 border border-blue-200 rounded-lg shadow-sm">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <p class="text-blue-700 text-sm">You are currently viewing this page as an Old Student. Access is limited to history only.</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
