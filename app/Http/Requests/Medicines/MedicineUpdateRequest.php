<?php

namespace App\Http\Requests\Medicines;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
    public function rules(): array
    {
        return [
            'shelf_names' => ['sometimes', 'array'],
            'shelf_names.*' => ['bail', 'string', 'min:2', 'max:255'],
            'company_name' => ['bail','sometimes','string', 'min:3', 'max:255'],
            'material_ids' => ['sometimes', 'array'],
            'material_ids.*' => ['bail', 'min:1', Rule::exists('materials', 'id')],
            'alternative_ids' => ['sometimes', 'array'],
            'alternative_ids.*' => ['bail', 'min:1', 'integer', Rule::exists('medicines', 'id')],
            'name_en' => ['sometimes','bail','min:3', 'max:30', 'string'],
            'name_ar' => ['sometimes','bail','min:3', 'max:30', 'string'],
            'quantity' => ['numeric'],
            'pills' => ['numeric'],
            'expiration_date' => ['date_format:Y-m-d'],
            'c_price' => ['numeric'],
            'price' => ['numeric', 'min:0']
        ];
    }
}
