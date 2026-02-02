<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Trip ✏️') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl p-8 border border-gray-100 dark:border-gray-700">
                
                <form action="{{ route('trips.update', $trip) }}" method="POST">
                    @csrf
                    @method('PUT') <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Destination</label>
                            <input type="text" name="destination" value="{{ old('destination', $trip->destination) }}" 
                                   class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500" required>
                            @error('destination') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Price ($)</label>
                            <input type="number" name="price" value="{{ old('price', $trip->price) }}" step="0.01"
                                   class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500" required>
                            @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Category</label>
                            <select name="category_id" class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $trip->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Start Date</label>
                            <input type="date" name="start_date" value="{{ old('start_date', \Carbon\Carbon::parse($trip->start_date)->format('Y-m-d')) }}"
                                   class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">End Date</label>
                            <input type="date" name="end_date" value="{{ old('end_date', \Carbon\Carbon::parse($trip->end_date)->format('Y-m-d')) }}"
                                   class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500" required>
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Description</label>
                        <textarea name="description" rows="6" 
                                  class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500" required>{{ old('description', $trip->description) }}</textarea>
                    </div>

                    <div class="flex items-center justify-end gap-4">
                        <a href="{{ route('trips.show', $trip) }}" class="text-gray-600 dark:text-gray-400 hover:underline font-medium">Cancel</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition transform hover:scale-105">
                            Update Trip
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>