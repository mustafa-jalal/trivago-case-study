<?php

namespace App\Modules\User\Repositories;

interface UserRepositoryInterface
{

    /**
     * Get the user from db by email.
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
