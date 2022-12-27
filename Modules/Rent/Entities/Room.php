<?php

namespace Modules\Rent\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rent_rooms';
    protected $guarded = ['id'];
    protected $casts = ['features' => 'array', 'open' => 'boolean'];

    public function isAvailable(string $from, string $to): bool
    {
        if (!$this->open) return false;

        $fromCount =  $this->bookings()
            ->whereDate('date_from', '<=', $from)
            ->whereDate('date_to', '>=', $from)->count();
        $toCount =  $this->bookings()
            ->whereDate('date_from', '<=', $to)
            ->whereDate('date_to', '>=', $to)->count();
        $betweenCount = $this->bookings()
            ->whereDate('date_from', '>=', $from)
            ->whereDate('date_to', '<=', $to)->count();
        return $betweenCount + $toCount + $fromCount > 0 ? false : true;
    }

    public function rent()
    {
        return $this->belongsTo(Rent::class);
    }

    public function bookingRooms()
    {
        return $this->belongsToMany(Booking::class, 'rent_booking_rooms');
    }
}
