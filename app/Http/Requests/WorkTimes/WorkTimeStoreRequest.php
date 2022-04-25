<?php

namespace App\Http\Requests\WorkTimes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class WorkTimeStoreRequest extends FormRequest
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
    #[ArrayShape(['user_id' => "array", 'day' => "string[]", 'from' => "string[]", 'to' => "string[]"])]
    public function rules(): array
    {
        return [
            //
            'user_id' => ['required', Rule::exists('users', 'id')],
            'day' => ['required', 'numeric', 'digits_between:0,6'],
            'from' => ['required', 'date_format:H:i'],
            'to' => ['required', 'date_format:H:i'],
        ];
    }
}
