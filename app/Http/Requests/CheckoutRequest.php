<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'order_type' => ['required', Rule::in(['dine_in', 'delivery', 'pickup'])],
            'table_number' => ['required_if:order_type,dine_in'],
            'address' => ['required_if:order_type,delivery'],
            'phone' => ['required_if:order_type,delivery,pickup'],
            'customer_name' => ['required_if:order_type,delivery,pickup']
        ];
    }
}
