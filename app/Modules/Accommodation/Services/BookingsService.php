<?php

namespace App\Modules\Accommodation\Services;

use App\Modules\Accommodation\Exceptions\AccommodationNotAvailableException;
use App\Modules\Accommodation\Repositories\AccommodationRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class BookingsService
{

    /**
     * @param AccommodationRepositoryInterface $accommodationRepository
     */
    public function __construct(
        private readonly AccommodationRepositoryInterface $accommodationRepository,
    )
    {
    }

    /**
     * @param string $accommodationId
     * @return void
     * @throws Exception
     */
    final public function book(string $accommodationId): void
    {
        $accommodation = $this->accommodationRepository->getById($accommodationId);

        if (!$accommodation) {
            throw new NotFoundResourceException("Accommodation not found", ResponseAlias::HTTP_NOT_FOUND);
        }

        if (!$accommodation->isAvailable()) {
            throw new AccommodationNotAvailableException();
        }

        $this->accommodationRepository->update($accommodationId, [
            'available_rooms' => $accommodation->available_rooms - 1
        ]);

    }
}
