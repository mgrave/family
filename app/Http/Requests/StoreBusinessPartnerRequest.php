<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBusinessPartnerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:200',
            'last_name' => 'max:200',
            'status' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Campo no puede estar vacío',
            'first_name.max' => 'Maximo 200 caracteres.',
            'last_name.max' => 'Maximo 200 caracteres.',
            'status.required' => 'Campo no puede estar vacío',
            'status.boolean' => 'Solo puede ser activo o inactivo',
        ];
    }
}
