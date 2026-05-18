<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'min:3', 'max:120'],
            'email'   => ['required', 'email:rfc,dns', 'max:160'],
            'phone'   => ['nullable', 'string', 'max:30'],
            'subject' => ['required', 'string', 'min:3', 'max:160'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
            // Honeypot anti-spam
            'website' => ['nullable', 'size:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Tu nombre es obligatorio.',
            'email.required'   => 'Necesitamos un correo para responderte.',
            'email.email'      => 'Por favor, ingresa un correo válido.',
            'subject.required' => 'Cuéntanos brevemente el motivo.',
            'message.required' => 'Escribe tu mensaje.',
            'message.min'      => 'El mensaje debe tener al menos 10 caracteres.',
            'website.size'     => 'Detección de spam.',
        ];
    }
}
