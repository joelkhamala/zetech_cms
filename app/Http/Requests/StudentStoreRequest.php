<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentStoreRequest extends FormRequest
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
            //
            'user_name' => ['required', 'string', 'max:255', 'unique:users'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role_id'  => ['required', 'integer','max:255'],
            'national_id' => ['required', 'integer','max:99999999'],
            'phone' => ['required','string'],
            'guardianPhone' => ['required','string'],
            'admissionNumber' => ['required','string'],
            'yearOfAdmission' => ['required','string'],
            'department_id' => ['required', 'integer', 'max:255'],
            'program_id' => ['required', 'integer', 'max:255'],
        ];
    }
}
