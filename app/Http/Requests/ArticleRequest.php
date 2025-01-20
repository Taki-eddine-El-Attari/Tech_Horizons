<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule as Rule;

class ArticleRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->slug ?? $this->titre),
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(Request $request): array
    {
        return [
            'titre' => 'required|min:3|max:255',
            'slug' => ['required','min:3' , 'max:255', Rule::unique('articles')->ignore($this->article)],
            'contenu' => 'required|min:10',
            'image' => [Rule::requiredIf($request->isMethod('post')), 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'theme_id' => 'required|exists:themes,id',
            'numero_id' => 'required|exists:numeros,id',
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre est obligatoire',
            'titre.min' => 'Le titre doit faire au moins 3 caractères',
            'slug.required' => 'Le slug est obligatoire',
            'slug.unique' => 'Ce slug existe déjà',
            'contenu.required' => 'Le contenu est obligatoire',
            'contenu.min' => 'Le contenu doit faire au moins 10 caractères',
            'image.required' => "L'image est obligatoire",
            'image.image' => 'Le fichier doit être une image',
            'theme_id.required' => 'Le thème est obligatoire',
            'theme_id.exists' => 'Le thème sélectionné n\'existe pas',
            'numero_id.required' => 'Le numéro est obligatoire',
            'numero_id.exists' => 'Le numéro sélectionné n\'existe pas',
        ];
    }
}
