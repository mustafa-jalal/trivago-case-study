<?php

namespace App\Modules\Core\Responses;

use App\Modules\Core\Contracts\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class DataResponse implements Response
{
    public function __construct(
        private readonly array|Collection|null $data = null,
        private readonly ?string               $message = null,
        private readonly int                   $status = 200)
    {
    }

    final public function toJson(): JsonResponse
    {
        return response()->json([
            'message' => $this->message,
            'data' => $this->data,
        ], $this->status);
    }
}
