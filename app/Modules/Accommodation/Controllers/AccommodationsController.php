<?php

namespace App\Modules\Accommodation\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Accommodation\Dto\StoreAccommodationDto;
use App\Modules\Accommodation\Dto\UpdateAccommodationDto;
use App\Modules\Accommodation\Requests\StoreAccommodationRequest;
use App\Modules\Accommodation\Requests\UpdateAccommodationRequest;
use App\Modules\Accommodation\Resources\AccommodationResource;
use App\Modules\Accommodation\Services\AccommodationsService;
use App\Modules\Core\Responses\DataResponse;
use App\Modules\Core\Responses\ErrorResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class AccommodationsController extends Controller {
    public function __construct(private readonly AccommodationsService $accommodationsService){}

    /**
     * Register any application services.
     * @param Request $request
     * @return JsonResponse
     */
    final public function index(Request $request): JsonResponse
    {
        try {
            $accommodations = $this->accommodationsService->getAllAccommodations();

            $accommodationResource = AccommodationResource::collection($accommodations);

            return (new DataResponse($accommodationResource->toArray($request)))->toJson();

        } catch (NotFoundResourceException $e) {
            return (new ErrorResponse(message: $e->getMessage(), status: $e->getCode()))->toJson();
        }
        catch (Exception $e) {
            return (new ErrorResponse(message: 'Server Error', status: ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, exception: $e))->toJson();
        }
    }

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

    /**
     * Register any application services.
     * @param string $id
     * @return JsonResponse
     */
    final public function show(string $id): JsonResponse
    {
        try {
            $accommodation = $this->accommodationsService->getAccommodation($id);

            $accommodationResource = new AccommodationResource($accommodation);

            return (new DataResponse($accommodationResource->toArray()))->toJson();

        } catch (NotFoundResourceException $e) {
            return (new ErrorResponse(message: $e->getMessage(), status: $e->getCode()))->toJson();
        }
        catch (Exception $e) {
            return (new ErrorResponse(message: 'Server Error', status: ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, exception: $e))->toJson();
        }
    }

    /**
     * Register any application services.
     * @param UpdateAccommodationRequest $request
     * @param string $id
     * @return JsonResponse
     */
    final public function update(UpdateAccommodationRequest $request, string $id): JsonResponse
    {
        try {
            $dto = new UpdateAccommodationDto($request->validated());

             $this->accommodationsService->updateAccommodation($id, $dto);

            return (new DataResponse(message: "Accommodation update successfully"))->toJson();

        } catch (Exception $e) {
            return (new ErrorResponse(message: 'Server Error', status: ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, exception: $e))->toJson();
        }
    }

}
