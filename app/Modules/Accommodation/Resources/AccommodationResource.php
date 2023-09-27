<?php

namespace App\Modules\Accommodation\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccommodationResource extends JsonResource
{
    final public function toArray($request = null): array
    {
        return [
            'name' => $this->name,
            'rating' => $this->rating,
            'category' => $this->category,
            'location' => $this->location,
            'image' => $this->image,
            'reputation' => $this->reputation,
            'reputationBadge' => $this->name,
            'price' => $this->price,
            'availability' => $this->available_rooms,
        ];
    }
}
