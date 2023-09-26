<?php

namespace App\Modules\Core\Dto;

use App\Modules\Core\Contracts\DtoInterface;
use Exception;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

abstract class AbstractDto implements DtoInterface
{
    /**
     * @throws Exception
     */
    public function __construct(array $data)
    {
        if (!$this->map($data)) {
            throw new Exception('mapping dto failed', ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    abstract protected function map(array $data): bool;
}
