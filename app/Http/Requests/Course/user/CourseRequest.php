<?php

namespace App\Http\Requests\Course\user;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'admin_id' => 'required|exists:admins,id',
            'dept_id' => 'required|exists:departments,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:510',
        ];
    }
}
