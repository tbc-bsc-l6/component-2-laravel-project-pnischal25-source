<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Teachers Stats -->
                <div class="bg-white/80 backdrop-blur-xl p-6 rounded-2xl shadow-lg border border-white/50 relative overflow-hidden group hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                    <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-all duration-300 group-hover:scale-110">
                        <svg class="w-24 h-24 text-purple-600" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                    </div>
                    <h3 class="text-sm font-semibold text-purple-600 uppercase tracking-wider relative z-10">Total Teachers</h3>
                    <div class="mt-3 flex items-baseline gap-2 relative z-10">
                        <span class="text-5xl font-bold text-gray-800">{{ $stats['teachers'] }}</span>
                    </div>
                </div>

                <!-- Students Stats -->
                <div class="bg-white/80 backdrop-blur-xl p-6 rounded-2xl shadow-lg border border-white/50 relative overflow-hidden group hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                    <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-all duration-300 group-hover:scale-110">
                        <svg class="w-24 h-24 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                    </div>
                    <h3 class="text-sm font-semibold text-blue-600 uppercase tracking-wider relative z-10">Total Students</h3>
                    <div class="mt-3 flex items-baseline gap-2 relative z-10">
                        <span class="text-5xl font-bold text-gray-800">{{ $stats['students'] }}</span>
                    </div>
                </div>

                <!-- Modules Stats -->
                <div class="bg-white/80 backdrop-blur-xl p-6 rounded-2xl shadow-lg border border-white/50 relative overflow-hidden group hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
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
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/50 ring-1 ring-black/5" x-data="{ activeTab: 'teachers' }">
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
                            <button onclick="document.getElementById('addTeacherModal').showModal()" class="bg-purple-600 border border-purple-400 hover:bg-purple-500 hover:border-purple-300 text-white px-4 py-2 rounded-lg shadow-[0_0_10px_rgba(168,85,247,0.4)] transition-all duration-300 hover:-translate-y-0.5">
                                + Add Teacher
                            </button>
                        </div>
                        <div class="overflow-x-auto border rounded-xl">
                            <table class="w-full text-left text-gray-600">
                                <thead class="bg-gradient-to-r from-purple-600 to-indigo-600 uppercase text-xs text-white border-b border-indigo-700">
                                    <tr>
                                        <th class="px-6 py-3 font-semibold">Name</th>
                                        <th class="px-6 py-3 font-semibold">Email</th>
                                        <th class="px-6 py-3 font-semibold text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($teachers as $teacher)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ $teacher->name }}</td>
                                        <td class="px-6 py-4">{{ $teacher->email }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <form action="{{ route('admin.users.destroy', $teacher) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-red-500 hover:text-red-700 font-medium ml-2">Remove</button>
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
                        <div class="overflow-x-auto border rounded-xl">
                            <table class="w-full text-left text-gray-600">
                                <thead class="bg-gradient-to-r from-blue-600 to-cyan-600 uppercase text-xs text-white border-b border-blue-700">
                                    <tr>
                                        <th class="px-6 py-3 font-semibold">Name</th>
                                        <th class="px-6 py-3 font-semibold">Email</th>
                                        <th class="px-6 py-3 font-semibold">Role</th>
                                        <th class="px-6 py-3 font-semibold text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($students as $student)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ $student->name }}</td>
                                        <td class="px-6 py-4">{{ $student->email }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 rounded text-xs font-semibold {{ $student->userRole->role === 'Student' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700' }}">
                                                {{ $student->userRole->role }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
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
                                                <button class="text-red-500 hover:text-red-700 font-medium">Remove</button>
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
                            <button onclick="document.getElementById('addModuleModal').showModal()" class="bg-orange-600 border border-orange-400 hover:bg-orange-500 hover:border-orange-300 text-white px-4 py-2 rounded-lg shadow-[0_0_10px_rgba(234,88,12,0.4)] transition-all duration-300 hover:-translate-y-0.5">
                                + Add Module
                            </button>
                        </div>
                        <div class="overflow-x-auto border rounded-xl">
                            <table class="w-full text-left text-gray-600">
                                <thead class="bg-gradient-to-r from-orange-500 to-pink-600 uppercase text-xs text-white border-b border-orange-700">
                                    <tr>
                                        <th class="px-6 py-3 font-semibold">Module Name</th>
                                        <th class="px-6 py-3 font-semibold">Status</th>
                                        <th class="px-6 py-3 font-semibold">Teachers</th>
                                        <th class="px-6 py-3 font-semibold">Enrollments</th>
                                        <th class="px-6 py-3 font-semibold text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($modules as $module)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ $module->module }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 rounded text-xs font-semibold {{ $module->is_available ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                {{ $module->is_available ? 'Available' : 'Unavailable' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-xs">
                                            @forelse($module->teachers as $teacher)
                                                <span class="block">{{ $teacher->name }}</span>
                                            @empty
                                                <span class="text-gray-400 italic">No teacher</span>
                                            @endforelse
                                        </td>
                                        <td class="px-6 py-4">{{ $module->enrollments->count() }}/10</td>
                                        <td class="px-6 py-4 text-right space-x-2">
                                            <!-- Toggle Availability -->
                                            <form action="{{ route('admin.modules.toggle', $module) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <button class="text-sm font-medium underline {{ $module->is_available ? 'text-orange-600 hover:text-orange-800' : 'text-green-600 hover:text-green-800' }}">
                                                    {{ $module->is_available ? 'Archive' : 'Activate' }}
                                                </button>
                                            </form>
                                            
                                            <!-- Assign Teacher -->
                                            <button onclick="openAssignTeacherModal({{ $module->id }})" class="text-sm text-blue-600 hover:text-blue-800 underline font-medium">
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
        <div class="bg-white p-6 rounded-xl w-full max-w-md shadow-2xl">
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
                    <button type="button" onclick="document.getElementById('addTeacherModal').close()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">Create</button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- Add Module Modal -->
    <dialog id="addModuleModal" class="modal bg-gray-900/50 backdrop-blur-sm">
        <div class="bg-white p-6 rounded-xl w-full max-w-md shadow-2xl">
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
                    <button type="button" onclick="document.getElementById('addModuleModal').close()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-orange-600 text-white rounded hover:bg-orange-700">Create</button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- Assign Teacher Modal -->
    <dialog id="assignTeacherModal" class="modal bg-gray-900/50 backdrop-blur-sm">
        <div class="bg-white p-6 rounded-xl w-full max-w-md shadow-2xl">
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
                    <button type="button" onclick="document.getElementById('assignTeacherModal').close()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Assign</button>
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
