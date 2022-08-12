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
            'state_id' => ['required','bail', 'min:1', Rule::exists('states', 'id')],
            'city_id' => ['required','bail', 'min:1', Rule::exists('cities', 'id')],
            'area_id' => ['required','bail', 'min:1', Rule::exists('areas', 'id')],
            'street' => ['required', 'bail', 'min:3', 'max:255', 'string'],
            'day' => ['sometimes', 'bail', 'numeric', 'min:0', 'max:6'],
            'from' => ['sometimes', 'bail', 'date_format:H:i'],
            'to' => ['sometimes','bail','date_format:H:i'],
            'username' => ['bail','required','unique:users,username', 'string', 'min:3', 'max:12'],
            'email' => ['bail','required', 'email', 'unique:users'],
            'password' => ['bail','required', 'min:8', 'max:75'],
            'imagePath' => ['bail','image', 'max:10240']
        ];
    }
}

