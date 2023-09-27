<?php

namespace App\Modules\Accommodation\Mappers;

use App\Modules\Accommodation\Models\Country;
use Exception;

class LocationMapper
{
    /**
     * @throws Exception
     */
    public static function toDB(array $location, Country $country): array
    {
        try {
            return [
                'country_id' => $country->id,
                'city' => $location['city'],
                'state' => $location['state'],
                'zip_code' => $location['zip_code'],
                'address' => $location['address'],
            ];
        } catch (Exception $exception) {
            throw new Exception("Unable to map location");
        }
    }
}
