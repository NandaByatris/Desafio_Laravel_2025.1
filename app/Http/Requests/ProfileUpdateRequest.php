<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],

            'telefone' => ['string', 'max:20'], 
            'data_nascimento' => ['date'], 
            'cpf' => [
                'required',
                'string',
                'max:11',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'saldo' => ['required', 'numeric', 'min:0'], 
            'imagem' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'], 
            
        ];
    }
}
