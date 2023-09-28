<?php

namespace App\Modules\Accommodation\Services;

use App\Modules\Accommodation\Dto\StoreAccommodationDto;
use App\Modules\Accommodation\Dto\UpdateAccommodationDto;
use App\Modules\Accommodation\Mappers\AccommodationMapper;
use App\Modules\Accommodation\Models\Accommodation;
use App\Modules\Accommodation\Repositories\AccommodationRepositoryInterface;
use App\Modules\Accommodation\Repositories\LocationRepositoryInterface;
use App\Modules\User\Services\GetAuthUserService;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class AccommodationsService
{

    /**
     * @param AccommodationRepositoryInterface $accommodationRepository
     * @param LocationRepositoryInterface $locationRepository
     */
    public function __construct(
        private readonly AccommodationRepositoryInterface $accommodationRepository,
        private readonly LocationRepositoryInterface $locationRepository,
    )
    {
    }

    /**
     * @return Collection
     * @throws Exception
     */
    final public function getAllAccommodations(): Collection
    {
        $authUser = (new GetAuthUserService())->execute();

        return $this->accommodationRepository->getAll($authUser->id);
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

            $location = $this->locationRepository->save($dto->getLocation());

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
        $accommodation = $this->accommodationRepository->getById($id);

        if (!$accommodation) {
            throw new NotFoundResourceException("Accommodation not found", ResponseAlias::HTTP_NOT_FOUND);
        }

        return  $accommodation;
    }

    /**
     * @param string $id
     * @param UpdateAccommodationDto $dto
     * @return void
     * @throws Exception
     */
    final public function updateAccommodation(string $id, UpdateAccommodationDto $dto): void
    {
        try {
            $accommodation = $this->accommodationRepository->getById($id);

            if (!$accommodation) {
                throw new NotFoundResourceException("Accommodation not found", ResponseAlias::HTTP_NOT_FOUND);
            }

            DB::beginTransaction();

            $this->locationRepository->update($accommodation->location->id, $dto->getLocation());

            $this->accommodationRepository->update($id, $dto->toArray());

            DB::commit();

        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * @param string $id
     * @return void
     * @throws Exception
     */
    final public function deleteAccommodation(string $id): void
    {
        try {
            $accommodation = $this->accommodationRepository->getById($id);

            if (!$accommodation) {
                throw new NotFoundResourceException("Accommodation not found", ResponseAlias::HTTP_NOT_FOUND);
            }

            DB::beginTransaction();

            $this->accommodationRepository->remove($id);

            $this->locationRepository->remove($accommodation->location->id);

            DB::commit();

        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * @param string $userId
     * @return Collection
     */
    final public function getUserAccommodations(string $userId): Collection
    {
        return $this->accommodationRepository->getAll($userId);
    }
}
