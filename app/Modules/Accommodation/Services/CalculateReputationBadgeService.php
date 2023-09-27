<?php

namespace App\Modules\Accommodation\Services;

use App\Modules\Accommodation\Models\Enums\ReputationBadgeEnum;

class CalculateReputationBadgeService
{
    const LOW_REP_VALUE = 500;
    const AVERAGE_REP_VALUE = 500;

    public function __construct(private readonly int $reputation)
    {
    }

    final public function calculate(): string
    {
        if ($this->reputation <= self::LOW_REP_VALUE) return ReputationBadgeEnum::RED->name;

        elseif ($this->reputation <= self::AVERAGE_REP_VALUE) return ReputationBadgeEnum::YELLOW->name;

        return ReputationBadgeEnum::GREEN->name;
    }
}
