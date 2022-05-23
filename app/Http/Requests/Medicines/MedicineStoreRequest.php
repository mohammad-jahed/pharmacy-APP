<?php

namespace App\Http\Requests\Medicines;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class MedicineStoreRequest extends FormRequest
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
    #[ArrayShape(['shelf_name' => "string", "alternative_id" => 'array', 'company_name' => "string", 'name' => "string[]", 'quantity' => "string[]", 'pills' => "string[]", 'expiration_date' => "string[]", 'c_price' => "string[]", 'price' => "string[]"])]
    public function rules(): array
    {
        return [
            //
            'shelf_name' => ['string', 'min:2', 'max:255'],
            'company_name' => ['string', 'min:3', 'max:255'],
            'alternative_id' => ['integer','numeric',Rule::exists('medicines', 'id')],
            'name' => ['required', 'min:3', 'max:30', 'string'],
            'quantity' => ['numeric'],
            'pills' => ['numeric'],
            'expiration_date' => ['required', 'date_format:Y-m-d'],
            'c_price' => ['numeric'],
            'price' => ['numeric']
        ];
    }
}
