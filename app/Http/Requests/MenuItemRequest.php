<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MenuItemRequest extends FormRequest
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
            'name_en' => ['required', 'string', 'max:255',],
            'name_ar' => ['required', 'string', 'max:255',],
            'description_en' => ['nullable', 'string'],
            'description_ar' => ['nullable', 'string'],
            'thumbnail' => [ $this->isMethod('post') ? 'required' : 'nullable' , 'image', 'mimes:png,jpg, jpeg', 'max:1024'],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'attributes.*.id' => 'exists:attributes,id',
            'attributes.*.price' => 'nullable|numeric|min:0',
            'addons' => 'nullable|array',
            'addons.*' => 'exists:addons,id',
        ];
        if (Auth::user()->isAdmin()) {
            $rules['restaurant_id'] = ['required', 'exists:restaurants,id'];
        }
        return $rules;
    }
}
