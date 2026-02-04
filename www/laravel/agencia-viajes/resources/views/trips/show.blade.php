<x-public-layout>
    <style>
        .star-gold { color: #fbbf24; filter: drop-shadow(0 0 2px rgba(251, 191, 36, 0.5)); }
        .star-gray { color: #e5e7eb; }
        
        .btn-force-edit {
            background: linear-gradient(135deg, #fcd34d 0%, #f59e0b 100%) !important;
            color: #78350f !important; 
            border: none !important;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4) !important;
        }
        .btn-force-edit:hover {
            transform: translateY(-2px) !important;
            filter: brightness(105%);
        }
        .btn-force-primary {
            background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%) !important;
            color: #ffffff !important;
            border: none !important;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4) !important;
            transition: all 0.3s ease !important;
        }
        .btn-force-primary:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.6) !important;
        }

        .btn-force-danger {
            background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%) !important;
            color: white !important;
            border: none !important;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4) !important;
        }
        .btn-force-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.6) !important;
        }

        .tag-category {
            background-color: #f3f4f6 !important;
            color: #4f46e5 !important;
            letter-spacing: 0.05em;
        }
    </style>

    <div class="py-16 bg-gray-50 dark:bg-gray-900 min-h-screen font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <nav class="mb-12">
                <a href="{{ route('trips.index') }}" class="inline-flex items-center text-sm font-bold text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to all trips
                </a>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-20">
                
                <div class="lg:col-span-2">
                    
                    <div class="relative h-[450px] md:h-[550px] rounded-[2rem] overflow-hidden shadow-2xl mb-10">
                        <img src="{{ asset($trip->image_url) }}" alt="{{ $trip->destination }}" class="w-full h-full object-cover object-center transform hover:scale-105 transition duration-700">
                    </div>
