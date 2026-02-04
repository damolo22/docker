<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function store(Request $request, Trip $trip)
    {
        $request->validate([
            'content' => 'required|min:5|max:500',
            'rating'  => 'required|integer|min:1|max:5',
        ]);

        try {
            Review::create([
                'user_id' => Auth::id(),
                'trip_id' => $trip->id,
                'content' => $request->content,
                'rating'  => $request->rating,
            ]);

            return redirect()->route('trips.show', $trip)->with('success', '¡Gracias por tu opinión!');

        } catch (\Exception $e) {
            return back()->with('error', 'No se pudo guardar tu reseña.');
        }
    }

    public function edit(Review $review)
    {
        if (Auth::id() !== $review->user_id && Auth::user()->rol !== 'admin') {
            return redirect()->route('trips.show', $review->trip)->with('error', 'No tienes permiso.');
        }

        return view('reviews.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        if (Auth::id() !== $review->user_id && Auth::user()->rol !== 'admin') {
            return back()->with('error', 'No tienes permiso.');
        }

        $request->validate([
            'content' => 'required|min:5|max:500',
            'rating'  => 'required|integer|min:1|max:5',
        ]);

        try {
            $review->update([
                'content' => $request->content,
                'rating'  => $request->rating,
            ]);

            return redirect()->route('trips.show', $review->trip)->with('success', 'Review actualizada correctamente ✨');

        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar.');
        }
    }

    public function destroy(Review $review)
    {
        if (Auth::id() !== $review->user_id && Auth::user()->rol !== 'admin') {
            return back()->with('error', 'No toques lo que no es tuyo');
        }

        try {
            $trip = $review->trip;
            $review->delete();
            
            return redirect()->route('trips.show', $trip)->with('success', 'Review eliminada 🗑️');

        } catch (\Exception $e) {
            return back()->with('error', 'No se pudo borrar.');
        }
    }
}