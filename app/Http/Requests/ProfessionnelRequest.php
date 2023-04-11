<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfessionnelRequest extends FormRequest
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
            'prenom' => ['required', 'string', 'max:25'],
            'nom' => ['required', 'string', 'max:40'],
            'cp' => ['required', 'string', 'min:5','max:5'],
            'ville' => ['required', 'string', 'max:38'],
            'telephone' => ['required', 'string', 'max:14'],
            'email' => ['required', 'email' => 'email:rfc,dns'],
            'naissance' => ['required', 'date_format:Y-m-d'],
            'formation' => ['required'],
            'domaine' => ['required'],
            'pdf' => ['nullable', 'file', 'mimes:pdf'],
            'metier_id' => ['required'],
            // Pour relation 1,n 1n Professionnel - Competence
            'comp' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'metier_id.required' => 'Le métier est obligatoire',
            'comp.required' => 'La compétence est obligatoire',

        ];
    }
}