@auth
                        @if(Auth::user()->rol == 'admin')
                            <div class="flex items-center justify-between mb-8 p-4 bg-gray-100 dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-500 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    Admin Controls
                                </span>
                                
                                <div class="flex gap-3">
                                    <a href="{{ route('trips.edit', $trip) }}" class="btn-force-edit py-2 px-4 rounded-xl font-bold text-sm flex items-center gap-2 transition transform hover:scale-105">
                                        Edit
                                    </a>

                                    <form action="{{ route('trips.destroy', $trip) }}" method="POST" onsubmit="return confirm('⚠️ Are you sure? This cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-force-danger py-2 px-4 rounded-xl font-bold text-sm text-white flex items-center gap-2 transition transform hover:scale-105">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endauth

                    <div class="mb-12">
                        @if($trip->category)
                            <div class="mb-4">
                                <span class="tag-category inline-flex items-center rounded-full px-4 py-1.5 text-xs font-black uppercase tracking-widest shadow-sm">
                                    {{ $trip->category->name }}
                                </span>
                            </div>
                        @endif

                        <h1 class="text-5xl md:text-6xl font-black text-gray-900 dark:text-white mb-8 tracking-tight leading-none">
                            {{ $trip->destination }}
                        </h1>
                        
                        <div class="flex flex-wrap gap-5 mb-10">
                            <div class="flex items-center bg-white dark:bg-gray-800 px-6 py-4 rounded-2xl shadow-sm">
                                <div class="bg-indigo-50 dark:bg-indigo-900/50 p-2.5 rounded-xl mr-4 text-indigo-600 dark:text-indigo-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <span class="block text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Check-in</span>
                                    <span class="text-lg font-bold text-gray-800 dark:text-white">{{ \Carbon\Carbon::parse($trip->start_date)->format('M d, Y') }}</span>
                                </div>
                            </div>
                            <div class="flex items-center bg-white dark:bg-gray-800 px-6 py-4 rounded-2xl shadow-sm">
                                <div class="bg-indigo-50 dark:bg-indigo-900/50 p-2.5 rounded-xl mr-4 text-indigo-600 dark:text-indigo-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <span class="block text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Check-out</span>
                                    <span class="text-lg font-bold text-gray-800 dark:text-white">{{ \Carbon\Carbon::parse($trip->end_date)->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="prose dark:prose-invert max-w-none prose-lg text-gray-600 dark:text-gray-300">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">About this trip</h3>
                        <p class="whitespace-pre-line text-lg leading-relaxed">
                            {{ $trip->description }}
                        </p>
                    </div>

                    <div class="mt-16 border-t border-gray-100 dark:border-gray-800 pt-12">
                        <div class="flex items-center gap-4 mb-8">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Reviews</h3>
                            <span class="bg-indigo-100 text-indigo-800 text-xs font-bold px-3 py-1 rounded-full dark:bg-indigo-900 dark:text-indigo-300">
                                {{ $trip->reviews->count() }}
                            </span>
                        </div>

                        <div class="space-y-6 mb-12">
                            @forelse($trip->reviews as $review)
                                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 relative group">
                                    
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="font-bold text-lg text-gray-900 dark:text-white flex items-center gap-3">
                                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900 dark:to-purple-900 flex items-center justify-center text-indigo-700 dark:text-indigo-300 font-bold">
                                                {{ substr($review->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                {{ $review->user->name }}
                                                <div class="text-xs text-gray-400 font-normal">{{ $review->created_at->diffForHumans() }}</div>
                                            </div>
                                        </div>
                                        <div class="flex text-lg">
                                            @for($i=0; $i < 5; $i++)
                                                @if($i < $review->rating) <span class="star-gold">★</span>
                                                @else <span class="star-gray">★</span> @endif
                                            @endfor
                                        </div>
                                    </div>

                                    <p class="text-gray-600 dark:text-gray-300 italic mb-2">"{{ $review->content }}"</p>

                                   @auth
                                        @if(Auth::id() === $review->user_id || Auth::user()->rol === 'admin')
                                            <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-700 flex justify-end gap-3">
                                                
                                                <a href="{{ route('reviews.edit', $review) }}" class="btn-force-edit text-xs font-bold py-1.5 px-4 rounded-lg shadow-sm flex items-center gap-1 transition transform hover:scale-105">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                    Edit
                                                </a>

                                                <form action="{{ route('reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('⚠️ Are you sure you want to delete this review?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-force-danger text-xs font-bold py-1.5 px-4 rounded-lg shadow-sm flex items-center gap-1 transition transform hover:scale-105">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                        Delete
                                                    </button>
                                                </form>

                                            </div>
                                        @endif
                                    @endauth
                                </div> 
                            @empty
                                <div class="text-center py-10 bg-gray-50 dark:bg-gray-800/30 rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-700">
                                    <p class="text-gray-500 font-medium">No reviews yet.</p>
                                </div>
                            @endforelse
                        </div>

                        @auth
                            @if(Auth::user()->hasBooked($trip->id))
                                <div class="bg-gradient-to-br from-indigo-50 to-white dark:from-gray-800 dark:to-gray-900 p-8 rounded-3xl shadow-lg border border-indigo-50 dark:border-gray-700">
                                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Leave a Review</h4>
                                    <form action="{{ route('reviews.store', $trip) }}" method="POST">
                                        @csrf
                                        <div class="mb-5">
                                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Rating</label>
                                            <select name="rating" class="w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white py-3 px-4">
                                                <option value="5">⭐⭐⭐⭐⭐ - Amazing</option>
                                                <option value="4">⭐⭐⭐⭐ - Good</option>
                                                <option value="3">⭐⭐⭐ - Average</option>
                                                <option value="2">⭐⭐ - Poor</option>
                                                <option value="1">⭐ - Terrible</option>
                                            </select>
                                        </div>
                                        <div class="mb-6">
                                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Experience</label>
                                            <textarea name="content" rows="3" class="w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white py-3 px-4" placeholder="How was it?" required></textarea>
                                        </div>
                                        <button type="submit" class="btn-force-primary py-3 px-8 rounded-xl font-bold text-white shadow-lg">Submit Review</button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="sticky top-10 bg-white dark:bg-gray-800 p-8 rounded-[2rem] shadow-2xl">
                        <div class="mb-8">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Total Price</p>
                            <div class="flex items-baseline gap-2">
                                <span class="text-5xl font-black text-gray-900 dark:text-white tracking-tight">${{ intval($trip->price) }}</span>
                                <span class="text-lg text-gray-500 font-bold">USD</span>
                            </div>
                        </div>

                        @auth
                            @if(Auth::user()->hasBooked($trip->id))
                                <div class="bg-green-50 dark:bg-green-900/20 rounded-2xl p-6 text-center">
                                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100 dark:bg-green-900 mb-3 text-green-600">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-green-800 dark:text-green-300">Confirmed!</h3>
                                    <p class="text-sm text-green-600 dark:text-green-400 mt-1">Pack your bags</p>
                                    <a href="{{ route('dashboard') }}" class="mt-4 inline-block text-xs font-bold uppercase tracking-wider text-green-700 hover:underline">Go to Dashboard</a>
                                </div>
                            @else
                                <form action="{{ route('bookings.store', $trip) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-force-primary w-full py-4 px-6 rounded-2xl font-bold text-white shadow-lg text-lg flex items-center justify-center gap-2 transform active:scale-95 transition">
                                        <span>Book Now</span>
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                    </button>
                                </form>
                                <p class="text-center text-xs text-gray-400 mt-4 font-bold uppercase tracking-widest">Instant Confirmation</p>
                            @endif
                        @else
                            <div class="bg-gray-50 dark:bg-gray-700/30 p-6 rounded-2xl text-center">
                                <p class="text-gray-900 dark:text-white mb-4 font-bold">Sign in to book</p>
                                <a href="{{ route('login') }}" class="block w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-bold py-3 rounded-xl shadow-sm hover:bg-gray-50 transition">Login / Register</a>
                            </div>
                        @endauth
                        
                        <div class="mt-8 space-y-4 border-t border-gray-100 dark:border-gray-700 pt-8">
                            <div class="flex items-center text-sm font-medium text-gray-500 dark:text-gray-400">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Best price guaranteed
                            </div>
                            <div class="flex items-center text-sm font-medium text-gray-500 dark:text-gray-400">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                Secure payment (Stripe)
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-public-layout>