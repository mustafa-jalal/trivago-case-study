<?php

namespace App\Modules\Accommodation\Resources;

use App\Modules\Accommodation\Mappers\ReputationBadgeMapper;
use App\Modules\Accommodation\Services\CalculateReputationBadgeService;
use Illuminate\Http\Resources\Json\JsonResource;

class AccommodationResource extends JsonResource
{

    final public function toArray($request = null): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'rating' => $this->rating,
            'category' => $this->category,
            'location' => new LocationResource($this->location),
            'image' => $this->image,
            'reputation' => $this->reputation,
            'reputationBadge' => (new ReputationBadgeMapper())->toBadge($this->reputation),
            'price' => $this->price,
            'availability' => $this->available_rooms,
        ];
    }
}
