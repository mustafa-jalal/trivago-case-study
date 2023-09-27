<?php

namespace App\Modules\User\Services;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class GetAuthUserService
{
    final public function execute(): Authenticatable {
        return Auth::user();
    }
}
