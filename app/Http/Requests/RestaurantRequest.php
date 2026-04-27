<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RestaurantRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255',],
            'restaurant_type_id' => ['required', Rule::exists('restaurant_types', 'id')],
            'user_id' => ['required', Rule::exists('users', 'id')],
            'logo' => ['nullable' ,'image', 'max:1024', 'mimes:png,jpg,jpeg'],
            'currency_id' => ['required', Rule::exists('currencies', 'id')],
            'delivery_fee' => ['numeric'],
            'service_fee' => ['numeric'],
        ];
    }
}
