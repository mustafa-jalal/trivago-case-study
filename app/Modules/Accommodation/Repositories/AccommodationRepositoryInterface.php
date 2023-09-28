<?php

namespace App\Modules\Accommodation\Repositories;

interface AccommodationRepositoryInterface
{

    /**
     * get all user accommodations data in store.
     *
     */
    public function getAll();

    /**
     * get single accommodation data from store.
     *
     * @param string $id
     */
    public function getById(string $id);

    /**
     * get accommodations data from store by user id.
     *
     * @param string $userId
     */
    public function getByUserId(string $userId);


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
