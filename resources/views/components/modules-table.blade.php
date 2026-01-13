<div class="bg-white rounded-2xl shadow-sm border border-gray-100">
    <div class="px-6 py-4 border-b flex items-center justify-between">
        <h2 class="text-xl font-bold">Modules</h2>
        <button onclick="document.getElementById('addModuleModal').showModal()" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg text-sm">+ Add Module</button>
    </div>
    <div class="p-6">
        <table class="w-full">
            <thead>
                <tr class="border-b">
                    <th class="text-left py-3 px-4 text-xs font-semibold text-gray-600 uppercase">Module</th>
                    <th class="text-left py-3 px-4 text-xs font-semibold text-gray-600 uppercase">Status</th>
                    <th class="text-left py-3 px-4 text-xs font-semibold text-gray-600 uppercase">Teachers</th>
                    <th class="text-left py-3 px-4 text-xs font-semibold text-gray-600 uppercase">Enrollments</th>
                    <th class="text-right py-3 px-4 text-xs font-semibold text-gray-600 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($modules as $module)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4 text-sm font-medium">{{ $module->module }}</td>
                    <td class="py-3 px-4">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $module->is_available ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $module->is_available ? 'Available' : 'Unavailable' }}
                        </span>
                    </td>
                    <td class="py-3 px-4 text-sm">
                        @forelse($module->teachers as $teacher)
                            <span class="block">{{ $teacher->name }}</span>
                        @empty
                            <span class="text-gray-400 italic">No teacher</span>
                        @endforelse
                    </td>
                    <td class="py-3 px-4 text-sm text-gray-600">{{ $module->enrollments->count() }}/10</td>
                    <td class="py-3 px-4 text-right">
                        <form action="{{ route('admin.modules.toggle', $module) }}" method="POST" class="inline-block mr-2">
                            @csrf
                            @method('PATCH')
                            <button class="text-sm {{ $module->is_available ? 'text-orange-600 hover:text-orange-800' : 'text-green-600 hover:text-green-800' }}">
                                {{ $module->is_available ? 'Archive' : 'Activate' }}
                            </button>
                        </form>
                        <button onclick="openAssignTeacherModal({{ $module->id }})" class="text-sm text-blue-600 hover:text-blue-800">Assign</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">{{ $modules->links() }}</div>
    </div>
</div>
