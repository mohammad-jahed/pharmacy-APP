<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class PharmacyFilterRequest extends FormRequest
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
    #[ArrayShape(['state_name' => "string[]", 'city_name' => "string[]", 'area_name' => "string[]", 'street' => "string[]", 'day_off' => "string[]", 'from' => "string[]", 'to' => "string[]"])]
    public function rules(): array
    {
        return [
            //
            'state_name'=>['bail','string','min:2','max:255'],
            'city_name'=>['bail','string','min:2','max:255'],
            'area_name'=>['bail','string','min:2','max:255'],
            'street'=>['bail','string','min:2','max:255'],
            'day_off'=>['bail','integer'],
        ];
    }
}
