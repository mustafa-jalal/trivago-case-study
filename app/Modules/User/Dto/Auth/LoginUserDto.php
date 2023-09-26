<?php

namespace App\Modules\User\Dto\Auth;

use App\Modules\Core\Contracts\DtoInterface;
use App\Modules\Core\Dto\AbstractDto;

class LoginUserDto extends AbstractDto implements DtoInterface
{
    private string $email;

    private string $password;

    /**
     * @return string
     */
    final public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    final public function getPassword(): string
    {
        return $this->password;
    }


    final protected function map(array $data): bool
    {
        $this->email = $data['email'];
        $this->password = $data['password'];
        return true;
    }

    final public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password
        ];
    }
}
