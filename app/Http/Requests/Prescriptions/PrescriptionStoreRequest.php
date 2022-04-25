<?php

namespace App\Http\Requests\Prescriptions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class PrescriptionStoreRequest extends FormRequest
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
    #[ArrayShape(['user_id' => "array", 'imagePath' => "string[]"])] public function rules(): array
    {
        return [
            //
            'user_id' => ['required', Rule::exists('users', 'id')],
            'imagePath' => ['required', 'image', 'size:1024', 'dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000']
        ];
    }
}
