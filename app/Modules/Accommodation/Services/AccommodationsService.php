<?php

namespace App\Modules\Accommodation\Services;

use App\Modules\Accommodation\Dto\StoreAccommodationDto;
use App\Modules\Accommodation\Mappers\AccommodationMapper;
use App\Modules\Accommodation\Mappers\LocationMapper;
use App\Modules\Accommodation\Models\Accommodation;
use App\Modules\Accommodation\Repositories\AccommodationRepositoryInterface;
use App\Modules\Accommodation\Repositories\LocationRepositoryInterface;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class AccommodationsService
{

    /**
     * @param AccommodationRepositoryInterface $accommodationRepository
     */
    public function __construct(
        private readonly AccommodationRepositoryInterface $accommodationRepository,
        private readonly LocationRepositoryInterface $locationRepository,
    )
    {
    }

    /**
     * @param StoreAccommodationDto $dto
     * @return Accommodation
     * @throws Exception
     */
    final public function createAccommodation(StoreAccommodationDto $dto): Accommodation
    {
        try {
            DB::beginTransaction();

            $country = $this->locationRepository->getCountryByName($dto->getLocation()['country']);

            $locationData = LocationMapper::toDB($dto->getLocation(), $country);

            $location = $this->locationRepository->save($locationData);

            $accommodationData = AccommodationMapper::toDB($dto->toArray(), $location);

            $accommodation = $this->accommodationRepository->save($accommodationData);

            DB::commit();

            return  $accommodation;

        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * @param string $id
     * @return Accommodation
     * @throws Exception
     */
    final public function getAccommodation(string $id): Accommodation
    {
        try {
            $accommodation = $this->accommodationRepository->getById($id);

            if (!$accommodation) {
                throw new NotFoundResourceException("Accommodation not found", ResponseAlias::HTTP_NOT_FOUND);
            }

            return  $accommodation;

        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
