<?php

namespace App\Modules\Accommodation\Repositories;

use App\Modules\Accommodation\Models\Country;
use App\Modules\Accommodation\Models\Location;

class LocationRepository implements LocationRepositoryInterface
{
    public function __construct(Location $location, private readonly Country $country)
    {
    }

    final public function getCountryByName(string $name): ?Country
    {
        return $this->country->where('name', $name)->first();
    }

    public function save(array $data): Location
    {
        return Location::create($data);
    }
}
