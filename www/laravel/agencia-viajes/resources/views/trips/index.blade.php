<x-public-layout>
    <style>
        /* Inputs modernos (Semitransparentes sobre fondo oscuro) */
        .input-glass {
            background-color: rgba(255, 255, 255, 0.15)  ;
            border: 1px solid rgba(255, 255, 255, 0.2)  ;
            color: white  ;
            transition: all 0.3s ease  ;
        }
        .input-glass::placeholder {
            color: rgba(255, 255, 255, 0.7)  ;
        }
        .input-glass:focus {
            background-color: white  ;
            color: #1f2937  ; /* Gris oscuro */
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.5)  ;
            outline: none  ;
        }

        /* Botón de Buscar */
        .btn-search-glow {
            background: linear-gradient(135deg, #fbbf24 0%, #d97706 100%)  ;
            color: white  ;
            border: none  ;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4)  ;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .btn-search-glow:hover {
            transform: translateY(-2px);
            filter: brightness(110%);
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.6)  ;
        }

        .link-clear {
            color: #bfdbfe  ; 
            font-size: 0.85rem;
            text-decoration: none;
            border-bottom: 1px dashed #bfdbfe;
        }
        .link-clear:hover {
            color: white  ;
            border-bottom-style: solid;
        }
        .form{
            display:flex;
            border: none;
            width: 100%;
            align-items: center;
            text-align:center;
            justify-content:center;
        }
        form{
            width: 50%;
        }
    </style>

    <div class="bg-gray-50 dark:bg-gray-900 min-h-screen font-sans">
        
        <div class="bg-indigo-900 dark:bg-gray-800 py-12 px-4 sm:px-6 lg:px-8 text-center shadow-xl relative z-10 overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 opacity-20 pointer-events-none">
                <div class="absolute top-[-50px] left-[-50px] w-64 h-64 bg-indigo-500 rounded-full blur-3xl"></div>
                <div class="absolute bottom-[-50px] right-[-50px] w-64 h-64 bg-purple-500 rounded-full blur-3xl"></div>
            </div>

            @if (Route::has('login'))
                <div class="absolute top-5 right-5 z-20 hidden sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-sm font-bold text-white hover:bg-white/20 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-bold text-indigo-200 hover:text-white transition mr-2">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-indigo-600 rounded-full text-sm font-bold text-white hover:bg-indigo-500 transition shadow-lg">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="relative z-10 max-w-3xl mx-auto">
                <h1 class="text-4xl md:text-5xl font-black tracking-tight text-white mb-2 drop-shadow-md">
                    Find Your Next Adventure 
                </h1>

                <div class="form" class="bg-white/10 backdrop-blur-md border border-white/10 rounded-2xl p-4 shadow-2xl">
                    <form action="{{ route('trips.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-1">
                            <input type="text" name="destination" value="{{ request('destination') }}" 
                                   placeholder="Where to? (e.g. Bali)" 
                                   class="input-glass w-full rounded-xl py-3 px-4 text-base">
                        </div>
                        
                        <div class="w-full sm:w-40">
                            <input type="number" name="price" value="{{ request('price') }}" 
                                   placeholder="Max $$" 
                                   class="input-glass w-full rounded-xl py-3 px-4 text-base">
                        </div>
                        
                        <button type="submit" class="btn-search-glow py-3 px-8 rounded-xl font-bold transition w-full sm:w-auto shadow-lg flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Search
                        </button>
                    </form>
                </div>
                
                @if(request()->has('destination') || request()->has('price'))
                    <div class="mt-4 animate-fade-in">
                        <a href="{{ route('trips.index') }}" class="link-clear flex items-center justify-center gap-1 inline-flex">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            Clear Filters
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            
            @if($trips->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach ($trips as $trip)
                        <div class="flex flex-col bg-white dark:bg-gray-800 rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 h-full border border-gray-100 dark:border-gray-700 group">
                            
                            <div class="h-64 w-full relative overflow-hidden">
                                <img src="{{ asset($trip->image_url) }}" 
                                     alt="{{ $trip->destination }}" 
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-60"></div>

                                @if($trip->category)
                                    <div class="absolute top-4 right-4 bg-white/95 backdrop-blur-sm text-indigo-700 text-xs font-black px-3 py-1.5 rounded-lg shadow-sm z-10 uppercase tracking-widest">
                                        {{ $trip->category->name }}
                                    </div>
                                @endif
                                
                                <div class="absolute bottom-4 left-4 text-white">
                                    <span class="text-2xl font-black">${{ intval($trip->price) }}</span>
                                </div>
                            </div>

                            <div class="p-6 flex flex-col flex-1 relative">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white leading-tight">
                                        {{ $trip->destination }}
                                    </h3>
                                    <span class="text-xs font-bold text-gray-500 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-md whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($trip->start_date)->diffInDays($trip->end_date) }} Days
                                    </span>
                                </div>

                                <p class="text-gray-600 dark:text-gray-400 text-sm mb-6 line-clamp-3 flex-1 leading-relaxed">
                                    {{ $trip->description }}
                                </p>

                                <div class="border-t border-gray-100 dark:border-gray-700 pt-4 mt-auto">
                                    <div class="flex items-center justify-between">
                                        <div class="text-xs font-semibold text-gray-400 uppercase tracking-wide">
                                            {{ \Carbon\Carbon::parse($trip->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($trip->end_date)->format('M d, Y') }}
                                        </div>
                                        <a href="{{ route('trips.show', $trip) }}" class="text-indigo-600 dark:text-indigo-400 font-black text-sm hover:underline flex items-center gap-1 group-hover:gap-2 transition-all">
                                            View Details <span>&rarr;</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-16">
                    {{ $trips->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <div class="text-6xl mb-4">🤔</div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">No trips found</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">Try adjusting your search or price range.</p>
                    <a href="{{ route('trips.index') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-xl font-semibold text-white hover:bg-indigo-700 transition shadow-lg">
                        View All Trips
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-public-layout>