<?php

namespace App\Modules\Accommodation\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AccommodationNotAvailableException extends Exception
{
    public function __construct()
    {
        parent::__construct( 'Accommodation fully booked and not available at the current time', ResponseAlias::HTTP_NOT_FOUND);
    }
}
