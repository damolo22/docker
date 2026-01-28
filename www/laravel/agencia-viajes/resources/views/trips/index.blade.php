<x-guest-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Explora nuestros Destinos </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($trips as $trip)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow duration-300">
                    <div class="h-48 bg-gray-200 w-full flex items-center justify-center text-gray-500">
                        <span>Foto de {{ $trip->destination }}</span>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex justify-between items-baseline">
                            <h2 class="text-xl font-semibold text-gray-900">{{ $trip->destination }}</h2>
                            <span class="text-green-600 font-bold">${{ $trip->price }}</span>
                        </div>
                        
                        <p class="text-gray-600 mt-2 text-sm line-clamp-3">
                            {{ $trip->description }}
                        </p>

                        <div class="mt-4 flex justify-between items-center text-sm text-gray-500">
                            <span>📅 {{ \Carbon\Carbon::parse($trip->start_date)->format('d M Y') }}</span>
                            <a href="#" class="text-indigo-600 hover:text-indigo-900 font-medium">Ver detalles &rarr;</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $trips->links() }}
        </div>
    </div>
</x-guest-layout>