<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|regex:/^[A-Za-záàâãéèêíóôõúçÁÀÂÃÉÈÍÓÔÕÚÇ ]+$/',
            'price' => 'required|regex:/^\d+(\,\d{1,2})?$/',
            'type' => 'required|regex:/hot dish|cold dish|drink|dessert/',
            'description'=>'required',
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
        ];
    }
}
