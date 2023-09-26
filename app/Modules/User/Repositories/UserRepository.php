<?php

namespace App\Modules\User\Repositories;

use App\Modules\User\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(private readonly User $user)
    {
    }

    final public function getByEmail(string $email): ?User
    {
        return $this->user->where('email', $email)->first();
    }

    final public function save(array $data): void
    {
        User::create($data);
    }
}
