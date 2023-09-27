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
}
