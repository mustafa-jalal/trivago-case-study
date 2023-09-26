<?php

namespace App\Modules\Core\Responses;

use App\Modules\Core\Contracts\Response;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;
use TypeError;

class ErrorResponse implements Response
{
    public function __construct(
        private readonly string                $message,
        private readonly array|Collection|null $errors = null,
        private readonly int                   $status = ResponseAlias::HTTP_OK,
        private readonly Exception|Throwable|TypeError|null $exception = null
    )
    {
        $this->log();
    }

    private function log(): void
    {
        if ($this->status == ResponseAlias::HTTP_INTERNAL_SERVER_ERROR && $this->exception) {
            Log::error($this->exception);
        }
    }

    final public function toJson(): JsonResponse
    {
        return response()->json([
            'message' => $this->message,
            'errors' => $this->errors,
        ], $this->status);
    }
}
