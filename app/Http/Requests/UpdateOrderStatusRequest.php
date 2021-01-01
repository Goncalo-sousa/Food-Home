<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderStatusRequest extends FormRequest
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
            
            // 'status' => 'required',
            // 'customer_id' => 'required',
            // 'notes' => 'optional',
            // 'total_price' => 'required',
            // 'date' => 'nullable|date',
            // 'prepared_by'=>'nullable|date',
            // 'delivered_by'=>'nullable|date',
        ];
    }
}
