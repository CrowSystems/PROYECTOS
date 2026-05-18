@extends('layouts.app')

@section('content')

<section class="hero-simple">
    <div class="container">
        <h1>Aviso de Privacidad</h1>
        <p class="lead">Tratamiento de datos personales conforme a la LFPDPPP.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="legal-content">

            <div class="legal-meta">
                <strong>Responsable del tratamiento:</strong> {{ $institutional['name'] }} (en lo sucesivo <em>"CAF"</em>)<br>
                <strong>Domicilio para oír y recibir notificaciones:</strong>
                @if(!empty($locations[0]))
                    {{ $locations[0]['address'] }}
                @endif<br>
                <strong>Correo:</strong> <a href="mailto:{{ $institutional['email'] }}">{{ $institutional['email'] }}</a><br>
                <strong>Última actualización:</strong> {{ now()->translatedFormat('d \\d\\e F \\d\\e Y') }}
            </div>

            <p>
                El presente Aviso de Privacidad se emite en cumplimiento de lo dispuesto por la
                <strong>Ley Federal de Protección de Datos Personales en Posesión de los Particulares
                (LFPDPPP)</strong>, su Reglamento y los Lineamientos del Aviso de Privacidad publicados
                en el Diario Oficial de la Federación.
            </p>

            <h2>1. Identidad y domicilio del responsable</h2>
            <p>
                <strong>{{ $institutional['name'] }}</strong>, asociación civil sin fines de lucro
                con domicilio en
                @if(!empty($locations[0]))
                    {{ $locations[0]['address'] }},
                @endif
                es responsable del tratamiento (uso) de sus datos personales conforme a lo establecido
                en este Aviso.
            </p>

            <h2>2. Datos personales que se recaban</h2>
            <p>Para cumplir con las finalidades descritas en este aviso, podemos recabar las siguientes categorías de datos personales:</p>
            <ul>
                <li><strong>Datos de identificación:</strong> nombre completo, edad, género, estado civil.</li>
                <li><strong>Datos de contacto:</strong> correo electrónico, teléfono fijo, teléfono celular, domicilio.</li>
                <li><strong>Datos familiares y socioeconómicos:</strong> composición familiar, ocupación, condiciones de vida (en el caso de personas que solicitan atención de asistencia social, psicológica o legal).</li>
                <li><strong>Datos sensibles:</strong> en algunos casos, derivado de la naturaleza del servicio (apoyo psicológico, asistencia legal en temas familiares, atención a víctimas de violencia), podríamos recabar información sobre salud, situación emocional, religión, origen étnico u opiniones, que conforme al artículo 3, fracción VI, de la LFPDPPP, constituyen <strong>datos personales sensibles</strong>. Para su tratamiento solicitaremos su <strong>consentimiento expreso</strong>.</li>
                <li><strong>Datos de navegación:</strong> dirección IP, navegador, páginas visitadas, cookies, según se describe en nuestra <a href="{{ route('legal.cookies') }}">Política de Cookies</a>.</li>
            </ul>

            <h2>3. Finalidades del tratamiento</h2>
            <h3>Finalidades primarias (necesarias)</h3>
            <ul>
                <li>Brindar atención profesional en asesoría legal, apoyo psicológico y asistencia social.</li>
                <li>Agendar y dar seguimiento a las citas que usted solicite.</li>
                <li>Generar expedientes individuales o familiares confidenciales de las personas atendidas.</li>
                <li>Atender solicitudes, dudas, quejas o sugerencias recibidas por nuestros canales de contacto (formulario web, correo, teléfono).</li>
                <li>Cumplir con las obligaciones legales, fiscales y administrativas aplicables a la institución.</li>
                <li>Evaluar el impacto de nuestros programas y servicios.</li>
            </ul>
            <h3>Finalidades secundarias (opcionales)</h3>
            <p>Sus datos también podrán ser tratados, <em>solo si usted lo autoriza</em>, para:</p>
            <ul>
                <li>Enviarle información institucional, boletines, invitaciones a eventos y campañas de procuración de fondos.</li>
                <li>Realizar encuestas de satisfacción y mejora de servicios.</li>
                <li>Difundir, con su autorización expresa por escrito, testimonios o material gráfico en nuestras redes sociales y materiales institucionales.</li>
            </ul>
            <p>
                Si <strong>no desea</strong> que sus datos se utilicen para estas finalidades secundarias,
                puede manifestarlo enviando un correo a
                <a href="mailto:{{ $institutional['email'] }}">{{ $institutional['email'] }}</a>
                en cualquier momento. La negativa al uso para estas finalidades no será motivo para
                negarle los servicios solicitados.
            </p>

            <h2>4. Fundamento legal</h2>
            <p>
                Tratamos sus datos personales con base en los artículos 8, 9, 10, 11, 16, 17 y 36 de
                la LFPDPPP, y los artículos correspondientes de su Reglamento.
            </p>

            <h2>5. Transferencia de datos</h2>
            <p>
                CAF <strong>no transfiere ni comercializa</strong> sus datos personales con terceros.
                Únicamente podrá compartirlos cuando exista una <em>obligación legal</em> (por ejemplo,
                requerimiento de autoridad competente) o cuando, derivado del servicio prestado,
                resulte necesaria una canalización (por ejemplo, a una institución de salud pública,
                a la fiscalía, al DIF, o a un refugio para víctimas), informándole previamente y
                obteniendo, cuando aplique, su consentimiento.
            </p>

            <h2>6. Medios para ejercer los derechos ARCO</h2>
            <p>Usted tiene en todo momento derecho a:</p>
            <ul>
                <li><strong>Acceder</strong> a los datos personales que tengamos sobre usted.</li>
                <li><strong>Rectificarlos</strong> si están incompletos, inexactos o desactualizados.</li>
                <li><strong>Cancelarlos</strong> cuando ya no sean necesarios para las finalidades que motivaron su tratamiento.</li>
                <li><strong>Oponerse</strong> al uso de sus datos para finalidades específicas.</li>
            </ul>
            <p>Para ejercer cualquiera de estos derechos, deberá enviar una solicitud por correo electrónico a <a href="mailto:{{ $institutional['email'] }}">{{ $institutional['email'] }}</a> con la siguiente información:</p>
            <ul>
                <li>Nombre completo del titular y medio para recibir respuesta.</li>
                <li>Documento que acredite su identidad (copia simple de identificación oficial) o, en su caso, la representación legal.</li>
                <li>Descripción clara y precisa del derecho que desea ejercer y de los datos involucrados.</li>
                <li>Cualquier otro elemento que facilite la localización de sus datos.</li>
            </ul>
            <p>
                Responderemos su solicitud en un plazo máximo de <strong>20 días hábiles</strong>
                contados a partir de su recepción, conforme al artículo 32 de la LFPDPPP.
            </p>

            <h2>7. Revocación del consentimiento</h2>
            <p>
                En cualquier momento puede revocar el consentimiento que nos ha otorgado para el
                tratamiento de sus datos personales, en la medida en que ello sea legalmente posible.
                Para hacerlo, envíe su solicitud a
                <a href="mailto:{{ $institutional['email'] }}">{{ $institutional['email'] }}</a>.
            </p>

            <h2>8. Limitación del uso o divulgación</h2>
            <p>
                Si desea limitar el uso o divulgación de sus datos personales (por ejemplo, dejar
                de recibir comunicaciones), también puede solicitarlo por la misma vía. Adicionalmente,
                puede registrarse en el <strong>Registro Público de Consumidores (REPEP)</strong> de
                la PROFECO si lo que desea es dejar de recibir publicidad telefónica de cualquier
                tipo.
            </p>

            <h2>9. Uso de cookies y tecnologías similares</h2>
            <p>
                En nuestro sitio utilizamos cookies y tecnologías similares conforme se describe en la
                <a href="{{ route('legal.cookies') }}">Política de Cookies</a>. Estas tecnologías nos
                permiten recordar sus preferencias y, en su caso, analizar el uso del sitio.
            </p>

            <h2>10. Medidas de seguridad</h2>
            <p>
                CAF ha implementado medidas de seguridad administrativas, técnicas y físicas razonables
                para proteger sus datos personales contra daño, pérdida, alteración, destrucción,
                acceso, uso o tratamiento no autorizado. El personal que tiene acceso a información
                confidencial está sujeto a obligaciones de reserva y confidencialidad.
            </p>

            <h2>11. Cambios al Aviso de Privacidad</h2>
            <p>
                Cualquier modificación al presente Aviso será comunicada a través de este sitio web
                con la fecha de actualización correspondiente. Le sugerimos revisarlo periódicamente.
            </p>

            <h2>12. Autoridad reguladora</h2>
            <p>
                Si considera que su derecho a la protección de datos personales ha sido vulnerado, podrá
                acudir al <strong>Instituto Nacional de Transparencia, Acceso a la Información y
                Protección de Datos Personales (INAI)</strong>. Más información en
                <a href="https://home.inai.org.mx" target="_blank" rel="noopener">https://home.inai.org.mx</a>.
            </p>

            <p style="margin-top:2rem;">
                <a href="{{ route('legal.cookies') }}" class="btn btn-primary">Ver Política de Cookies</a>
                <a href="{{ route('contact') }}" class="btn btn-success">Contáctanos</a>
            </p>
        </div>
    </div>
</section>

@endsection
