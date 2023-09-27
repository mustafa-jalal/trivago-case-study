<?php

namespace App\Modules\Accommodation\Dto;

use App\Modules\Core\Contracts\DtoInterface;
use App\Modules\Core\Dto\AbstractDto;

class UpdateAccommodationDto extends AbstractDto implements DtoInterface
{
    private string $name;
    private int $rating;
    private string $category;
    private array $location;
    private string $image;
    private int $reputation;
    private float $price;
    private int $availability;

    /**
     * @return array
     */
    final public function getLocation(): array
    {
        return $this->location;
    }

    final protected function map(array $data): bool
    {
        $this->name = $data['name'];
        $this->rating = $data['rating'];
        $this->category = $data['category'];
        $this->location = $data['location'];
        $this->image = $data['image'];
        $this->reputation = $data['reputation'];
        $this->price = $data['price'];
        $this->availability = $data['availability'];
        return true;
    }

    final public function toArray(): array
    {
        return [
            'name' => $this->name,
            'rating' => $this->rating,
            'category' => $this->category,
            'image' => $this->image,
            'reputation' => $this->reputation,
            'price' => $this->price,
            'availability' => $this->availability
        ];
    }
}
