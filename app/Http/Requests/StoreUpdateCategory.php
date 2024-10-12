<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCategory extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:60',    
            'codigo' => 'string|max:10',
            'icone' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string|max:250',    
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.string' => 'O nome deve ser uma string.',
            'name.max' => 'O nome não pode ter mais de 60 caracteres.',

            'codigo.max' => 'O código não pode ter mais de 10 caracteres.',

            'image.mimes' => 'A imagem deve estar em um dos seguintes formatos: jpeg, png, jpg, gif.',
            'icone.max' => 'O icone não pode ser maior que 2MB.',
            
            'description.string' => 'A descrição deve ser uma string.',
            'description.max' => 'A descrição não pode ter mais de 250 caracteres.',
        ];
    }
}
