<?php

namespace Modules\Rent\Transformers;

use App\Http\Traits\ImageHandler;
use Illuminate\Http\Resources\Json\JsonResource;

class RentResource extends JsonResource
{
    use ImageHandler;

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
            'title' => $this->title,
            'small_description' => $this->small_description,
            'description' => $this->description,
            'image' => $this->imageUrl($this->image),
            'address' => $this->address,
            'open' => $this->open,
        ];
    }
}
