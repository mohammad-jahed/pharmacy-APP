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
    #[ArrayShape(['medicine_name' => "array", 'number' => "string[]"])]
    public function rules(): array
    {
        return [
            //
            'medicine_name' => ['required', 'bail', 'min:1' , 'max:255'],
        ];
    }
}
