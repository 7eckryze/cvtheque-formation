<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MetierRequest extends FormRequest
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
            'libelle' => ['required','string', 'max:120'],
            'description' => ['required','string', 'max:500'],
            'slug' => ['required','string', 'max:120', 'unique:metiers,slug'],
        ];
    }
}
