<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Review
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl p-8 border border-gray-100 dark:border-gray-700">
                
                <div class="mb-6 flex items-center gap-4">
                    <img src="{{ asset($review->trip->image_url) }}" class="w-16 h-16 rounded-xl object-cover">
                    <div>
                        <h3 class="font-bold text-gray-900 dark:text-white">{{ $review->trip->destination }}</h3>
                        <p class="text-sm text-gray-500">Updating your experience</p>
                    </div>
                </div>

                <form action="{{ route('reviews.update', $review) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Rating</label>
                        <select name="rating" class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white py-3 px-4 focus:ring-indigo-500 focus:border-indigo-500">
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>
                                    {{ $i }} ⭐ {{ $i == 5 ? '- Amazing' : ($i == 1 ? '- Terrible' : '') }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Your Experience</label>
                        <textarea name="content" rows="4" class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white py-3 px-4 focus:ring-indigo-500 focus:border-indigo-500" required>{{ old('content', $review->content) }}</textarea>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700">
                        <form action="{{ route('reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('Delete this review?');" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-bold flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Delete Review
                            </button>
                        </form>

                        <div class="flex gap-3">
                            <a href="{{ route('trips.show', $review->trip) }}" class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-gray-900 font-bold text-sm">Cancel</a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-xl shadow-lg transition transform hover:scale-105">
                                Update Review
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>