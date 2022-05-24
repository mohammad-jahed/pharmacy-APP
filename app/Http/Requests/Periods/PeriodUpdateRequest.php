<?php

namespace App\Http\Requests\Periods;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class PeriodUpdateRequest extends FormRequest
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
    #[ArrayShape(['name_en' => "string[]", 'name_ar' => "string[]"])]
    public function rules(): array
    {
        return [
            //
            'name_en' => ['string', 'min:3', 'max:256'],
            'name_ar' => ['string', 'min:3', 'max:256']
        ];
    }
}
