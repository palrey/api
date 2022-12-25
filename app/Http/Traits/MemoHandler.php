<?php

namespace App\Http\Traits;

use App\Models\Memo;
use Modules\Rent\Entities\Booking;

/**
 * MemoHandler
 */
trait MemoHandler
{
    /**
     * memoBooking
     */
    public function memoBooking(Booking $booking)
    {
        $profile = $booking->user->profile;
        $memo = new Memo([
            'type' => 'booking',
            'data' => 'Nueva reserva de ' . $profile->fullName
        ]);
        return $memo->save();
    }
}
