@extends('layouts.app')

@section('content')

<section class="hero-simple">
    <div class="container">
        <h1>Política de Cookies</h1>
        <p class="lead">Información sobre el uso de cookies en este sitio web.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="legal-content">

            <div class="legal-meta">
                <strong>Responsable:</strong> {{ $institutional['name'] }}<br>
                <strong>Última actualización:</strong> {{ now()->translatedFormat('d \\d\\e F \\d\\e Y') }}<br>
                <strong>Contacto:</strong> <a href="mailto:{{ $institutional['email'] }}">{{ $institutional['email'] }}</a>
            </div>

            <h2>1. ¿Qué son las cookies?</h2>
            <p>
                Las cookies son pequeños archivos de texto que los sitios web envían al dispositivo
                desde el cual usted accede (computadora, teléfono o tableta) con el fin de almacenar
                información sobre su visita. Esta información puede ser utilizada posteriormente para
                reconocerle, recordar sus preferencias o mejorar su experiencia de navegación.
            </p>
            <p>
                El uso de cookies se rige en México por la <strong>Ley Federal de Protección de Datos
                Personales en Posesión de los Particulares (LFPDPPP)</strong>, su Reglamento y los
                Lineamientos del Aviso de Privacidad emitidos por el Instituto Nacional de Transparencia,
                Acceso a la Información y Protección de Datos Personales (<strong>INAI</strong>).
            </p>

            <h2>2. ¿Por qué utilizamos cookies?</h2>
            <p>En el {{ $institutional['name'] }} (en adelante <strong>“CAF”</strong>) utilizamos cookies para:</p>
            <ul>
                <li>Permitir el funcionamiento técnico del sitio (sesión, formularios, seguridad).</li>
                <li>Recordar sus preferencias (idioma, aceptación del aviso de cookies).</li>
                <li>Analizar de forma agregada y anónima cómo se usa el sitio, para mejorarlo.</li>
                <li>Prevenir abusos, fraudes o ataques automatizados (bots).</li>
            </ul>
            <p>
                <strong>No utilizamos cookies con fines publicitarios ni vendemos los datos de navegación
                a terceros.</strong>
            </p>

            <h2>3. Tipos de cookies que usamos</h2>

            <table>
                <thead>
                    <tr><th>Tipo</th><th>Finalidad</th><th>Duración</th><th>¿Es opcional?</th></tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Técnicas o necesarias</strong></td>
                        <td>Permitir la sesión del usuario, validar el formulario de contacto, recordar el CAPTCHA y mantener la seguridad del sitio (token CSRF).</td>
                        <td>Sesión</td>
                        <td>No, son indispensables.</td>
                    </tr>
                    <tr>
                        <td><strong>De preferencias</strong></td>
                        <td>Recordar su elección sobre este aviso de cookies (<code>caf_cookie_consent</code>).</td>
                        <td>12 meses</td>
                        <td>Sí.</td>
                    </tr>
                    <tr>
                        <td><strong>De análisis (opcional)</strong></td>
                        <td>Estadísticas anónimas de uso del sitio. Actualmente <em>no están activas</em>, pero podrían incorporarse mediante Google Analytics u otra herramienta similar, previa aceptación.</td>
                        <td>Hasta 24 meses</td>
                        <td>Sí.</td>
                    </tr>
                </tbody>
            </table>

            <h2>4. Consentimiento</h2>
            <p>
                Al ingresar por primera vez al sitio, se muestra un aviso emergente donde puede:
            </p>
            <ul>
                <li><strong>Aceptar todas</strong> las cookies.</li>
                <li>Permitir <strong>únicamente las necesarias</strong>.</li>
                <li>Consultar esta política para conocer más detalles.</li>
            </ul>
            <p>
                Su elección se almacena localmente en su navegador. Puede revocar su consentimiento en
                cualquier momento desde
                <a href="#" id="reopen-cookie-banner"><strong>este enlace</strong></a>, lo cual reabrirá el aviso de cookies.
            </p>

            <h2>5. ¿Cómo gestionar o eliminar las cookies?</h2>
            <p>
                Puede configurar las cookies directamente desde su navegador. A continuación se incluyen
                enlaces a las instrucciones oficiales de los más utilizados:
            </p>
            <ul>
                <li><a href="https://support.google.com/chrome/answer/95647" target="_blank" rel="noopener">Google Chrome</a></li>
                <li><a href="https://support.mozilla.org/es/kb/Borrar%20cookies" target="_blank" rel="noopener">Mozilla Firefox</a></li>
                <li><a href="https://support.microsoft.com/es-es/microsoft-edge/eliminar-las-cookies-en-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09" target="_blank" rel="noopener">Microsoft Edge</a></li>
                <li><a href="https://support.apple.com/es-mx/guide/safari/sfri11471/mac" target="_blank" rel="noopener">Safari</a></li>
            </ul>
            <p>
                Si decide deshabilitar las cookies necesarias, algunas funciones del sitio podrían dejar
                de operar correctamente.
            </p>

            <h2>6. Derechos ARCO</h2>
            <p>
                Conforme a la LFPDPPP, usted tiene derecho a conocer qué datos personales tenemos de
                usted, para qué los utilizamos y las condiciones del uso que les damos
                (<strong>Acceso</strong>). Asimismo, es su derecho solicitar la corrección de su
                información en caso de que esté desactualizada, inexacta o incompleta
                (<strong>Rectificación</strong>); que la eliminemos de nuestros registros o bases de
                datos cuando considere que la misma no está siendo utilizada conforme a los principios,
                deberes y obligaciones previstas en la normativa (<strong>Cancelación</strong>); así
                como oponerse al uso de sus datos personales para fines específicos
                (<strong>Oposición</strong>).
            </p>
            <p>
                Para ejercer cualquiera de estos derechos, envíe un correo a
                <a href="mailto:{{ $institutional['email'] }}">{{ $institutional['email'] }}</a>
                con el asunto <em>"Derechos ARCO"</em>. Consulte el procedimiento completo en nuestro
                <a href="{{ route('legal.privacy') }}">Aviso de Privacidad</a>.
            </p>

            <h2>7. Cambios a esta política</h2>
            <p>
                Nos reservamos el derecho de modificar esta política para adecuarla a novedades
                legislativas, jurisprudenciales o de práctica empresarial. En tal caso, publicaremos
                los cambios en este mismo sitio con la nueva fecha de actualización en la parte superior.
            </p>

            <h2>8. Contacto</h2>
            <p>
                Si tiene preguntas o quejas sobre esta política de cookies, puede ponerse en contacto
                con nosotros:
            </p>
            <ul>
                <li><strong>Correo:</strong> <a href="mailto:{{ $institutional['email'] }}">{{ $institutional['email'] }}</a></li>
                @foreach($locations as $loc)
                    <li><strong>{{ $loc['name'] }}:</strong> {{ $loc['address'] }} — Tel. {{ $loc['phone'] }}</li>
                @endforeach
            </ul>

            <p style="margin-top:2rem;">
                <a href="{{ route('legal.privacy') }}" class="btn btn-primary">Leer el Aviso de Privacidad completo</a>
            </p>
        </div>
    </div>
</section>

@endsection
