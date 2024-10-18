<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateSupplier extends FormRequest
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
            'name' => 'required|string|max:255',  
            'name_fantasy' => 'string|max:255',    
            'cnpj' => 'required|numeric|max:15',
            'image' => 'nullable|mimes:svg|max:2048',
            'phone' => 'required|number|max:12',    
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.string' => 'O nome deve ser uma string.',
            'name.max' => 'O nome não pode ter mais de 60 caracteres.',

            'cnpj.required' => 'O CNPJ é obrigatório.',
            'cnpj.numeric' => 'O CNPJ precisa ser numérico.',

            'image.image' => 'O arquivo deve ser uma imagem.',
            'image.mimes' => 'A imagem deve estar em um dos seguintes formatos: jpeg, png, jpg, gif.',
            'image.max' => 'A imagem não pode ser maior que 2MB.',
            
            'phone.required' => 'O telefone é obrigatório.',
            
        ];
    }
}
