<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->roles === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = $this->route('user');

        if ($this->isMethod('POST')) {
            return [
                'name'=>'required|string|max:255',
                'email'=>'required|string|email|max:255|unique:users,email',
                'password'=>'required|string|min:8',
                'roles'=>'sometimes|in:admin,funcionario',
            ];
        }

        return [
            'name'=>'sometimes|string|max:255',
            'email'=>['sometimes','string','email','max:255',
                Rule::unique('users')->ignore($user ? $user->id : null),
            ],
            'password'=>'sometimes|string|min:8',
            'roles'=>'sometimes|in:admin,funcionario',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.max'      => 'O nome não pode ter mais de 255 caracteres.',

            'email.required' => 'Por favor, informe um endereço de e-mail.',
            'email.email'    => 'O endereço de e-mail informado não é válido.',
            'email.unique'   => 'Este e-mail já está sendo utilizado por outro usuário.',

            'password.required' => 'O campo senha é obrigatório.',
            'password.min'      => 'A senha deve ter no mínimo 8 caracteres.',
        ];
    }
}
