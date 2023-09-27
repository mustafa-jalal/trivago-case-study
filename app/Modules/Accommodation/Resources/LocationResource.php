<?php

namespace App\Modules\Accommodation\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    final public function toArray($request = null): array
    {
        return [
            'country' => $this->country->name,
            'city' => $this->city,
            'state' => $this->state,
            'zip_code' => $this->zip_code,
            'address' => $this->address,
        ];
    }
}
