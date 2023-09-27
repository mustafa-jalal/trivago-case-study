<?php

namespace App\Modules\Accommodation\Requests\ValidationRules;

use App\Modules\Accommodation\Models\Enums\CategoryEnum;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateCategory implements ValidationRule
{
    final public function validate(string $attribute, mixed $value, Closure $fail): void
    {
         if(!in_array(strtoupper(str_replace("-", "_", $value)), array_column(CategoryEnum::cases(), 'name'))) {
             $fail("Category must be one of (hotel, alternative, hostel, lodge, resort, guest-house).");
         }
    }
}
