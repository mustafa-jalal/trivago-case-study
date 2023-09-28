<?php

namespace App\Modules\User\Services;

use App\Modules\User\Repositories\UserRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class UsersService
{

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    )
    {
    }

    /**
     * @return Collection
     * @throws Exception
     */
    final public function getAllUsers(): Collection
    {
        try {
            return $this->userRepository->getAll();

        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
