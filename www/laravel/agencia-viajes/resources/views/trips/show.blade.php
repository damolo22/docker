<x-public-layout>
    <div class="bg-gray-50 dark:bg-gray-900 min-h-screen font-sans">
        
        <div class="bg-indigo-700 dark:bg-gray-800 py-8 px-4 sm:px-6 lg:px-8 text-center shadow-md relative z-10">
            <h1 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl mb-2">
                Find Your Next Adventure
            </h1>

            <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg p-2">
                <form action="{{ route('trips.index') }}" method="GET" class="flex flex-col sm:flex-row gap-2">
                    <input type="text" name="destination" value="{{ request('destination') }}" 
                           placeholder="Destination (e.g. Bali)" 
                           class="flex-1 border-transparent focus:border-indigo-500 focus:ring-0 text-gray-900 dark:text-white dark:bg-gray-700 rounded-md py-2 text-sm">
                    
                    <input type="number" name="price" value="{{ request('price') }}" 
                           placeholder="Max Price ($)" 
                           class="w-full sm:w-32 border-transparent focus:border-indigo-500 focus:ring-0 text-gray-900 dark:text-white dark:bg-gray-700 rounded-md py-2 text-sm">
                    
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-md transition w-full sm:w-auto text-sm">
                        Search
                    </button>
                </form>
            </div>
            
            @if(request()->has('destination') || request()->has('price'))
                <div class="mt-3">
                    <a href="{{ route('trips.index') }}" class="text-indigo-200 hover:text-white underline text-sm transition">Clear Filters</a>
                </div>
            @endif
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($trips as $trip)
                    <div class="flex flex-col bg-white dark:bg-gray-800 rounded-2xl shadow-md overflow-hidden hover:shadow-2xl transition-shadow duration-300 h-full border border-gray-100 dark:border-gray-700">
                        
                        <div class="h-64 w-full relative overflow-hidden group">
                            <img src="{{ asset($trip->image_url) }}" 
                                 alt="{{ $trip->destination }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            
                            @if($trip->category)
                                <div class="absolute top-3 right-3 z-20">
                                    <span class="bg-white text-indigo-700 text-xs font-black px-3 py-1 rounded-full shadow-lg uppercase tracking-wider border border-gray-200">
                                        {{ $trip->category->name }}
                                    </span>
                                </div>
                            @endif
                            
                            <div class="absolute bottom-0 left-0 bg-indigo-600 text-white px-4 py-1 rounded-tr-xl font-bold z-20">
                                ${{ intval($trip->price) }}
                            </div>
                        </div>

                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex justify-between items-center mb-3">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white truncate">
                                    {{ $trip->destination }}
                                </h3>
                                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">
                                    {{ \Carbon\Carbon::parse($trip->start_date)->diffInDays($trip->end_date) }} Days
                                </span>
                            </div>

                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-3 flex-1">
                                {{ $trip->description }}
                            </p>

                            <div class="border-t border-gray-100 dark:border-gray-700 pt-4 mt-auto">
                                <div class="flex items-center justify-between">
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        📅 {{ \Carbon\Carbon::parse($trip->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($trip->end_date)->format('M d, Y') }}
                                    </div>
                                    <a href="{{ route('trips.show', $trip) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 font-bold text-sm hover:underline">
                                        View Details &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $trips->links() }}
            </div>
        </div>
    </div>
</x-public-layout>