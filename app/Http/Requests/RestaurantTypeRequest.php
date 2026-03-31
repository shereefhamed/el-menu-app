<?php

namespace App\Http\Requests;

use App\Models\RestaurantType;
use Illuminate\Foundation\Http\FormRequest;

class RestaurantTypeRequest extends FormRequest
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
            'name_en' => ['required', 'max:255', 'unique:' . RestaurantType::class . ',name_en'],
            'name_ar' => ['required', 'max:255', 'unique:' . RestaurantType::class . ',name_ar'],
        ];
    }
}
