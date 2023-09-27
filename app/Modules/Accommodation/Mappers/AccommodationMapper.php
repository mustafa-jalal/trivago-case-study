<?php

namespace App\Modules\Accommodation\Mappers;

use App\Modules\Accommodation\Models\Location;
use App\Modules\User\Services\GetAuthUserService;
use Exception;

class AccommodationMapper
{
    /**
     * @throws Exception
     */
    public static function toDB(array $data, Location $location): array
    {
        try {
            return [
                'name' => $data['name'],
                'rating' => $data['rating'],
                'category' => $data['category'],
                'location_id' => $location->id,
                'image' => $data['image'],
                'reputation' => $data['reputation'],
                'price' => $data['price'],
                'available_rooms' => $data['availability'],
                'user_id' => ((new GetAuthUserService())->execute())->id,
            ];
        } catch (Exception $exception) {
            throw new Exception("Unable to map accommodation");
        }
    }
}
