<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reporte aprobado</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4">
<div class="max-w-md mx-auto bg-white rounded-2xl shadow-xl p-8 text-center">
    <div class="text-6xl mb-4">✓</div>
    <h1 class="text-2xl font-bold text-emerald-700">¡Aprobación confirmada!</h1>
    <p class="text-slate-600 mt-3">
        Has aprobado el reporte <strong>{{ $report->code }}</strong>. Nuestro equipo continuará con el proceso interno.
    </p>
    <p class="text-sm text-slate-500 mt-4">Gracias por tu confianza.</p>
</div>
</body>
</html>
