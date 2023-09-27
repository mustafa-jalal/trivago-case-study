<?php

namespace App\Modules\Accommodation\Repositories;

use App\Modules\Accommodation\Models\Accommodation;

class AccommodationRepository implements AccommodationRepositoryInterface
{
    public function __construct(private readonly Accommodation $accommodation)
    {
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
