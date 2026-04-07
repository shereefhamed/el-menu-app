<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        $rules = [
            'name_en' => ['required', 'string', 'max:255', ],
            'name_ar' => ['required', 'string', 'max:255', ],
            'thumbnail' => ['image', 'mimes:png,jpg, jpeg', 'max:1024'],
        ];
        if (Auth::user()->isAdmin()) {
            $rules['restaurant_id'] = ['required', 'exists:restaurants,id'];
        }
        return $rules;
    }
}
