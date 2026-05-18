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
            'title' => 'Contacto | ' . config('app.name'),
            'description' => 'Ponte en contacto con el Centro de Apoyo para la Familia A.C. Agenda una cita en cualquiera de nuestras dos sedes.',
            'keywords' => 'contacto, CAF, asesoría legal, apoyo psicológico, asistencia social, Juárez, Chihuahua',
            'og_image' => asset('images/contact.jpg'),
        ];

        // Genera un CAPTCHA matemático y lo guarda en sesión
        $a = random_int(1, 9);
        $b = random_int(1, 9);
        session(['captcha_answer' => $a + $b]);

        return view('pages.contact', compact('seo'))
            ->with('captchaA', $a)
            ->with('captchaB', $b);
    }

    public function store(StoreContactRequest $request)
    {
        $data = $request->safe()->except(['captcha', 'website']);
        $message = ContactMessage::create($data);

        // Limpia el CAPTCHA usado
        session()->forget('captcha_answer');

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
