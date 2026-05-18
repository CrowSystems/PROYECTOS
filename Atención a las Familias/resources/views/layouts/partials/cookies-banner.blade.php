<div id="cookie-banner" class="cookie-banner" style="display:none;" role="dialog" aria-label="Aviso de cookies" aria-live="polite">
    <div class="container">
        <div class="cookie-banner-inner">
            <div class="cookie-banner-text">
                <strong>Usamos cookies para mejorar tu experiencia.</strong>
                <p>
                    En el <strong>{{ $institutional['name'] }}</strong> utilizamos cookies propias y de terceros
                    con fines técnicos, de análisis y para mejorar el servicio. Puedes aceptar todas, rechazar las
                    opcionales o revisar más detalles en nuestra
                    <a href="{{ route('legal.cookies') }}">política de cookies</a>
                    y <a href="{{ route('legal.privacy') }}">aviso de privacidad</a>,
                    conforme a la Ley Federal de Protección de Datos Personales en Posesión de los Particulares.
                </p>
            </div>
            <div class="cookie-banner-actions">
                <button type="button" class="btn btn-primary btn-sm" data-cookie-action="accept">Aceptar todas</button>
                <button type="button" class="btn btn-secondary btn-sm" data-cookie-action="essentials" style="color:var(--color-primary);border-color:var(--color-primary);">Solo necesarias</button>
                <a href="{{ route('legal.cookies') }}" class="btn btn-sm" style="background:transparent;color:var(--color-primary);text-decoration:underline;">Configurar</a>
            </div>
        </div>
    </div>
</div>
