<?php

namespace Modules\Rent\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rent_rooms';
    protected $guarded = ['id'];
    protected $casts = ['features' => 'array'];

    public function rent()
    {
        return $this->belongsTo(Rent::class);
    }

    public function bookingRooms()
    {
        return $this->belongsToMany(Booking::class, 'rent_booking_rooms');
    }
}
