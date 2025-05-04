<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Booking;

class Property extends Model
{
    protected $fillable = ['name', 'description', 'price_per_night'];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
