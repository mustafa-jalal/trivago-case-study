<?php

namespace App\Modules\Accommodation\Services;

use App\Modules\Accommodation\Dto\StoreAccommodationDto;
use App\Modules\Accommodation\Mappers\AccommodationMapper;
use App\Modules\Accommodation\Mappers\LocationMapper;
use App\Modules\Accommodation\Models\Accommodation;
use App\Modules\Accommodation\Repositories\AccommodationRepositoryInterface;
use App\Modules\Accommodation\Repositories\LocationRepositoryInterface;
use Illuminate\Support\Facades\DB;

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
     * @throws \Exception
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

        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
