<x-public-layout>
    <div class="py-24 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <nav class="mb-16">
                <a href="{{ route('trips.index') }}" class="inline-flex items-center text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition font-bold text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to all trips
                </a>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
                
                <div class="lg:col-span-2">
                    <div class="relative h-[500px] md:h-[600px] rounded-[2.5rem] overflow-hidden shadow-2xl mb-12">
                        <img src="{{ asset($trip->image_url) }}" alt="{{ $trip->destination }}" class="w-full h-full object-cover object-center">
                    </div>

                    <div class="mb-12">
                        @if($trip->category)
                            <div class="mb-4">
                                <span class="inline-flex items-center rounded-full bg-indigo-100 dark:bg-indigo-900/50 px-3 py-1 text-sm font-medium text-indigo-800 dark:text-indigo-300 ring-1 ring-inset ring-indigo-600/20 uppercase tracking-wide">
                                    {{ $trip->category->name }}
                                </span>
                            </div>
                        @endif

                        <h1 class="text-5xl md:text-6xl font-black text-gray-900 dark:text-white mb-8 tracking-tight leading-none">
                            {{ $trip->destination }}
                        </h1>
                        
                        <div class="flex flex-wrap gap-6 mb-10">
                            <div class="inline-flex items-center bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 px-6 py-3 rounded-2xl font-bold text-gray-700 dark:text-gray-200 shadow-sm">
                                <span class="text-gray-400 mr-3 uppercase text-sm tracking-wider font-bold">Check-in</span>
                                {{ \Carbon\Carbon::parse($trip->start_date)->format('M d, Y') }}
                            </div>
                            <div class="inline-flex items-center bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 px-6 py-3 rounded-2xl font-bold text-gray-700 dark:text-gray-200 shadow-sm">
                                <span class="text-gray-400 mr-3 uppercase text-sm tracking-wider font-bold">Check-out</span>
                                {{ \Carbon\Carbon::parse($trip->end_date)->format('M d, Y') }}
                            </div>
                        </div>
                    </div>

                    <div class="prose dark:prose-invert max-w-none prose-lg prose-indigo prose-p:leading-loose prose-headings:font-black">
                        <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">About this trip</h3>
                        <p class="whitespace-pre-line text-gray-600 dark:text-gray-300 text-xl">
                            {{ $trip->description }}
                        </p>
                    </div>

                    <div class="mt-16 border-t border-gray-200 dark:border-gray-700 pt-10">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                            Reviews & Experiences ({{ $trip->reviews->count() }})
                        </h3>

                        <div class="space-y-6 mb-10">
                            @forelse($trip->reviews as $review)
                                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="font-bold text-gray-900 dark:text-white">{{ $review->user->name }}</div>
                                        <div class="text-yellow-400 text-sm">
                                            @for($i=0; $i < $review->rating; $i++) ★ @endfor
                                        </div>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-300">{{ $review->content }}</p>
                                    <div class="text-xs text-gray-400 mt-2">{{ $review->created_at->diffForHumans() }}</div>
                                </div>
                            @empty
                                <p class="text-gray-500 italic">No reviews yet. Be the first!</p>
                            @endforelse
                        </div>

                        @auth
                            @if(Auth::user()->hasBooked($trip->id))
                                <div class="bg-indigo-50 dark:bg-gray-800 p-8 rounded-3xl border border-indigo-100 dark:border-indigo-900">
                                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Leave a Review</h4>
                                    
                                    <form action="{{ route('reviews.store', $trip) }}" method="POST">
                                        @csrf
                                        
                                        <div class="mb-4">
                                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Rating</label>
                                            <select name="rating" class="w-full rounded-xl border-gray-300 dark:bg-gray-700 dark:text-white py-3">
                                                <option value="5">⭐⭐⭐⭐⭐ - Amazing</option>
                                                <option value="4">⭐⭐⭐⭐ - Good</option>
                                                <option value="3">⭐⭐⭐ - Average</option>
                                                <option value="2">⭐⭐ - Poor</option>
                                                <option value="1">⭐ - Terrible</option>
                                            </select>
                                        </div>

                                        <div class="mb-4">
                                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Your Experience</label>
                                            <textarea name="content" rows="3" class="w-full rounded-xl border-gray-300 dark:bg-gray-700 dark:text-white" placeholder="Tell us about your trip..." required></textarea>
                                        </div>

                                        <button type="submit" class="bg-indigo-600 text-white font-bold py-3 px-8 rounded-xl hover:bg-indigo-700 transition w-full md:w-auto">
                                            Submit Review
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="sticky top-12 bg-white dark:bg-gray-800 p-10 rounded-[2.5rem] border border-gray-200 dark:border-gray-700 shadow-[0_35px_60px_-15px_rgba(0,0,0,0.1)] dark:shadow-none">
                        <div class="mb-10">
                            <p class="text-sm font-bold text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-widest">Total Price</p>
                            <div class="flex items-baseline gap-3">
                                <span class="text-6xl font-black text-gray-900 dark:text-white tracking-tight">${{ intval($trip->price) }}</span>
                                <span class="text-xl text-gray-500 font-bold">USD</span>
                            </div>
                        </div>

                        @auth
                            <form action="{{ route('bookings.store', $trip) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-5 px-8 rounded-2xl shadow-xl transition transform active:scale-95 text-xl flex items-center justify-center hover:shadow-2xl">
                                    Book Now
                                </button>
                            </form>
                            <p class="text-center text-sm text-gray-500 mt-6 font-bold uppercase tracking-wider">Immediate confirmation</p>
                        @else
                            <div class="bg-gray-50 dark:bg-gray-700/30 p-8 rounded-3xl text-center border-2 border-dashed border-gray-200 dark:border-gray-600">
                                <p class="text-gray-900 dark:text-white mb-6 font-black text-xl">Ready to travel?</p>
                                <a href="{{ route('login') }}" class="block w-full bg-white dark:bg-gray-800 text-indigo-600 dark:text-indigo-400 font-black py-4 rounded-2xl border-2 border-indigo-100 dark:border-indigo-900 hover:border-indigo-600 dark:hover:border-indigo-400 transition text-lg shadow-sm hover:shadow-md">
                                    Sign In to Book
                                </a>
                            </div>
                        @endauth
                        
                        <div class="mt-10 pt-10 border-t-2 border-gray-100 dark:border-gray-700">
                            <ul class="space-y-5 text-base text-gray-600 dark:text-gray-300 font-bold">
                                <li class="flex items-center">
                                    <svg class="w-6 h-6 text-green-500 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    Best price guaranteed
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-6 h-6 text-green-500 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    No hidden fees
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-6 h-6 text-green-500 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    Secure payment
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-public-layout>