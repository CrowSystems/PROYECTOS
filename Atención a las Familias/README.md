# Centro de Atención a las Familias A.C. (CAF) — Sitio web Laravel 11

Sitio web institucional de **Centro de Atención a las Familias A.C.**, asociación civil sin fines de lucro cuyo lema es *Fortaleciendo Familias — Familias unidas, familias fuertes*.

**Paleta institucional:** rosa magenta (#E91E63), turquesa (#2BB8C4) y púrpura (#5E3B9E).

> Antes de levantar el servidor, guarda las imágenes que te compartió el equipo en `public/images/` siguiendo la guía en `public/images/README-IMAGENES.md`.

## Características incluidas

- 4 páginas públicas: Inicio, Nosotros, Programas (con detalle por programa), Contacto.
- SEO completo: meta tags, Open Graph, Twitter Cards y JSON-LD (schema.org NGO).
- Formulario de contacto con validación, anti-spam (honeypot), almacenamiento en BD y envío de correo al administrador.
- Íconos de redes sociales (Facebook, Instagram, Twitter/X, YouTube, WhatsApp) configurables vía `.env`.
- Panel administrativo con login: CRUD de programas + bandeja de mensajes.
- Paleta cálida y familiar: azul confianza, verde esperanza, naranja calidez.
- Responsive (mobile-first).
- Listo para uso comercial.

## Requisitos

- PHP 8.2+
- Composer 2+
- MySQL 8 (o MariaDB 10.4+)
- Node.js no requerido (CSS y JS son archivos planos)

## Instalación local

```bash
# 1. Instalar dependencias
composer install

# 2. Configurar entorno
copy .env.example .env
php artisan key:generate

# 3. Ajustar BD en .env (DB_DATABASE, DB_USERNAME, DB_PASSWORD)

# 4. Crear la BD (en MySQL)
#    CREATE DATABASE valores_familia CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# 5. Migraciones y datos iniciales
php artisan migrate --seed

# 6. Enlace para imágenes subidas
php artisan storage:link

# 7. Levantar servidor de desarrollo
php artisan serve
```

Visita: http://localhost:8000

## Acceso al panel administrativo

- URL:      http://localhost:8000/admin/login
- Email:    `admin@cafamilias.org`
- Password: `AdminCAF2026!`

> Cámbiala desde el panel o por base de datos antes de salir a producción.

## Configuración de correo

En `.env`, configura un servicio SMTP real (por ejemplo, Mailtrap para pruebas o Gmail/SendGrid para producción):

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=xxxx
MAIL_PASSWORD=xxxx
MAIL_FROM_ADDRESS=contacto@valoresfamilia.org
MAIL_ADMIN_ADDRESS=admin@valoresfamilia.org
```

Los mensajes del formulario se guardan en `contact_messages` y se envían al `MAIL_ADMIN_ADDRESS`.

## Redes sociales

Edita las URLs en `.env`:

```
SOCIAL_FACEBOOK=https://facebook.com/tuasociacion
SOCIAL_INSTAGRAM=https://instagram.com/tuasociacion
SOCIAL_TWITTER=https://twitter.com/tuasociacion
SOCIAL_YOUTUBE=https://youtube.com/@tuasociacion
SOCIAL_WHATSAPP=5215555555555
```

Si dejas una vacía, su ícono no se muestra.

## Estructura principal

```
app/
├─ Http/Controllers/         # Públicos + Admin + Auth
├─ Http/Middleware/EnsureUserIsAdmin.php
├─ Http/Requests/StoreContactRequest.php
├─ Models/                   # User, Program, ContactMessage
├─ Mail/ContactReceived.php
└─ Providers/AppServiceProvider.php

resources/views/
├─ layouts/                  # app, navbar, footer, social-icons
├─ pages/                    # home, about, programs, program-show, contact
├─ admin/                    # layout, dashboard, programs/, messages/
├─ auth/login.blade.php
└─ emails/contact-received.blade.php

database/
├─ migrations/               # users, programs, contact_messages, cache
└─ seeders/DatabaseSeeder.php

public/
├─ css/app.css
├─ js/app.js
└─ images/                   # coloca aquí tus imágenes (logo, hero, etc.)
```

## Páginas y rutas

| Ruta | Página |
|------|--------|
| `/` | Inicio |
| `/nosotros` | Nosotros (misión, visión, valores) |
| `/programas` | Listado de programas |
| `/programas/{slug}` | Detalle de programa |
| `/contacto` | Formulario de contacto |
| `/admin/login` | Acceso al panel |
| `/admin` | Dashboard administrativo |
| `/admin/programs` | CRUD de programas |
| `/admin/messages` | Bandeja de mensajes |

## Imágenes

Coloca tus imágenes en `public/images/`. El sitio referencia:
- `logo.png`
- `favicon.ico`
- `hero.jpg`, `about.jpg`, `programs.jpg`, `contact.jpg` (para Open Graph)
- `program-placeholder.jpg`

Las imágenes de cada programa subidas desde el admin se guardan en `storage/app/public/programs/` (asegúrate de correr `php artisan storage:link`).

## Despliegue a producción

1. Súbelo a tu hosting (cPanel, VPS, Forge, etc.) apuntando el dominio a `public/`.
2. `composer install --no-dev --optimize-autoloader`
3. `php artisan migrate --seed --force`
4. `php artisan storage:link`
5. `php artisan config:cache && php artisan route:cache && php artisan view:cache`
6. En `.env`: `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://tudominio.org`.

## Licencia

Uso comercial permitido. Código basado en Laravel (MIT).
