<?php

namespace App\Modules\User\Repositories;

interface UserRepositoryInterface
{

    /**
     * Get all users from data store.
     *
     */
    public function getAll();

    /**
     * Get the user from data store by email.
     *
     * @param string $email
     */
    public function getByEmail(string $email);

    /**
     * save user data in store.
     *
     * @param array $data
     */
    public function save(array $data);
}
