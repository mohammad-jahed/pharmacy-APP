<?php

namespace App\Http\Requests\Reservations;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class ReservationUpdateRequest extends FormRequest
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
    #[ArrayShape(['medicine_id' => "array", 'pharmacy_id' => "array", 'period_id' => "array"])]
    public function rules(): array
    {
        return [
            //
            'medicine_id' => [Rule::exists('medicines', 'id')],
            'pharmacy_id' => [Rule::exists('users', 'id')],
            'period_id' => [Rule::exists('periods', 'id')]
        ];
    }
}
