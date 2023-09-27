<?php
namespace App\Modules\Accommodation\Filters;

use App\Modules\Accommodation\Mappers\ReputationBadgeMapper;
use App\Modules\Core\Filters\QueryFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AccommodationsFilters extends QueryFilters
{
    protected Request $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function name(string|null $term =null): Builder
    {
        return $this->builder->where('name', 'LIKE', "%$term%");
    }

    final public function rating(int|null $value =null):  Builder
    {
        return $this->builder->where('rating', $value);
    }

    final public function city(string|null $term =null): Builder
    {
        return $this->builder->whereHas('location', function ($query) use ($term) {
            $query->where('city', $term);
        });
    }

    final public function reputationBadge(string|null $term =null): Builder
    {
        if ($term) {
            $reputation = (new ReputationBadgeMapper())->toReputationRange($term);

            return $this->builder->whereBetween('reputation', [$reputation['min'], $reputation['max']]);
        }

        return $this->builder;
    }

}
