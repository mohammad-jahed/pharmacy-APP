<?php

namespace App\Http\Requests\Components;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ComponentUpdateRequest extends FormRequest
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
    #[ArrayShape(['name_e' => "string[]", 'name_ar' => "string[]"])]
    public function rules(): array
    {
        return [
            //
            'name_e' => ['string'],
            'name_ar' => ['string']
        ];
    }
}
