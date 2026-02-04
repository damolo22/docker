<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request, Trip $trip)
    {
        Auth::user()->bookings()->create([
            'trip_id' => $trip->id,
            'total_price' => $trip->price,
            'status' => 'paid',
        ]);

        return redirect()->route('dashboard')->with('success', '¡Viaje reservado!');
    }

    public function destroy(\App\Models\Booking $booking)
    {
        if (auth()->id() !== $booking->user_id) {
            return back()->with('error', 'No puedes cancelar la reserva de otro.');
        }

        try {
            $booking->delete();
            return back()->with('success', 'Reserva cancelada correctamente. 👌');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al cancelar.');
        }
    }
}