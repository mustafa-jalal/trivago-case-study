<?php

namespace App\Modules\Accommodation\Requests;

use App\Modules\Accommodation\Requests\ValidationRules\ValidateCategory;
use App\Modules\Accommodation\Requests\ValidationRules\ValidateForbiddenWords;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAccommodationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    final public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:11', new ValidateForbiddenWords()],
            'rating' => ['required', 'numeric', 'min:0', 'max:5'],
            'category' => ['required', 'string', new ValidateCategory()],
            'reputation' => ['required', 'numeric', 'min:0', 'max:1000'],
            'price' => ['required', 'decimal:0,5'],
            'availability' => ['required', 'numeric'],
            'image' => ['required', 'string', 'url'],
            'location' => ['required', 'array'],
            'location.country' => ['required', 'exists:countries,name'],
            'location.city' => ['required', 'string'],
            'location.state' => ['required', 'string'],
            'location.zip_code' => ['required', 'numeric', 'digits:5'],
            'location.address' => ['required', 'string']
        ];
    }
}
