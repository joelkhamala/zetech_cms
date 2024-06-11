<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinanceRequest extends FormRequest
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
            'email' => ['required', 'email', 'max:255'],
            'department_id' => ['required', 'integer', 'max:255'],
            'program_id' => ['required', 'integer', 'max:255'],
            'officer_id' => ['integer', 'max:255'],
            'gown_fees' => ['integer', 'max:255'],
            'school_fees' => ['integer', 'max:255'],
        ];
    }
}
