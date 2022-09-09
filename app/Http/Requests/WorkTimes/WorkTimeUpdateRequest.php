<?php

namespace App\Http\Requests\WorkTimes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class WorkTimeUpdateRequest extends FormRequest
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
    #[ArrayShape(['user_id' => "array", 'day' => "string[]", 'from' => "string[]", 'to' => "string[]"])] public function rules(): array
    {
        return [
            //
            'user_id' => [Rule::exists('users', 'id')],
            'day' => ['numeric', 'digits_between:0,6'],
            'from' => ['date_format:H:i'],
            'to' => ['date_format:H:i'],
        ];
    }
}
