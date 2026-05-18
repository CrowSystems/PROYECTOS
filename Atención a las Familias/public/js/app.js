// Menú móvil
document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('.menu-toggle');
    const links = document.querySelector('.nav-links');
    if (toggle && links) {
        toggle.addEventListener('click', () => links.classList.toggle('open'));
    }

    // Auto-cierre de alertas
    document.querySelectorAll('.alert').forEach(el => {
        setTimeout(() => { el.style.transition = 'opacity .5s'; el.style.opacity = '0'; setTimeout(() => el.remove(), 500); }, 6000);
    });
});
