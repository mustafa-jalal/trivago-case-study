<?php

namespace App\Modules\Accommodation\Mappers;

use App\Modules\Accommodation\Models\Enums\ReputationBadgeEnum;

class ReputationBadgeMapper
{
    const LOW_REP_VALUE = 500;
    const AVERAGE_REP_VALUE = 799;

    final public function toBadge(int $reputation): string
    {
        if ($reputation <= self::LOW_REP_VALUE) return ReputationBadgeEnum::RED->name;

        elseif ($reputation <= self::AVERAGE_REP_VALUE) return ReputationBadgeEnum::YELLOW->name;

        return ReputationBadgeEnum::GREEN->name;
    }

    final public function toReputationRange(string $badge): array
    {
        $badge = strtoupper($badge);

        if ($badge == ReputationBadgeEnum::RED->name) return ['min' => 0, 'max' => self::LOW_REP_VALUE];

        else if ($badge == ReputationBadgeEnum::YELLOW->name) return ['min' => self::LOW_REP_VALUE + 1, 'max' => self::AVERAGE_REP_VALUE];

        return ['min' => self::AVERAGE_REP_VALUE + 1, 'max' => PHP_INT_MAX];
    }
}
