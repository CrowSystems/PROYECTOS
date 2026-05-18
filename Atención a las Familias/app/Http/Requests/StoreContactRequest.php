<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

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
            'email'   => ['required', 'email:rfc', 'max:160'],
            'phone'   => ['nullable', 'string', 'max:30'],
            'subject' => ['required', 'string', 'min:3', 'max:160'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
            // Honeypot anti-bots: este campo debe llegar vacío
            'website' => ['nullable', 'size:0'],
            // CAPTCHA matemático
            'captcha' => ['required', 'integer'],
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
            'captcha.required' => 'Resuelve la operación para confirmar que no eres un robot.',
            'captcha.integer'  => 'La respuesta del CAPTCHA debe ser un número.',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($v) {
            $expected = session('captcha_answer');
            if ((int) $this->input('captcha') !== (int) $expected) {
                $v->errors()->add('captcha', 'Respuesta incorrecta del CAPTCHA. Intenta de nuevo.');
            }
        });
    }
}
