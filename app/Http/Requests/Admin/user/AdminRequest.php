<?php

namespace App\Http\Requests\Admin\user;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'org_id' => 'required|exists:organizations,id',
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'phoneNumber' => 'required|unique:admins,phoneNumber',
            'gender' => 'required|in:Male,Female',
            'password' => 'required|min:8',
        ];
    }
}
