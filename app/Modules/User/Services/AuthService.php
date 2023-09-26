<?php

namespace App\Modules\User\Services;

use App\Modules\User\Dto\Auth\LoginUserDto;
use App\Modules\User\Dto\Auth\RegisterUserDto;
use App\Modules\User\Models\User;
use App\Modules\User\Repositories\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthService
{

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

    /**
     * @param LoginUserDto $dto
     * @return string
     * @throws Exception
     */
    final public function login(LoginUserDto $dto): string
    {
        $user = $this->userRepository->getByEmail($dto->getEmail());

        if (!$user || !Hash::check($dto->getPassword(), $user?->password)) {
            throw new InvalidArgumentException('Invalid login credentials', ResponseAlias::HTTP_BAD_REQUEST);
        }

        return $user->createToken($user->name)->plainTextToken;
    }

    final public function logout(User $user)
    {
        $user->tokens()->delete();
    }

    /**
     * @param RegisterUserDto $dto
     * @return void
     */
    final public function register(RegisterUserDto $dto): void
    {
        $this->userRepository->save([
            'name' => $dto->getName(),
            'email' => $dto->getEmail(),
            'password' => Hash::make($dto->getPassword())
        ]);
    }
}
