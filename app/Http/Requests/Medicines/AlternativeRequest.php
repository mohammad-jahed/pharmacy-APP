<?php

namespace App\Http\Requests\Medicines;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class AlternativeRequest extends FormRequest
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
    #[ArrayShape(['medicine_id' => "array", 'number' => "string[]"])]
    public function rules(): array
    {
        return [
            //
            'medicine_id' => ['required', 'bail', 'min:1', Rule::exists('medicines', 'id')],
            'number' => ['required', 'bail', 'integer', 'digits_between:1,3']
        ];
    }
}
