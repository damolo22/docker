<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        
        // Verificamos si está logueado y si su rol es 'admin'
        if($user != null && $user->rol == 'admin') {
            return $next($request);
        } else {
            // Si no es admin, lo mandamos a la lista de viajes (index)
            return redirect()->route('trips.index'); 
        }
    }
}