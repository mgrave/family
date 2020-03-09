<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTreasuryRequest extends FormRequest
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
            'business_partner_id' => 'required',
            'bank_id' => 'required',
            'type' => 'required|max:1',
            'amount' => 'required|numeric',
            'status' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'business_partner_id.required' => 'Campo obligatorio.',
            'bank_id.required' => 'Campo obligatorio.',
            'type.required' => 'Campo obligatorio.',
            'type.max' => 'Solo puede ser C o P.',
            'amount.required' => 'Campo obligatorio.',
            'amount.numeric' => 'El valor debe ser numerico.',
            'status.required' => 'Campo obligatorio.',
            'status.boolean' => 'El estado solo puede ser activo o inactivo.',
        ];
    }

}
