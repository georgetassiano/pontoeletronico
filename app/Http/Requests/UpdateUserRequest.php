<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        // Obtém o ID do usuário da rota
        $user = $this->route('user');
        $userId = $user ? $user->id : null;
        
        return [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $userId,
            'password' => 'sometimes|string|min:8',
            'position' => 'sometimes|string|max:255',
            'birth_date' => 'sometimes|date',
            'cpf' => 'sometimes|string|max:14|unique:users,cpf,' . $userId,
            'cep' => 'sometimes|string|max:9',
            'street' => 'sometimes|string|max:255',
            'number' => 'sometimes|string|max:10',
            'complement' => 'nullable|string|max:255',
            'district' => 'sometimes|string|max:255',
            'city' => 'sometimes|string|max:255',
            'state' => 'sometimes|string|max:2',
        ];
    }
}
