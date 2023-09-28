<?php

namespace App\Modules\Accommodation\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Accommodation\Exceptions\AccommodationNotAvailableException;
use App\Modules\Accommodation\Services\BookingsService;
use App\Modules\Core\Responses\DataResponse;
use App\Modules\Core\Responses\ErrorResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class BookingController extends Controller {
    public function __construct(private readonly BookingsService $bookingsService){}


    /**
     * Register any application services.
     * @param string $accommodationId
     * @return JsonResponse
     */
    final public function bookAccommodation(string $accommodationId): JsonResponse
    {
        try {
            $this->bookingsService->book($accommodationId);

            return (new DataResponse(message: "Accommodation booked successfully"))->toJson();

        } catch (AccommodationNotAvailableException|NotFoundResourceException $e) {
            return (new ErrorResponse(message: $e->getMessage(), status: $e->getCode()))->toJson();
        } catch (Exception $e) {
            return (new ErrorResponse(message: 'Server Error', status: ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, exception: $e))->toJson();
        }
    }
}
