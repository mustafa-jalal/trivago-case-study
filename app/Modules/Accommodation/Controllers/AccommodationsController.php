<?php

namespace App\Modules\Accommodation\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Accommodation\Dto\StoreAccommodationDto;
use App\Modules\Accommodation\Requests\StoreAccommodationRequest;
use App\Modules\Accommodation\Resources\AccommodationResource;
use App\Modules\Accommodation\Services\AccommodationsService;
use App\Modules\Core\Responses\DataResponse;
use App\Modules\Core\Responses\ErrorResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AccommodationsController extends Controller {
    public function __construct(private readonly AccommodationsService $accommodationsService){}

    /**
     * Register any application services.
     * @param StoreAccommodationRequest $request
     * @return JsonResponse
     */
    final public function store(StoreAccommodationRequest $request): JsonResponse
    {
        try {
            $dto = new StoreAccommodationDto($request->validated());

            $accommodation = $this->accommodationsService->createAccommodation($dto);

            $accommodationResource = new AccommodationResource($accommodation);

            return (new DataResponse($accommodationResource->toArray()))->toJson();

        } catch (Exception $e) {
            return (new ErrorResponse(message: 'Server Error', status: ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, exception: $e))->toJson();
        }
    }

}
