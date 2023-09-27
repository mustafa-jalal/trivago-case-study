<?php

namespace App\Modules\Accommodation\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Location extends Model
{
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'country_id',
        'city',
        'state',
        'zip_code',
        'address',
    ];

    final public function location(): HasOne
    {
        return $this->hasOne(Accommodation::class);
    }

    final public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
