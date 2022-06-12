<?php

namespace App\Http\Requests\Prescriptions;

use Illuminate\Foundation\Http\FormRequest;
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
    #[ArrayShape(['imagePath' => "string[]"])] public function rules(): array
    {
        return [
            //
            'imagePath' => ['required', 'image', 'max:10240']
        ];
    }
}
