<?php

namespace App\Modules\Core\Filters;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    final public function scopeFilter(Builder $query, QueryFilters $filters): Builder
    {
        return $filters->apply($query);
    }
}
