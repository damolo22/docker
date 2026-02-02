<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Category;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::latest()->paginate(9);

        return view('trips.index', compact('trips'));
    }

    public function show(Trip $trip)
    {
        return view('trips.show', compact('trip'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('trips.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'destination' => 'required|min:4|max:100|string',
            'description' => 'required|min:10',
            'price'       => 'required|numeric|min:0',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after:start_date',
            'category_id' => 'required|exists:categories,id',
        ]);

        try {
            $trip = new Trip();
            $trip->destination = $request->destination;
            $trip->description = $request->description;
            $trip->price = $request->price;
            $trip->start_date = $request->start_date;
            $trip->end_date = $request->end_date;
            $trip->category_id = $request->category_id;
            $randomNumber = rand(1, 6); 
            $trip->image_url = "images/trips/trip-{$randomNumber}.jpg";
            
            $trip->slug = \Str::slug($request->destination) . '-' . time();

            $trip->save();
            
            return redirect()->route('trips.index')->with('success', 'Viaje creado correctamente.');

        } catch (QueryException $e) {
            return back()->withInput()->withErrors(['general' => 'Error de base de datos.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['general' => 'Ha ocurrido un error inesperado: ' . $e->getMessage()]);
        }
    }

    public function edit(Trip $trip)
    {
        $categories = Category::all(); 
        return view('trips.edit', compact('trip', 'categories'));
    }

    public function update(Request $request, Trip $trip)
    {
        $request->validate([
            'destination' => 'required|min:4|max:100|string',
            'description' => 'required|min:10',
            'price'       => 'required|numeric|min:0',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after:start_date',
            'category_id' => 'required|exists:categories,id',
        ]);

        try {
            $trip->destination = $request->destination;
            $trip->description = $request->description;
            $trip->price = $request->price;
            $trip->start_date = $request->start_date;
            $trip->end_date = $request->end_date;
            $trip->category_id = $request->category_id;
            
            $trip->slug = \Str::slug($request->destination) . '-' . $trip->id;

            $trip->save();
            
            return redirect()->route('trips.show', $trip)->with('success', 'Trip updated successfully! ✨');

        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['general' => 'Error updating trip.']);
        }
    }

    public function destroy(Trip $trip)
    {
        try {
 
            
            $trip->delete();
            
            return redirect()->route('trips.index')->with('success', 'Viaje eliminado correctamente. 🗑️');

        } catch (\Exception $e) {
            return back()->withErrors(['general' => 'No se pudo eliminar el viaje.']);
        }
    }
}