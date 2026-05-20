<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Diagnóstico de uploads</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 p-8">

<div class="max-w-3xl mx-auto bg-white rounded-xl shadow p-8">
    <h1 class="text-2xl font-bold text-slate-800 mb-2">Diagnóstico de uploads de PHP</h1>
    <p class="text-sm text-slate-500 mb-6">
        Esta página sólo se ve en entorno local. Verifica si PHP puede recibir y guardar archivos correctamente.
    </p>

    <table class="w-full text-sm">
        @foreach($info as $label => $value)
            @php
                $bad = in_array($value, ['NO', 'NO CARGADO'], true)
                       || str_starts_with((string)$value, 'NO ')
                       || str_contains((string)$value, 'NO CARGADO');
            @endphp
            <tr class="border-b">
                <td class="py-2 font-medium text-slate-700 w-1/2">{{ $label }}</td>
                <td class="py-2 {{ $bad ? 'text-red-600 font-bold' : 'text-slate-800' }}">
                    {{ $value }}
                </td>
            </tr>
        @endforeach
    </table>

    <div class="mt-8 p-4 bg-amber-50 border border-amber-200 rounded text-sm text-amber-800">
        <p class="font-bold mb-2">¿Qué buscar?</p>
        <ul class="list-disc pl-5 space-y-1">
            <li>Todos los renglones marcados en <span class="text-red-600 font-bold">rojo</span> indican un problema.</li>
            <li><strong>upload_tmp_dir</strong> debe existir y ser escribible.</li>
            <li><strong>storage/app/public</strong> debe ser escribible para guardar logos/imágenes.</li>
            <li>Si <strong>public/storage</strong> no existe, ejecuta <code class="bg-slate-200 px-1 rounded">php artisan storage:link</code>.</li>
            <li>Si modificaste php.ini pero los valores siguen viejos, <strong>verifica que sea el php.ini cargado</strong> y reinicia Laragon.</li>
        </ul>
    </div>
</div>

</body>
</html>
