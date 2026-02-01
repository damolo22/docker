<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Trip $trip)
    {
        $request->validate([
            'content' => 'required|min:5|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        if (!Auth::user()->hasBooked($trip->id)) {
            return back()->withErrors(['general' => '¡Debes reservar este viaje antes de comentar!']);
        }


        try {
            Review::create([
                'user_id' => Auth::id(),
                'trip_id' => $trip->id,
                'content' => $request->content,
                'rating' => $request->rating,
            ]);
            
            $message = 'Gracias por tu opinión.';
            return back()->with('success', $message);

        } catch (\Exception $e) {
            return back()->withErrors(['general' => 'Error al guardar el comentario.']);
        }
    }
    
}