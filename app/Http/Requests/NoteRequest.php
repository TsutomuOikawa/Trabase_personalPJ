<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
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
          'pref_id' => 'required|integer|max:47',
          'title' => 'required|string|max:255',
          'thumbnail' => 'nullable|image|mimes:jpg,png,gif,webp|max:10240',
          'text' => 'required|json'
        ];
    }
}
