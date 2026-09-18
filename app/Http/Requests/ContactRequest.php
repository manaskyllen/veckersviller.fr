<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => [
                'required',
                'string',
                'max:100',
            ],

            'last_name' => [
                'required',
                'string',
                'max:100',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'subject' => [
                'required',
                'string',
                'max:200',
            ],

            'message' => [
                'required',
                'string',
                'min:10',
                'max:5000',
            ],

            'privacy' => [
                'accepted',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'first_name' => 'prénom',
            'last_name' => 'nom',
            'email' => 'adresse e-mail',
            'phone' => 'téléphone',
            'subject' => 'objet',
            'message' => 'message',
            'privacy' => 'consentement',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Veuillez renseigner votre prénom.',
            'last_name.required' => 'Veuillez renseigner votre nom.',
            'email.required' => 'Veuillez renseigner votre adresse e-mail.',
            'email.email' => 'Veuillez renseigner une adresse e-mail valide.',
            'subject.required' => 'Veuillez renseigner l’objet de votre message.',
            'message.required' => 'Veuillez saisir votre message.',
            'message.min' => 'Votre message doit contenir au moins :min caractères.',
            'privacy.accepted' => 'Vous devez accepter la politique de confidentialité.',
        ];
    }

    public function getRedirectUrl(): string
    {
        $previousUrl = url()->previous();

        $path = parse_url($previousUrl, PHP_URL_PATH);

        if ($path === route('contact', [], false)) {
            return $previousUrl;
        }

        return $previousUrl . '#contact';
    }
}
