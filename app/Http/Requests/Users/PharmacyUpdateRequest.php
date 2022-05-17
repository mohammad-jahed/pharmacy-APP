<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
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
            'state_id' => [Rule::exists('states', 'id')],
            'city_id' => [Rule::exists('cities', 'id')],
            'area_id' => [Rule::exists('areas', 'id')],
            'street' => ['string', 'min:3', 'max:75'],
            'day' => ['numeric', 'min:0', 'max:6'],
            'from' => ['date_format:H:i'],
            'to' => ['date_format:H:i'],
            'username' => ['unique:users,username', 'string', 'min:3', 'max:12'],
            'email' => ['email', 'unique:users'],
            'password' => ['min:8', 'max:75'],
            'imagePath' => ['image', 'max:10240']
        ];
    }
}
