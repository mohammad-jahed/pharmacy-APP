<?php

namespace App\Http\Requests\Medicines;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class MedicineUpdateRequest extends FormRequest
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
    #[ArrayShape(['shelf_id' => "array", 'company_id' => "array", 'name' => "string[]", 'quantity' => "string[]", 'pills' => "string[]", 'expiration_date' => "string[]", 'c_price' => "string[]", 'price' => "string[]"])]
    public function rules(): array
    {
        return [
            //

            'shelf_id' => [Rule::exists('shelves', 'id')],
            'company_id' => [Rule::exists('companies', 'id')],
            'name' => [ 'min:3', 'max:30', 'string'],
            'quantity' => ['numeric'],
            'pills' => ['numeric'],
            'expiration_date' => ['date_format:H:i'],
            'c_price' => ['numeric'],
            'price' => ['numeric']
        ];
    }
}
