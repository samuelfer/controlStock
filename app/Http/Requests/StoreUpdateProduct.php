<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProduct extends FormRequest
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'value' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|digits_between:1,6|max:999999'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.string' => 'O nome deve ser uma string.',
            'name.max' => 'O nome não pode ter mais de 60 caracteres.',
            
            'image.image' => 'O arquivo deve ser uma imagem.',
            'image.mimes' => 'A imagem deve estar em um dos seguintes formatos: jpeg, png, jpg, gif.',
            'image.max' => 'A imagem não pode ser maior que 2MB.',
            
            'value.required' => 'O valor é obrigatório.',
           
            'category_id.required' => 'A categoria é obrigatória.',
            'category_id.exists' => 'A categoria selecionada não existe.',

            'quantity.required' => 'A quantidade é obrigatória.',
            'quantity.integer' => 'A quantidade deve ser um número inteiro.',
            'quantity.digits_between' => 'A quantidade deve ter entre 1 e 6 dígitos.',
            'quantity.max' => 'A quantidade não pode ser maior que 999999.',
        ];
    }
}
