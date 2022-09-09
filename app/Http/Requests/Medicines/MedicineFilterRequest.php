<?php

namespace App\Http\Requests\Medicines;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class MedicineFilterRequest extends FormRequest
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

    #[ArrayShape(['medicine_name' => "string[]", 'material_ids' => "string[]", 'material_ids.*' => "array", 'company_name' => "string[]"])]
    public function rules(): array

    {
        return [
            //
            'medicine_name'=>['sometimes','bail','string','min:2','max:255'],
            'material_ids'=>['sometimes','array'],
            'material_ids.*'=>['sometimes','bail','min:1',Rule::exists('materials','id')],
            'company_name'=>['sometimes','bail','string','min:2','max:255']

        ];
    }
}
