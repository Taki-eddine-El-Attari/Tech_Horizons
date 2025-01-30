<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as Rule;
use App\Enumérations\Role;

class UserRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'string', 'between:5,255'],
            'role' => ['required', Rule::in(Role::values())],
            'theme_id' => 'required_if:role,Responsable|exists:themes,id',
        ];

        if ($this->isMethod('POST')) {
            // Création
            $rules['email'] = ['required', 'email', 'unique:users'];
            $rules['password'] = ['required', 'string', 'min:8'];
        } else {
            // Modification
            $rules['email'] = ['nullable', 'email'];
            $rules['password'] = ['nullable', 'string', 'min:8'];
        }
        

        return $rules;
    }

    public function message(): array
    {
        return [
            'name.required' => 'Le nom est obligatoire',
            'name.string' => 'Le nom doit être une chaîne de caractères',
            'name.between' => 'Le nom doit être compris entre 5 et 255 caractères',
            'email.required' => 'L\'email est obligatoire',
            'email.email' => 'L\'email doit être une adresse email valide',
            'email.unique' => 'Cet email est déjà utilisé',
            'password.required' => 'Le mot de passe est obligatoire',
            'password.string' => 'Le mot de passe doit être une chaîne de caractères',
            'password.min' => 'Le mot de passe doit faire au moins 8 caractères',
            'theme_id.required_if' => 'Le thème est obligatoire pour un Responsable',
            'theme_id.exists' => 'Le thème sélectionné n\'existe pas',
        ];
    }

}
