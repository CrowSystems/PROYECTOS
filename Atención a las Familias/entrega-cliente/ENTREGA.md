# ENTREGA TÉCNICA — Sitio web CAF

**Proyecto:** Centro de Apoyo para la Familia A.C. — Sitio web institucional
**Stack:** Laravel 11 + PHP 8.2+ + MySQL 8 + Blade + CSS nativo
**Fecha de entrega:** _(actualizar al exportar)_

---

## 1. Contenido de la entrega

| Carpeta / archivo                | Contenido |
|----------------------------------|-----------|
| `app/`                            | Modelos, controladores, middleware, requests, mailables |
| `bootstrap/`                      | Bootstrap de Laravel |
| `config/`                         | Configuración (app, auth, database, mail, session, filesystems) |
| `database/migrations/`            | 4 migraciones (users, programs, contact_messages, cache) |
| `database/seeders/`               | Seeder con usuario admin y 3 servicios iniciales |
| `public/`                         | Punto de entrada del servidor + CSS, JS, imágenes |
| `public/images/README-IMAGENES.md`| Guía para colocar las fotografías del cliente |
| `resources/views/`                | Vistas Blade (4 páginas públicas + admin + auth + emails + legal) |
| `routes/web.php`                  | Definición de todas las rutas |
| `routes/console.php`              | Comandos Artisan |
| `storage/`                        | Carpetas necesarias con `.gitignore` |
| `composer.json`                   | Dependencias PHP |
| `.env.example`                    | Plantilla de variables de entorno |
| `.gitignore`                      | Archivos excluidos de git |
| `README.md`                       | Guía de instalación |
| `entrega-cliente/`                | Documentos de entrega para el cliente |

---

## 2. Mapa de rutas

### Públicas
```
GET  /                                  → HomeController@index           [home]
GET  /nosotros                          → AboutController@index          [about]
GET  /programas                         → ProgramController@index        [programs.index]
GET  /programas/{program:slug}          → ProgramController@show         [programs.show]
GET  /contacto                          → ContactController@show         [contact]
POST /contacto                          → ContactController@store        [contact.store]
GET  /cookies                           → LegalController@cookies        [legal.cookies]
GET  /aviso-de-privacidad               → LegalController@privacy        [legal.privacy]
```

### Autenticación
```
GET  /admin/login                       → LoginController@showLoginForm  [login]
POST /admin/login                       → LoginController@login          [login.attempt]
POST /admin/logout                      → LoginController@logout         [logout]
```

### Panel admin (middleware: auth + admin)
```
GET    /admin                           → DashboardController@index           [admin.dashboard]
GET    /admin/programs                  → ProgramAdminController@index        [admin.programs.index]
GET    /admin/programs/create           → ProgramAdminController@create       [admin.programs.create]
POST   /admin/programs                  → ProgramAdminController@store        [admin.programs.store]
GET    /admin/programs/{p}/edit         → ProgramAdminController@edit         [admin.programs.edit]
PUT    /admin/programs/{p}              → ProgramAdminController@update       [admin.programs.update]
DELETE /admin/programs/{p}              → ProgramAdminController@destroy      [admin.programs.destroy]
GET    /admin/messages                  → MessageAdminController@index        [admin.messages.index]
GET    /admin/messages/{m}              → MessageAdminController@show         [admin.messages.show]
PATCH  /admin/messages/{m}/toggle       → MessageAdminController@toggleRead   [admin.messages.toggle]
DELETE /admin/messages/{m}              → MessageAdminController@destroy      [admin.messages.destroy]
```

---

## 3. Modelos y migraciones

### `users`
- `id`, `name`, `email` (unique), `password`, `is_admin` (bool), timestamps

### `programs` (servicios)
- `id`, `title`, `slug` (unique), `summary`, `description` (longtext), `image`, `order` (int), `is_active` (bool), `is_featured` (bool), timestamps

### `contact_messages`
- `id`, `name`, `email`, `phone`, `subject`, `message`, `is_read` (bool), timestamps

### `sessions`, `password_reset_tokens`, `cache`, `cache_locks`
- Tablas de soporte de Laravel.

---

## 4. Configuración institucional

Los datos del cliente viven en `config/app.php` bajo las claves:

```php
'institutional' => [...]   // nombre, abreviatura, lema, email, horario
'locations'     => [...]   // arreglo de sedes (puede crecer)
'social'        => [...]   // URLs de redes sociales (lee del .env)
```

Estos datos se comparten automáticamente con TODAS las vistas mediante `AppServiceProvider`.

---

## 5. Servicios precargados (seeder)

