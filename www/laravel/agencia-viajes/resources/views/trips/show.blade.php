<x-public-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <nav class="mb-8">
                <a href="{{ route('trips.index') }}" class="inline-flex items-center text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Back to all trips
                </a>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                
                <div class="lg:col-span-2">
                    <div class="relative h-[400px] md:h-[500px] rounded-3xl overflow-hidden shadow-2xl mb-10">
                        <img src="{{ asset($trip->image_url) }}" alt="{{ $trip->destination }}" class="w-full h-full object-cover">
                    </div>

                    <div class="mb-8">
                        <h1 class="text-4xl md:text-5xl font-black text-gray-900 dark:text-white mb-6 tracking-tight">
                            {{ $trip->destination }}
                        </h1>
                        
                        <div class="flex flex-wrap gap-4 mb-8">
                            <div class="inline-flex items-center bg-indigo-50 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-300 px-4 py-2 rounded-xl font-bold">
                                📅 Start: {{ \Carbon\Carbon::parse($trip->start_date)->format('M d, Y') }}
                            </div>
                            <div class="inline-flex items-center bg-indigo-50 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-300 px-4 py-2 rounded-xl font-bold">
                                🏁 End: {{ \Carbon\Carbon::parse($trip->end_date)->format('M d, Y') }}
                            </div>
                        </div>
                    </div>

                    <div class="prose dark:prose-invert max-w-none prose-lg prose-indigo">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">About this trip</h3>
                        <p class="leading-relaxed whitespace-pre-line text-gray-600 dark:text-gray-300">
                            {{ $trip->description }}
                        </p>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="sticky top-8 bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-200 dark:border-gray-700 shadow-xl">
                        <div class="mb-8">
                            <p class="text-sm font-bold text-gray-500 dark:text-gray-400 mb-1 uppercase tracking-wider">Total Price</p>
                            <div class="flex items-baseline gap-2">
                                <span class="text-5xl font-black text-gray-900 dark:text-white">${{ intval($trip->price) }}</span>
                                <span class="text-gray-500 font-medium">USD</span>
                            </div>
                        </div>

                        @auth
                            <form action="{{ route('bookings.store', $trip) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-6 rounded-2xl shadow-md transition transform active:scale-95 text-lg flex items-center justify-center gap-3">
                                    Book Now 
                                </button>
                            </form>
                            <p class="text-center text-sm text-gray-500 mt-4 font-medium">Immediate confirmation</p>
                        @else
                            <div class="bg-gray-50 dark:bg-gray-700/50 p-6 rounded-2xl text-center border border-gray-200 dark:border-gray-600">
                                <p class="text-gray-900 dark:text-white mb-4 font-bold text-lg">Ready to travel?</p>
                                <a href="{{ route('login') }}" class="block w-full bg-white dark:bg-gray-800 text-indigo-600 dark:text-indigo-400 font-bold py-3 rounded-xl border-2 border-indigo-100 dark:border-indigo-900 hover:border-indigo-600 transition">
                                    Sign In to Book
                                </a>
                            </div>
                        @endauth
                        
                        <div class="mt-8 pt-8 border-t border-gray-100 dark:border-gray-700">
                            <ul class="space-y-3 text-sm text-gray-500 dark:text-gray-400 font-medium">
                                <li class="flex items-center"> Best price guaranteed</li>
                                <li class="flex items-center"> No hidden fees</li>
                                <li class="flex items-center"> Secure payment</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-public-layout>