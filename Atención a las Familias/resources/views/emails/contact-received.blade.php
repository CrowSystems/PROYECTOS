<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nuevo mensaje desde el sitio</title>
</head>
<body style="font-family: Arial, sans-serif; color:#333; background:#f7f7f7; padding:20px;">
    <div style="max-width:600px; margin:auto; background:#fff; padding:24px; border-radius:8px;">
        <h2 style="color:#1F4E79; border-bottom:3px solid #F39C12; padding-bottom:0.5rem;">Nuevo mensaje desde el sitio web</h2>

        <p><strong>Nombre:</strong> {{ $message->name }}</p>
        <p><strong>Email:</strong> {{ $message->email }}</p>
        @if($message->phone)
        <p><strong>Teléfono:</strong> {{ $message->phone }}</p>
        @endif
        <p><strong>Asunto:</strong> {{ $message->subject }}</p>
        <hr>
        <p><strong>Mensaje:</strong></p>
        <p style="white-space: pre-line; background:#f4f6f9; padding:1rem; border-radius:6px;">{{ $message->message }}</p>

        <p style="font-size:0.85rem; color:#777; margin-top:1.5rem;">
            Enviado desde {{ config('app.name') }} el {{ $message->created_at->format('d/m/Y H:i') }}.
        </p>
    </div>
</body>
</html>