| Título | Resumen | Destacado |
|--------|---------|-----------|
| Asesoría Legal | Orientación y apoyo profesional para su familia. | ✓ |
| Apoyo Psicológico | Orientación y apoyo profesional para su familia. | ✓ |
| Asistencia Social | Orientación y apoyo profesional para tu familia. | ✓ |

Cada servicio tiene una descripción larga predefinida en `DatabaseSeeder.php` que el cliente puede editar desde el panel admin.

---

## 6. Credenciales por defecto

```
URL:      /admin/login
Email:    admin@cafamilias.org
Password: AdminCAF2026!
```

> **IMPORTANTE:** Cambiar la contraseña antes de publicar el sitio.

---

## 7. Instalación rápida (Laragon en Windows)

```bash
cd D:\02-DEVCIJM\00-Proyectos\Atención a las Familias
composer install
cp .env.example .env
php artisan key:generate
# Crear la BD desde Laragon → Menú → MySQL → Create database → "valores_familia"
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Abrir: http://localhost:8000

---

## 8. Configuración SMTP (envío de correos del formulario)

Editar `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=usuario@gmail.com
MAIL_PASSWORD=contraseña-de-aplicación
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=contacto@cafamilias.org
MAIL_FROM_NAME="${APP_NAME}"
MAIL_ADMIN_ADDRESS=mujer_familia@hotmail.com
```

Para Gmail/Outlook: usar **contraseña de aplicación** (no la del correo).

---

## 9. Despliegue a producción

```bash
# En el servidor
git clone <repo> caf-sitio
cd caf-sitio
composer install --no-dev --optimize-autoloader
cp .env.example .env
nano .env   # configurar APP_ENV=production, APP_DEBUG=false, BD, SMTP, dominio
php artisan key:generate
php artisan migrate --seed --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
chmod -R 775 storage bootstrap/cache
```

Apuntar el dominio a la carpeta `public/`. Configurar HTTPS (Let's Encrypt).

---

## 10. Imágenes pendientes de colocar

El cliente debe guardar sus fotografías en `public/images/` con los nombres documentados. Lista completa en:

```
public/images/README-IMAGENES.md
```

Resumen rápido:

- `logo.png`
- `hero.jpg`
- `familia-multigeneracional.jpg`
- `familia-feliz.jpg`
- `familia-indigena.jpg`
- `comunidad-1.jpg`
- `talleres-1.jpg`
- `servicio-asesoria-legal.jpg`
- `servicio-apoyo-psicologico.jpg`
- `servicio-asistencia-social.jpg`

Si una imagen falta, el sitio NO se rompe: muestra el gradiente o icono SVG como respaldo.

---

## 11. Cumplimiento legal incluido

- ✅ Aviso de Privacidad Integral (12 apartados según LFPDPPP).
- ✅ Política de Cookies (LFPDPPP).
- ✅ Banner emergente con consentimiento.
- ✅ Derechos ARCO documentados con procedimiento de 20 días hábiles.
- ✅ Mención de INAI como autoridad reguladora.

**Antes de publicar:** validar el Aviso de Privacidad con el responsable legal de CAF (domicilio fiscal real, RFC si aplica, finalidades específicas).

---

## 12. Buenas prácticas implementadas

- **PSR-4** autoloading.
- **Eloquent ORM** para todas las operaciones de BD (sin SQL plano).
- **Form Requests** para validación (`StoreContactRequest`).
- **View Composers** para datos compartidos entre vistas.
- **Middleware** para autorización del panel.
- **Mailables** para correos transaccionales.
- **Blade Components / Partials** para reutilizar el navbar, footer, social icons y banner de cookies.
- **CSS con variables nativas** (sin Bootstrap ni Tailwind).
- **JavaScript vanilla** (sin jQuery ni frameworks).
- **Mobile-first** responsive.

---

## 13. Próximos pasos sugeridos

1. Validar el Aviso de Privacidad con el cliente.
2. Reemplazar las contraseñas por defecto.
3. Configurar SMTP real para que el formulario envíe correos.
4. Subir las imágenes definitivas.
5. Llenar las URLs de redes sociales en `.env`.
6. Desplegar al hosting definitivo con dominio y HTTPS.

---

## 14. Documentos para el cliente

Dentro de la carpeta `entrega-cliente/`:

- **`ENTREGA-CAF-Sitio-Web.html`** — Documento ejecutivo de entrega. Se abre en cualquier navegador y se exporta a PDF con `Ctrl + P → Guardar como PDF`. 15 páginas con portada, mapa del sitio, descripción de cada vista, credenciales, instalación y soporte.
- **`ENTREGA.md`** — Este documento técnico para el desarrollador / equipo de TI.

---

**Fin del manifiesto de entrega.**
