<?php

namespace App\Modules\Core\Contracts;

use Illuminate\Http\JsonResponse;

interface Response
{
    public function toJson(): JsonResponse;
}
