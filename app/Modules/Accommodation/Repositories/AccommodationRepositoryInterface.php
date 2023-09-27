<?php

namespace App\Modules\Accommodation\Repositories;

use App\Modules\Accommodation\Models\Accommodation;

interface AccommodationRepositoryInterface
{
    /**
     * save user data in store.
     *
     * @param string $id
     */
    public function getById(string $id);


    /**
     * save user data in store.
     *
     * @param array $data
     */
    public function save(array $data);


    /**
     * update accommodation data in store.
     *
     * @param string $id
     * @param array $data
     */
    public function update(string $id, array $data);
}
