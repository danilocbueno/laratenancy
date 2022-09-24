<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterTenantRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'company' => ['required', 'string', 'max:255'],
            'domain' => ['required', 'string', 'max:100', 'regex:/^[0-9A-Za-z.\-_]+$/u', 'unique:domains'],
        ];
    }

    protected function prepareForValidation()
    {
        $centralDomain = config('tenancy.central_domains')[0];
        $this->merge(['domain' => strtolower($this->domain . '.' . $centralDomain)]);
    }
}
