<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class NearestPharmaciesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['medicines' => "string[]", 'medicines.*' => "string[]", 'state_id' => "array", 'city_id' => "array", 'area_id' => "array"])]
    public function rules(): array
    {
        return [
            //
            'medicines' => ['required', 'array'],
            'medicines.*' => [ 'bail',  'max:255' ],
            'area_id'=>['required','bail', 'min:1' ,Rule::exists('areas','id')]

        ];
    }
}
