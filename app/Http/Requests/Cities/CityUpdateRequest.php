<?php

namespace App\Http\Requests\Cities;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class CityUpdateRequest extends FormRequest
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
    #[ArrayShape(['name_en' => "string[]", 'name_ar' => "string[]"])] public function rules(): array
    {
        return [
            //
            'name_en' => ['string', 'min:3'],
            'name_ar' => ['string', 'min:3'],
            'state_id'=>[Rule::exists('states','id'),'required']
        ];
    }
}
