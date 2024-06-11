<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LibraryRequest extends FormRequest
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
            'email' => ['required', 'string', 'max:255'],
            'book_title' => ['required', 'max:255'],
            'book_title' => ['required', 'max:255'],
            'book_name' => ['required', 'max:255'],
            'email' => ['required', 'string'],
            'book_author' => ['required', 'max:255'],
            'department_id' => ['required', 'integer', 'max:255'],
            'date_borrowed' => ['required'],
        ];
    }
}
