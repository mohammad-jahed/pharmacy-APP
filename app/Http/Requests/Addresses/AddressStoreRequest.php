<?php

namespace App\Http\Requests\Addresses;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class AddressStoreRequest extends FormRequest
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
    #[ArrayShape(['state_id' => "array", 'city_id' => "array", 'area_id' => "array", 'street' => "string[]"])] public function rules(): array
    {
        return [
            //
            'state_id' => ['required', Rule::exists('states', 'id')],
            'city_id' => ['required', Rule::exists('cities', 'id')],
            'area_id' => ['required', Rule::exists('areas', 'id')],
            'street' => ['required', 'string', 'min:4']
        ];
    }
}
