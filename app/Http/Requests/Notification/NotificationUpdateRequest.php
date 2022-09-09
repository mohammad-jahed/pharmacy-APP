<?php

namespace App\Http\Requests\Notification;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class NotificationUpdateRequest extends FormRequest
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
    #[ArrayShape(['sender_id' => "array", 'receiver_id' => "array", 'description_en' => "string[]", 'description_ar' => "string[]"])]
    public function rules(): array
    {
        return [
            //
            'sender_id' => [Rule::exists('users', 'id')],
            'receiver_id' => [Rule::exists('users', 'id')],
            'description_en' => ['string', 'min:6', 'max:255', 'nullable'],
            'description_ar' => ['string', 'min:6', 'max:255', 'nullable']

        ];
    }
}
