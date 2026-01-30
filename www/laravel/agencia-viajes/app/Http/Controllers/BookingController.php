<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Para procesar la reserva
    public function store(Request $request, Trip $trip)
    {
        Auth::user()->bookings()->create([
            'trip_id' => $trip->id,
            'total_price' => $trip->price, //  1 ticket por ahora
            'status' => 'paid', // Simulamos que pago 
        ]);

        // Mensaje de éxito
        return redirect()->route('dashboard')->with('success', '¡Viaje reservado con éxito! ');
    }
}