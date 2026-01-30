<x-public-layout>
    <div class="py-16 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4">
            
            <div class="mb-12 text-center max-w-3xl mx-auto">
                <h1 class="text-5xl font-extrabold text-gray-900 dark:text-white mb-6 tracking-tight">
                    Find Your Next Getaway
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-300 leading-relaxed">
                    Explore handpicked destinations at unbeatable prices. Your adventure starts here.
                </p>
            </div>

            <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl mb-24 border border-gray-100 dark:border-gray-700">
                <form action="{{ route('trips.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-6 items-end">
                    <div class="md:col-span-5">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-200 mb-2">Destination</label>
                        <div class="relative">
                             <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400"></span>
                            <input type="text" name="destination" value="{{ request('destination') }}" 
                                   placeholder="Where are you going?" 
                                   class="w-full pl-10 rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white py-3 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>
                    <div class="md:col-span-3">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-200 mb-2">Max Price</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400"></span>
                            <input type="number" name="price" value="{{ request('price') }}" 
                                   placeholder="Budget limit" 
                                   class="w-full pl-10 rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white py-3 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>
                    <div class="md:col-span-4 flex gap-4">
                        <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-xl transition shadow-md text-lg">
                            Search Trips
                        </button>
                        @if(request()->has('destination') || request()->has('price'))
                            <a href="{{ route('trips.index') }}" class="flex items-center justify-center px-6 border-2 border-gray-300 dark:border-gray-600 rounded-xl text-gray-500 dark:text-gray-400 hover:border-red-500 hover:text-red-500 transition font-bold">
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach ($trips as $trip)
                    <div class="group bg-white dark:bg-gray-800 rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 dark:border-gray-700 flex flex-col h-full hover:-translate-y-2">
                        
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ asset($trip->image_url) }}" alt="{{ $trip->destination }}" loading="lazy"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute top-4 right-4 bg-white/95 dark:bg-gray-900/95 text-gray-900 dark:text-white text-sm font-black px-4 py-2 rounded-full shadow-sm">
                                ${{ intval($trip->price) }}
                            </div>
                        </div>
                        
                        <div class="p-8 flex-1 flex flex-col">
                            <div class="flex items-center gap-2 text-sm text-indigo-600 dark:text-indigo-400 font-bold mb-3">
                                📅 {{ \Carbon\Carbon::parse($trip->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($trip->end_date)->format('M d, Y') }}
                            </div>
                            
                            <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-3 leading-tight">
                                {{ $trip->destination }}
                            </h2>
                            
                            <p class="text-gray-600 dark:text-gray-300 text-base mb-6 line-clamp-2 flex-1">
                                {{ $trip->description }}
                            </p>

                            <a href="{{ route('trips.show', $trip) }}" class="block w-full text-center bg-gray-100 dark:bg-gray-700/50 text-gray-900 dark:text-white font-bold py-4 rounded-2xl hover:bg-indigo-600 hover:text-white dark:hover:bg-indigo-600 transition-colors duration-300">
                                View Details &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-16">
                {{ $trips->links() }}
            </div>
        </div>
    </div>
</x-public-layout>