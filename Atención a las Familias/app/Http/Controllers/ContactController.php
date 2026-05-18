<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Mail\ContactReceived;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        $seo = [
            'title' => 'Contacto | Asociación Valores en Familia A.C.',
            'description' => 'Ponte en contacto con nosotros. Estamos para escucharte y colaborar contigo en favor de la familia.',
            'keywords' => 'contacto, asociación civil, voluntariado, donaciones',
            'og_image' => asset('images/contact.jpg'),
        ];

        return view('pages.contact', compact('seo'));
    }

    public function store(StoreContactRequest $request)
    {
        $message = ContactMessage::create($request->validated());

        // Enviar email al admin si la configuración de correo está lista
        try {
            Mail::to(config('mail.admin_address'))
                ->send(new ContactReceived($message));
        } catch (\Throwable $e) {
            \Log::warning('No se pudo enviar el email de contacto: ' . $e->getMessage());
        }

        return redirect()
            ->route('contact')
            ->with('success', '¡Gracias por escribirnos! Te responderemos a la brevedad.');
    }
}
