<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBankRequest extends FormRequest
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
            'bank_service_id' => 'required',
            'name' => 'required|max:100',
            'status' => 'required|boolean',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'bank_service_id.required' => 'Debes elegir un servicio de banco.',
            'name.required' => 'Campo obligatorio.',
            'name.max' => 'No debe ser mayor a 100 caracteres.',
            'status.required' => 'Campo obligatorio',
            'status.boolean' => 'El valor solo puede ser activo o inactivo.',
        ];
    }

}
