<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTenantRequest extends FormRequest
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
            'firstname' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'username' => ['required', 'alpha_num', 'unique:users'],
            'domain' => ['required', 'alpha_num', 'unique:users'],
        ];
    }
}
