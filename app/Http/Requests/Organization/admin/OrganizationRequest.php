<?php

namespace App\Http\Requests\Organization\admin;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phoneNumber' => 'required|unique:organizations,phoneNumber',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:8',
            'logo' => 'required|text',
            'brandColor' => 'required|string|max:255',
        ];
    }
}