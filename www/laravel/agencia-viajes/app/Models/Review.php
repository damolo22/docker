<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'trip_id', 'content', 'rating'];

    // Relación: Un comentario pertenece a un Usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación: Un comentario pertenece a un Viaje
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}