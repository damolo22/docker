<x-public-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8 text-center">
                <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-4">
                    Explora el Mundo
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mb-8">
                    Encuentra tu próxima aventura al mejor precio.
                </p>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg max-w-4xl mx-auto">
                    <form action="{{ route('trips.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                        <div class="flex-1 w-full text-left">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Destino</label>
                            <input type="text" name="destination" value="{{ request('destination') }}" 
                                   placeholder="¿A dónde vamos?" 
                                   class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500">
                        </div>
                        <div class="w-full md:w-48 text-left">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Precio Máx</label>
                            <input type="number" name="price" value="{{ request('price') }}" 
                                   placeholder="$$$" 
                                   class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500">
                        </div>
                        <button type="submit" class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg transition">
                            Buscar
                        </button>
                        @if(request()->has('destination') || request()->has('price'))
                            <a href="{{ route('trips.index') }}" class="w-full md:w-auto bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-white py-2 px-4 rounded-lg text-center transition">
                                Limpiar
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-4 sm:px-0">
                @foreach ($trips as $trip)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-2xl hover:-translate-y-1 hover:shadow-2xl transition duration-300 flex flex-col h-full">
                        <div class="h-48 bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center">
                            <span class="text-white text-2xl font-bold opacity-50">{{ Str::limit($trip->destination, 2) }}</span>
                        </div>
                        
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex justify-between items-start mb-2">
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $trip->destination }}</h2>
                                <span class="bg-green-100 text-green-800 text-xs font-bold px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                    ${{ $trip->price }}
                                </span>
                            </div>
                            
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-3 flex-1">
                                {{ $trip->description }}
                            </p>

                            <div class="border-t border-gray-100 dark:border-gray-700 pt-4 mt-auto flex justify-between items-center">
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    📅 {{ \Carbon\Carbon::parse($trip->start_date)->format('d M') }} - {{ \Carbon\Carbon::parse($trip->end_date)->format('d M') }}
                                </span>
                                <button class="text-indigo-600 dark:text-indigo-400 font-semibold text-sm hover:underline">
                                    Ver más &rarr;
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 px-4 sm:px-0">
                {{ $trips->links() }}
            </div>
        </div>
    </div>
</x-public-layout>