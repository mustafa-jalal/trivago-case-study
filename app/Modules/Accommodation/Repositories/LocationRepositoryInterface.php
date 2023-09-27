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
     * save user data in store.
     *
     * @param array $data
     */
    public function save(array $data);
}
