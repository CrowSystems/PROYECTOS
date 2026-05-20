<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name'   => ['required', 'string', 'max:80'],
            'last_name'    => ['required', 'string', 'max:80'],
            'company'      => ['required', 'string', 'max:120'],
            'email'        => ['required', 'email', 'max:150'],
            'country_code' => ['required', 'string', 'max:8'],
            'phone'        => ['required', 'string', 'max:30'],
            'country'      => ['required', 'string', 'max:80'],
            'state'        => [
                Rule::requiredIf(fn () => strtolower((string) $request->input('country')) === 'méxico'
                                       || strtolower((string) $request->input('country')) === 'mexico'),
                'nullable', 'string', 'max:80',
            ],
            'message'      => ['required', 'string', 'min:50', 'max:5000'],
        ], [
            'message.min'  => 'El mensaje debe tener al menos 50 caracteres.',
            'state.required' => 'Selecciona el estado de la república.',
        ]);

        ContactMessage::create([
            ...$data,
            'ip_address' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 255),
        ]);

        return redirect()
            ->route('public.home')
            ->withFragment('contacto')
            ->with('success', 'Mensaje enviado. Te contactaremos en breve.');
    }
}
