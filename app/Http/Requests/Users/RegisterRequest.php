<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

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
    #[ArrayShape(['address_id' => "array", 'work_times_id' => "array", 'name' => "string[]", 'username' => "string[]", 'email' => "string[]", 'password' => "string[]", 'imagePath' => "string[]"])] public function rules(): array
    {
        return [
            //
            'address_id' => [Rule::exists('addresses', 'id'), 'nullable'],
            'work_times_id' => [Rule::exists('work_times', 'id'), 'nullable'],
            'username' => ['required','unique:users', 'string', 'min:3', 'max:12'],
            'email' => ['required', 'email','unique:users'],
            'password' => ['required', 'min:8', 'max:75'],
            'imagePath' => ['image']//, 'dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000']
        ];
    }
}

