<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GiftRequest extends FormRequest
{
    /**
     * Autorise la requête
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Règles de validation
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:50',
            'url' => 'nullable|url:http,https',
            'details' => 'nullable|string',
            'price' => 'required|decimal:0,2|min:0',
        ];
    }

    /**
     * Messages d’erreur personnalisés
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Le nom est obligatoire.',
            'name.min' => 'Le nom doit contenir au moins 3 caractères.',
            'name.max' => 'Le nom ne peut pas dépasser 50 caractères.',
            'url.url' => 'L\'URL doit commencer par http:// ou https://.',
            'price.required' => 'Le prix est obligatoire.',
            'price.decimal' => 'Le prix doit être un nombre avec au maximum 2 décimales.',
            'price.min' => 'Le prix ne peut pas être négatif.',
        ];
    }
}
