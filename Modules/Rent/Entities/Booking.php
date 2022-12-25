<?php

namespace Modules\Rent\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'rent_bookings';
    protected $guarded = ['id'];
    protected $casts = ['date_since' => 'date', 'date_to' => 'date', 'guests' => 'array', 'messages' => 'array'];

    /**
     * status
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => self::statusByInt($value),
            set: fn (string $value) => self::statusByString($value),
        );
    }
    /**
     * statusByInt
     * @param int $status
     * @return string
     */
    public static function statusByInt(int $status)
    {
        switch ($status) {
            case 0:
                return 'CREATED';
            case 1:
                return 'ACCEPTED';
            case 2:
                return 'CANCELED';
            case 3:
                return 'COMPLETED';
            default:
                return 'CREATED';
        }
    }

    /**
     * statusByString
     * @param string $status
     * @return int
     */
    public static function statusByString(string $status)
    {
        switch ($status) {
            case 'CREATED':
                return 0;
            case 'ACCEPTED':
                return 1;
            case 'CANCELED':
                return 2;
            case 'COMPLETED':
                return 3;
            default:
                return 0;
        }
    }
    /**
     * bookingRooms
     * @return Room[]
     */
    public function bookingRooms()
    {
        return $this->belongsToMany(Room::class, 'rent_booking_rooms');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
