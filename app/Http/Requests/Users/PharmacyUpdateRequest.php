<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PharmacyUpdateRequest extends FormRequest
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
    public function rules(): array
    {
        return [

            //
            'state_id' => ['bail', 'min:1', Rule::exists('states', 'id')],
            'city_id' => ['bail', 'min:1', Rule::exists('cities', 'id')],
            'area_id' => ['bail', 'min:1', Rule::exists('areas', 'id')],
            'street' => ['bail', 'string', 'min:3', 'max:75'],
            'day' => ['numeric', 'min:0', 'max:6'],
            'from' => ['date_format:H:i'],
            'to' => ['date_format:H:i'],
            'imagePath' => ['sometimes','bail','image', 'max:10240'],
            'username' => ['unique:users,username', 'string', 'min:3', 'max:12'],
            'email' => ['email', 'unique:users'],
            'old_password' => ['bail', 'min:8', 'max:75','password'],
            'contact_information'=>['sometimes','array'],
            'contact_information.*'=>['bail','number'],
            'new_password' => ['bail', 'min:8', 'max:75', 'required_if:old_password,!=,null']
        ];
    }
}
