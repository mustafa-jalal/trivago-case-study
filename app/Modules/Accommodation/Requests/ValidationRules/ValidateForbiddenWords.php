<?php

namespace App\Modules\Accommodation\Requests\ValidationRules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateForbiddenWords implements ValidationRule
{
    final public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $forbiddenWords = ["Free", "Offer", "Book", "Website"];

        foreach ($forbiddenWords as $word) {
            if (str_contains(strtolower($value), strtolower($word))) {
                $fail('The name cannot contain words like "Free," "Offer," "Book," or "Website.');
            }
        }
    }
}
