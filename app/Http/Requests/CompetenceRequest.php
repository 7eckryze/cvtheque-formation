<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompetenceRequest extends FormRequest
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
    //https://laravel.com/docs/9.x/validation#available-validation-rules
    public function rules()
    {
        return [
            'intitule' => ['required','string', 'max:120'],
            'description' => ['required','string', 'max:500'],
        ];
    }
}
