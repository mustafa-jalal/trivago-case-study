<?php

namespace App\Modules\Accommodation\Repositories;

interface LocationRepositoryInterface
{

    /**
     * get country from store by name.
     *
     * @param string $name
     */
    public function getCountryByName(string $name);

    /**
     * save location data in store.
     *
     * @param array $data
     */
    public function save(array $data);

    /**
     * update location data in store.
     *
     * @param string $id
     * @param array $data
     */
    public function update(string $id, array $data);
}
