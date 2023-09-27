<?php

namespace App\Modules\Accommodation\Repositories;

use App\Modules\Accommodation\Filters\AccommodationsFilters;
use App\Modules\Accommodation\Models\Accommodation;
use Illuminate\Database\Eloquent\Collection;

class AccommodationRepository implements AccommodationRepositoryInterface
{
    public function __construct(
        private readonly Accommodation $accommodation,
        private readonly AccommodationsFilters $accommodationsFilters
    )
    {
    }

    public function getAll(string $userId): Collection
    {
        return $this->accommodation->filter($this->accommodationsFilters)->where('user_id', $userId)->get();
    }

    final public function save(array $data): Accommodation
    {
        return Accommodation::create($data);
    }

    final public function getById(string $id): ?Accommodation
    {
        return $this->accommodation->find($id);
    }

    final public function update(string $id, array $data): void
    {
        $this->accommodation->find($id)->update($data);
    }
}
