<?php

namespace App\Modules\Accommodation\Repositories;

interface AccommodationRepositoryInterface
{

    /**
     * save user data in store.
     *
     * @param array $data
     */
    public function save(array $data);

    /**
     * save user data in store.
     *
     * @param string $id
     */
    public function getById(string $id);
}
