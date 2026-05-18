// =============================================================
// Centro de Apoyo para la Familia A.C. — Scripts del sitio
// =============================================================
document.addEventListener('DOMContentLoaded', () => {

    // ---------- Menú móvil ----------
    const toggle = document.querySelector('.menu-toggle');
    const links  = document.querySelector('.nav-links');
    if (toggle && links) {
        toggle.addEventListener('click', () => links.classList.toggle('open'));
    }

    // ---------- Auto-cierre de alertas ----------
    document.querySelectorAll('.alert').forEach(el => {
        setTimeout(() => {
            el.style.transition = 'opacity .5s';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 500);
        }, 6000);
    });

    // ---------- Banner de cookies ----------
    const COOKIE_KEY = 'caf_cookie_consent';   // 'all' | 'essentials' | null
    const banner = document.getElementById('cookie-banner');
    if (banner) {
        const consent = localStorage.getItem(COOKIE_KEY);
        if (!consent) {
            banner.style.display = 'block';
        }
        banner.querySelectorAll('[data-cookie-action]').forEach(btn => {
            btn.addEventListener('click', () => {
                const action = btn.getAttribute('data-cookie-action');
                localStorage.setItem(COOKIE_KEY, action);
                localStorage.setItem(COOKIE_KEY + '_at', new Date().toISOString());
                banner.style.transition = 'opacity .35s';
                banner.style.opacity = '0';
                setTimeout(() => banner.remove(), 350);
            });
        });
    }

    // Botón para reabrir preferencias (si existe en la página de cookies)
    const reopenBtn = document.getElementById('reopen-cookie-banner');
    if (reopenBtn) {
        reopenBtn.addEventListener('click', e => {
            e.preventDefault();
            localStorage.removeItem(COOKIE_KEY);
            location.reload();
        });
    }
});
