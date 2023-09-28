<?php

namespace App\Modules\User\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    final public function toArray($request = null): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->rating,
        ];
    }
}
