<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <style>
        .admin-checkbox {
            width: 1.2rem;
            height: 1.2rem;
            border-radius: 0.25rem;
            cursor: pointer;
            accent-color: #ef4444;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <form action="{{ route('users.delete.group') }}" method="POST" id="users-mass-delete">
                @csrf
                @method('DELETE')

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('users.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-xl shadow-md transition transform hover:scale-105 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Create New User
                        </a>
                    </div>

                    <div class="p-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" id="selectAll" class="admin-checkbox">
                            <label for="selectAll" class="text-sm font-bold text-gray-700 dark:text-gray-300 cursor-pointer select-none">
                                Select All
                            </label>
                        </div>

                        <button type="submit" onclick="return confirm('⚠️ WARNING: Are you sure you want to delete the selected users?');" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg text-xs uppercase tracking-widest shadow-sm transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Delete Selected
                        </button>
                    </div>

                    <div class="p-6">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-3 w-10">
                                        #
                                    </th>
                                    <th class="px-6 py-3">Name</th>
                                    <th class="px-6 py-3">Email</th>
                                    <th class="px-6 py-3">Role</th>
                                    <th class="px-6 py-3">Registered</th>
                                    <th class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700/50 transition">
                                        
                                        <td class="px-6 py-4">
                                            @if(auth()->id() !== $user->id)
                                                <input type="checkbox" name="ids[]" value="{{ $user->id }}" class="admin-checkbox item-checkbox">
                                            @else
                                                <span class="text-gray-300">🔒</span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $user->name }}</td>
                                        <td class="px-6 py-4">{{ $user->email }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 text-xs rounded-full font-bold {{ $user->rol === 'admin' ? 'bg-purple-100 text-purple-700 border border-purple-200' : 'bg-green-100 text-green-700 border border-green-200' }}">
                                                {{ ucfirst($user->rol) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">{{ $user->created_at->format('d M, Y') }}</td>
                                        <td class="px-6 py-4 flex gap-3">
                                            <a href="{{ route('users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900 font-bold flex items-center gap-1">
                                                 Edit
                                            </a>
                                            
                                            @if(auth()->id() !== $user->id)
                                                <button type="button" 
                                                        onclick="if(confirm('Delete this user?')) { document.getElementById('delete-form-{{ $user->id }}').submit(); }" 
                                                        class="text-red-600 hover:text-red-900 font-bold flex items-center gap-1">
                                                     Delete
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </form>

            @foreach($users as $user)
                @if(auth()->id() !== $user->id)
                    <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user) }}" method="POST" style="display: none;">
                        @csrf @method('DELETE')
                    </form>
                @endif
            @endforeach

        </div>
    </div>

    <script>
        document.getElementById('selectAll')?.addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('.item-checkbox');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });
    </script>
</x-app-layout>