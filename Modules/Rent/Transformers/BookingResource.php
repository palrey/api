<?php

namespace Modules\Rent\Transformers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Rent\Entities\Room;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'total_price' => $this->total_price,
            'status' => $this->status,
            'date_since' => $this->date_since,
            'date_to' => $this->date_to,
            'guests' => $this->guests,
            'user' => new UserResource($this->user),
            'rooms' => RoomResource::collection($this->bookingRooms),
        ];
    }
}
