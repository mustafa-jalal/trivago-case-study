<?php

namespace App\Modules\User\Dto\Auth;

use App\Modules\Core\Contracts\DtoInterface;
use App\Modules\Core\Dto\AbstractDto;

class RegisterUserDto extends AbstractDto implements DtoInterface
{
    private string $name;
    private string $email;
    private string $password;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    protected function map(array $data): bool
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        return true;
    }

    final public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
