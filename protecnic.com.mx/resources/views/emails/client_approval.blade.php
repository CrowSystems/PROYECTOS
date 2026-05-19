<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de servicio</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f3f4f6; padding:20px;">
    <div style="max-width:600px; margin:0 auto; background:#fff; padding:24px; border-radius:8px;">
        <h2 style="color:#1e293b;">Reporte de servicio {{ $report->code }}</h2>
        <p>Hola {{ $report->client?->name }},</p>
        <p>
            Te enviamos una copia del reporte de servicio firmado el
            <strong>{{ optional($report->client_signed_at)->format('d/m/Y H:i') }}</strong>
            por {{ $report->client_signed_name ?? 'el cliente' }}.
        </p>

        <table style="width:100%; border-collapse:collapse; font-size:14px; margin:16px 0;">
            <tr><td style="padding:6px 0;"><strong>Técnico:</strong></td><td>{{ $report->technician?->name }}</td></tr>
            <tr><td style="padding:6px 0;"><strong>Máquina:</strong></td><td>{{ $report->machine?->name ?? $report->machine_name_snapshot }}</td></tr>
            <tr><td style="padding:6px 0;"><strong>Tipo de producto:</strong></td><td>{{ $report->product_type_snapshot ?? $report->product?->product_type }}</td></tr>
            <tr><td style="padding:6px 0;"><strong>Fecha:</strong></td><td>{{ optional($report->service_date)->format('d/m/Y') }}</td></tr>
        </table>

        @if($report->observations)
            <p><strong>Observaciones:</strong></p>
            <p style="background:#f9fafb; padding:12px; border-radius:6px;">{{ $report->observations }}</p>
        @endif

        <p style="margin-top:24px;">
            Para completar el proceso, por favor da una <strong>segunda confirmación de aprobación</strong>:
        </p>

        <p style="text-align:center; margin:24px 0;">
            <a href="{{ route('client.approval.show', $report->client_approval_token) }}"
               style="background:#059669; color:#fff; padding:12px 24px; border-radius:6px; text-decoration:none;">
                Revisar y aprobar reporte
            </a>
        </p>

        <p style="font-size:12px; color:#64748b;">
            Si no esperabas este correo, ignóralo. El enlace es único e intransferible.
        </p>
    </div>
</body>
</html>
