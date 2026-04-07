<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AddonRequest extends FormRequest
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
            'name_en' => ['required', 'string'],
            'name_ar' => ['required', 'string'],
            'price' => ['required', 'numeric', 'gt:0']
        ];
        if(Auth::user()->isAdmin()){
            $ownders = User::owners()->get();
            $rules['user_id'] = ['required', Rule::in($ownders->pluck('id'))];
        }   
        return $rules;
    }
}
