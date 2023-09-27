<?php

namespace App\Modules\Accommodation\Models;

use App\Modules\Core\Filters\Filterable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Accommodation extends Model
{
    use HasUuids, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'rating',
        'category',
        'location_id',
        'image',
        'reputation',
        'price',
        'available_rooms',
        'user_id',
    ];

    final public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
