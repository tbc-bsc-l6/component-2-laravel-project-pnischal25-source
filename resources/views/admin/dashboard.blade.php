<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <style>
        /* Make text selection highly visible in tables */
        table td::selection,
        table th::selection,
        table td *::selection,
        table th *::selection {
            background-color: #1e40af !important; /* Blue-800 */
            color: white !important;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-16">
            
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Teachers Stats -->
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200 relative overflow-hidden group hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                    <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-all duration-300 group-hover:scale-110">
                        <svg class="w-24 h-24 text-purple-600" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                    </div>
                    <h3 class="text-sm font-semibold text-purple-600 uppercase tracking-wider relative z-10">Total Teachers</h3>
                    <div class="mt-3 flex items-baseline gap-2 relative z-10">
                        <span class="text-5xl font-bold text-gray-800">{{ $stats['teachers'] }}</span>
                    </div>
                </div>

                <!-- Students Stats -->
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200 relative overflow-hidden group hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                    <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-all duration-300 group-hover:scale-110">
                        <svg class="w-24 h-24 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                    </div>
                    <h3 class="text-sm font-semibold text-blue-600 uppercase tracking-wider relative z-10">Total Students</h3>
                    <div class="mt-3 flex items-baseline gap-2 relative z-10">
                        <span class="text-5xl font-bold text-gray-800">{{ $stats['students'] }}</span>
                    </div>
                </div>

                <!-- Modules Stats -->
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200 relative overflow-hidden group hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                    <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-all duration-300 group-hover:scale-110">
                        <svg class="w-24 h-24 text-orange-600" fill="currentColor" viewBox="0 0 20 20"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path></svg>
                    </div>
                    <h3 class="text-sm font-semibold text-orange-600 uppercase tracking-wider relative z-10">Active Modules</h3>
                    <div class="mt-3 flex items-baseline gap-2 relative z-10">
                        <span class="text-5xl font-bold text-gray-800">{{ $stats['modules'] }}</span>
                    </div>
                </div>
            </div>

            <!-- Management Section -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-200" x-data="{ activeTab: 'teachers' }">
                <!-- Alert Messages -->
                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 m-4" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 m-4" role="alert">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif
                @if($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 m-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Tabs -->
                <div class="flex border-b border-gray-200">
                    <button @click="activeTab = 'teachers'" :class="{'border-purple-500 text-purple-600 bg-purple-50': activeTab === 'teachers', 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50': activeTab !== 'teachers'}" class="flex-1 py-4 px-6 text-center border-b-2 font-medium transition-all duration-200 focus:outline-none">
                        Teachers
                    </button>
                    <button @click="activeTab = 'students'" :class="{'border-blue-500 text-blue-600 bg-blue-50': activeTab === 'students', 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50': activeTab !== 'students'}" class="flex-1 py-4 px-6 text-center border-b-2 font-medium transition-all duration-200 focus:outline-none">
                        Students
                    </button>
                    <button @click="activeTab = 'modules'" :class="{'border-orange-500 text-orange-600 bg-orange-50': activeTab === 'modules', 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50': activeTab !== 'modules'}" class="flex-1 py-4 px-6 text-center border-b-2 font-medium transition-all duration-200 focus:outline-none">
                        Modules
                    </button>
                </div>

                <div class="p-6">
                    <!-- Search Filter -->
                    <form method="GET" action="{{ route('admin.dashboard') }}" class="mb-6">
                        <div class="relative max-w-md">
                            <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}" class="w-full bg-white text-gray-900 rounded-xl border-2 border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/30 pl-10 pr-4 py-3 transition-all duration-300">
                            <div class="absolute left-3 top-2.5 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                        </div>
                    </form>

                    <!-- Teachers Tab -->
                    <div x-show="activeTab === 'teachers'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-800">Manage Teachers</h3>
                            <!-- Add Teacher Modal Trigger -->
                            <button onclick="document.getElementById('addTeacherModal').showModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-bold shadow-lg hover:shadow-xl transition-all duration-200">
                                + Add Teacher
                            </button>
                        </div>
                        <div class="overflow-x-auto border-2 border-gray-100 rounded-xl">
                            <table class="w-full text-left">
                                <thead class="bg-gradient-to-r from-teal-500 to-cyan-500 uppercase text-xs text-black">
                                    <tr>
                                        <th class="px-6 py-4 font-bold border-r border-black/10">Name</th>
                                        <th class="px-6 py-4 font-bold border-r border-black/10">Email</th>
                                        <th class="px-6 py-4 font-bold border-r border-black/10">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach($teachers as $index => $teacher)
                                    @php $isEvenRow = $index % 2 === 0; @endphp
                                    <tr class="hover:bg-purple-200/70 transition-colors {{ $isEvenRow ? 'bg-purple-100' : 'bg-purple-50' }}">
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ $teacher->name }}</td>
                                        <td class="px-6 py-4 text-gray-800">{{ $teacher->email }}</td>
                                        <td class="px-6 py-4 text-gray-800">
                                            <form action="{{ route('admin.users.destroy', $teacher) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-red-600 hover:text-red-800 font-semibold">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $teachers->appends(['activeTab' => 'teachers'])->links() }}
                        </div>
                    </div>

                    <!-- Students Tab -->
                    <div x-show="activeTab === 'students'" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Manage Students</h3>
                        <div class="overflow-x-auto border-2 border-gray-100 rounded-xl">
                            <table class="w-full text-left">
                                <thead class="bg-gray-900 uppercase text-xs text-black">
                                    <tr>
                                        <th class="px-6 py-4 font-bold border-r border-black/10">Name</th>
                                        <th class="px-6 py-4 font-bold border-r border-black/10">Email</th>
                                        <th class="px-6 py-4 font-bold border-r border-black/10">Role</th>
                                        <th class="px-6 py-4 font-bold border-r border-black/10">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-black">
                                    @foreach($students as $index => $student)
                                    @php $isEvenRow = $index % 2 === 0; @endphp
                                    <tr class="hover:bg-blue-200/70 transition-colors {{ $isEvenRow ? 'bg-blue-100' : 'bg-blue-50' }}">
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ $student->name }}</td>
                                        <td class="px-6 py-4 text-gray-800">{{ $student->email }}</td>
                                        <td class="px-6 py-4 text-gray-800">
                                            <span class="px-2 py-1 rounded text-xs font-semibold {{ $student->userRole->role === 'Student' ? 'bg-blue-200 text-blue-900' : 'bg-gray-200 text-gray-900' }}">
                                                {{ $student->userRole->role }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-gray-800">
                                            <form action="{{ route('admin.users.updateRole', $student) }}" method="POST" class="inline-block mr-2">
                                                @csrf
                                                @method('PATCH')
                                                <select name="role_id" onchange="this.form.submit()" class="bg-white border-gray-300 text-gray-700 text-sm rounded focus:ring-blue-500 focus:border-blue-500 p-1">
                                                    @foreach($roles as $role)
                                                        @if(in_array($role->role, ['Student', 'Old Student']))
                                                            <option value="{{ $role->id }}" {{ $student->user_role_id == $role->id ? 'selected' : '' }}>
                                                                {{ $role->role }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </form>
                                            <form action="{{ route('admin.users.destroy', $student) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-red-600 hover:text-red-800 font-semibold">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $students->appends(['activeTab' => 'students'])->links() }}
                        </div>
                    </div>

                    <!-- Modules Tab -->
                    <div x-show="activeTab === 'modules'" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-800">Manage Modules</h3>
                            <button onclick="document.getElementById('addModuleModal').showModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-bold shadow-lg hover:shadow-xl transition-all duration-200">
                                + Add Module
                            </button>
                        </div>
                        <div class="overflow-x-auto border-2 border-gray-100 rounded-xl">
                            <table class="w-full text-left">
                                <thead class="bg-gray-900 uppercase text-xs text-black">
                                    <tr>
                                        <th class="px-6 py-4 font-bold border-r border-black/10">Module Name</th>
                                        <th class="px-6 py-4 font-bold border-r border-black/10">Status</th>
                                        <th class="px-6 py-4 font-bold border-r border-black/10">Teachers</th>
                                        <th class="px-6 py-4 font-bold border-r border-black/10">Enrollments</th>
                                        <th class="px-6 py-4 font-bold border-r border-black/10">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach($modules as $index => $module)
                                    @php $isEvenRow = $index % 2 === 0; @endphp
                                    <tr class="hover:bg-orange-200/70 transition-colors {{ $isEvenRow ? 'bg-orange-100' : 'bg-orange-50' }}">
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ $module->module }}</td>
                                        <td class="px-6 py-4 text-gray-800">
                                            <span class="px-2 py-1 rounded text-xs font-semibold {{ $module->is_available ? 'bg-green-200 text-green-900' : 'bg-red-200 text-red-900' }}">
                                                {{ $module->is_available ? 'Available' : 'Unavailable' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-xs text-gray-800">
                                            @forelse($module->teachers as $teacher)
                                                <div class="flex items-center justify-between py-1">
                                                    <span class="block">{{ $teacher->name }}</span>
                                                    <form action="{{ route('admin.modules.unassignTeacher') }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Unassign this teacher from the module?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="module_id" value="{{ $module->id }}">
                                                        <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                                                        <button class="text-red-600 hover:text-red-800 text-sm font-bold hover:bg-red-50 px-1 rounded">✕</button>
                                                    </form>
                                                </div>
                                            @empty
                                                <span class="text-gray-400 italic">No teacher</span>
                                            @endforelse
                                        </td>
                                        <td class="px-6 py-4 text-gray-800">{{ $module->enrollments->count() }}/10</td>
                                        <td class="px-6 py-4 space-x-2 text-gray-800">
                                            <!-- Toggle Availability -->
                                            <form action="{{ route('admin.modules.toggle', $module) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <button class="px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wider transition-all duration-300 shadow-md hover:shadow-lg text-white" style="background-color: {{ $module->is_available ? '#dc2626' : '#16a34a' }}; color: white;">
                                                    {{ $module->is_available ? 'Archive' : 'Activate' }}
                                                </button>
                                            </form>
                                            
                                            <!-- Assign Teacher -->
                                            <button onclick="openAssignTeacherModal({{ $module->id }})" class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-bold uppercase tracking-wider shadow-md hover:shadow-lg transition-all duration-300">
                                                Assign Teacher
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $modules->appends(['activeTab' => 'modules'])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Teacher Modal -->
    <dialog id="addTeacherModal" class="modal bg-gray-900/50 backdrop-blur-sm">
        <div class="bg-white p-6 rounded-xl w-full max-w-md shadow-2xl max-h-[85vh] overflow-y-auto">
            <h3 class="font-bold text-lg mb-4 text-gray-900">Add New Teacher</h3>
            <form method="POST" action="{{ route('admin.teachers.store') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" required class="w-full border-gray-300 rounded-lg mt-1 focus:ring-purple-500 focus:border-purple-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" required class="w-full border-gray-300 rounded-lg mt-1 focus:ring-purple-500 focus:border-purple-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" required class="w-full border-gray-300 rounded-lg mt-1 focus:ring-purple-500 focus:border-purple-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                        <input type="password" name="password_confirmation" required class="w-full border-gray-300 rounded-lg mt-1 focus:ring-purple-500 focus:border-purple-500">
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-2">
                    <button type="button" onclick="document.getElementById('addTeacherModal').close()" class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-medium transition-colors">Cancel</button>
                    <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-purple-600 to-purple-500 hover:from-purple-500 hover:to-purple-400 text-black rounded-lg font-semibold shadow-lg shadow-purple-500/50 transition-all">Create</button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- Add Module Modal -->
    <dialog id="addModuleModal" class="modal bg-gray-900/50 backdrop-blur-sm">
        <div class="bg-white p-6 rounded-xl w-full max-w-md shadow-2xl max-h-[85vh] overflow-y-auto">
            <h3 class="font-bold text-lg mb-4 text-gray-900">Add New Module</h3>
            <form method="POST" action="{{ route('admin.modules.store') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Module Name</label>
                        <input type="text" name="module" required class="w-full border-gray-300 rounded-lg mt-1 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-2">
                    <button type="button" onclick="document.getElementById('addModuleModal').close()" class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-medium transition-colors">Cancel</button>
                    <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-500 hover:to-orange-400 text-white rounded-lg font-semibold shadow-lg shadow-orange-500/50 transition-all" style="color: black; text-shadow: 0 1px 2px rgba(0,0,0,0.1);">Create</button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- Assign Teacher Modal -->
    <dialog id="assignTeacherModal" class="modal bg-gray-900/50 backdrop-blur-sm">
        <div class="bg-white p-6 rounded-xl w-full max-w-md shadow-2xl max-h-[85vh] overflow-y-auto">
            <h3 class="font-bold text-lg mb-4 text-gray-900">Assign Teacher to Module</h3>
            <form method="POST" action="{{ route('admin.modules.assignTeacher') }}">
                @csrf
                <input type="hidden" name="module_id" id="assignModuleId">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Select Teacher</label>
                        <select name="teacher_id" class="w-full border-gray-300 rounded-lg mt-1 focus:ring-blue-500 focus:border-blue-500">
                            @foreach(\App\Models\User::whereHas('userRole', fn($q) => $q->where('role', 'Teacher'))->get() as $t)
                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-2">
                    <button type="button" onclick="document.getElementById('assignTeacherModal').close()" class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-medium transition-colors">Cancel</button>
                    <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-black rounded-lg font-semibold shadow-lg shadow-blue-500/50 transition-all">Assign</button>
                </div>
            </form>
        </div>
    </dialog>

    <script>
        function openAssignTeacherModal(moduleId) {
            document.getElementById('assignModuleId').value = moduleId;
            document.getElementById('assignTeacherModal').showModal();
        }
    </script>
</x-app-layout>
