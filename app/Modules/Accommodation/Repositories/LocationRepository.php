<?php

namespace App\Modules\Accommodation\Repositories;

use App\Modules\Accommodation\Models\Country;
use App\Modules\Accommodation\Models\Location;
use Exception;

class LocationRepository implements LocationRepositoryInterface
{
    public function __construct(Location $location, private readonly Country $country)
    {
    }

    final public function getCountryByName(string $name): ?Country
    {
        return $this->country->where('name', $name)->first();
    }

    /**
     * @throws Exception
     */
    final public function save(array $data): Location
    {
        $country = $this->getCountryByName($data['country']);

        return Location::create([
            'country_id' => $country->id,
            'city' => $data['city'],
            'state' => $data['state'],
            'zip_code' => $data['zip_code'],
            'address' => $data['address'],
        ]);
    }

    /**
     * @throws Exception
     */
    final public function update(string $id, array $data): void
    {
        $country = $this->getCountryByName($data['country']);

         Location::find($id)->update([
            'country_id' => $country->id,
            'city' => $data['city'],
            'state' => $data['state'],
            'zip_code' => $data['zip_code'],
            'address' => $data['address'],
        ]);
    }

}
