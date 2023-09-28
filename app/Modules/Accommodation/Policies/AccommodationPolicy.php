<?php

namespace App\Modules\Accommodation\Policies;

use App\Modules\Accommodation\Models\Accommodation;
use App\Modules\User\Models\User;

class AccommodationPolicy
{
    /**
     * Determine if the given accommodation can be updated by the user.
     */
    public function update(User $user, Accommodation $accommodation): bool
    {
        return $user->id === $accommodation->user_id;
    }

    /**
     * Determine if the given accommodation can be deleted by the user.
     */
    public function delete(User $user, Accommodation $accommodation): bool
    {
        return $user->id === $accommodation->user_id;
    }
}
