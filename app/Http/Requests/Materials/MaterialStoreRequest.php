<?php

namespace App\Http\Requests\Materials;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class MaterialStoreRequest extends FormRequest
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
    #[ArrayShape(['material_name' => "string[]"])]
    public function rules(): array
    {
        return [
            //
            'material_name' => ['required', 'string', 'min:2', 'max:255'],
        ];
    }
}
