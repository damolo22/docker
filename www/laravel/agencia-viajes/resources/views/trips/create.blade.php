<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Trip') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">¡Ups!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl p-8 border border-gray-100 dark:border-gray-700">
                
                <form action="{{ route('trips.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Destination</label>
                            <input type="text" name="destination" value="{{ old('destination') }}" 
                                   class="w-full rounded-xl border-gray-300 dark:bg-gray-700 dark:text-white @error('destination') border-red-500 @enderror" 
                                   required placeholder="e.g. Paris">
                            @error('destination') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Category</label>
                            <select name="category_id" class="w-full rounded-xl border-gray-300 dark:bg-gray-700 dark:text-white @error('category_id') border-red-500 @enderror" required>
                                <option value="" disabled selected>Select a category...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Price ($)</label>
                            <input type="number" name="price" value="{{ old('price') }}" step="0.01"
                                   class="w-full rounded-xl border-gray-300 dark:bg-gray-700 dark:text-white @error('price') border-red-500 @enderror" 
                                   required>
                            @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Start Date</label>
                            <input type="date" name="start_date" value="{{ old('start_date') }}"
                                   class="w-full rounded-xl border-gray-300 dark:bg-gray-700 dark:text-white @error('start_date') border-red-500 @enderror" 
                                   required>
                            @error('start_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">End Date</label>
                            <input type="date" name="end_date" value="{{ old('end_date') }}"
                                   class="w-full rounded-xl border-gray-300 dark:bg-gray-700 dark:text-white @error('end_date') border-red-500 @enderror" 
                                   required>
                            @error('end_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Trip Photo </label>
                        <input type="file" name="image" 
                               class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 @error('image') border-red-500 @enderror" 
                               accept="image/*" required>
                        <p class="mt-1 text-xs text-gray-500">JPG, PNG or WEBP (Max. 2MB)</p>
                        @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Description</label>
                        <textarea name="description" rows="4" 
                                  class="w-full rounded-xl border-gray-300 dark:bg-gray-700 dark:text-white @error('description') border-red-500 @enderror" 
                                  required>{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end gap-4">
                        <a href="{{ route('trips.index') }}" class="px-6 py-3 rounded-xl text-gray-600 dark:text-gray-400 hover:bg-gray-100 font-bold transition">Cancel</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition transform hover:scale-105">
                            Create Trip
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>