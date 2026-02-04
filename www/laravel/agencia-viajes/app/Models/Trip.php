<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Trip extends Model
{
    use HasFactory; 
    public function bookings() {
        return $this->hasMany(Booking::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                $photo = $this->photos->first(); 
                
                if ($photo) {
                    return asset('storage/' . $photo->path);
                }
                
                return 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80'; 
            }
        );
    }
}