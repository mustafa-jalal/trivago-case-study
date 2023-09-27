<?php

namespace App\Modules\Accommodation\Repositories;

interface AccommodationRepositoryInterface
{

    /**
     * get all user accommodations data in store.
     *
     * @param string $userId
     */
    public function getAll(string $userId);

    /**
     * get accommodation data from store.
     *
     * @param string $userId
     */
    public function getById(string $userId);


    /**
     *  save accommodation data in store.
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

    /**
     * remove accommodation data from store.
     *
     * @param string $id
     */
    public function remove(string $id);
}
