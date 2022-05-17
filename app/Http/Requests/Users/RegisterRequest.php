<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'state_id' => [Rule::exists('states', 'id'), 'nullable'],
            'city_id' => [Rule::exists('cities', 'id'), 'nullable'],
            'area_id' => [Rule::exists('areas', 'id'), 'nullable'],
            'street' => ['string'],
            'day' => ['numeric', 'min:0', 'max:6'],
            'from' => ['date_format:H:i'],
            'to' => ['date_format:H:i'],
            'username' => ['required', 'unique:users', 'string', 'min:3', 'max:12'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'max:75'],
            'imagePath' => ['image', 'max:10240']
        ];
    }
}

