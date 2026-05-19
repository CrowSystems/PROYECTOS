# Portal Reportes — Sistema de Reportes de Servicio con Firma Digital

Portal de administración construido con **Laravel 11 + Blade + Tailwind CSS** que soporta múltiples roles, generación de reportes de servicio, captura de firma digital del cliente con el dedo desde celular/tablet, y un flujo de doble aprobación (firma en sitio + confirmación por email).

## Roles del sistema

| Rol | Descripción | Email demo |
|---|---|---|
| **Administrador** | Permisos completos. Gestiona usuarios, roles y accede a todos los módulos. | `admin@portal.test` |
| **Editor de contenido** | Sólo modifica la página pública: marcas, máquinas y productos/artículos. | `contenido@portal.test` |
| **Supervisor de reportes** | Aprueba/valida reportes recibidos y gestiona los técnicos. | `supervisor@portal.test` |
| **Técnico** | Genera reportes con datos del cliente, máquina, tipo de producto, fotos y firma digital. | `tecnico@portal.test` |

Contraseña para todos los usuarios demo: `password`

## Flujo del reporte (corazón del sistema)

1. **Técnico** abre `/tecnico/reports/create`, llena: cliente, máquina, tipo de producto, observaciones y sube fotos.
2. En el mismo formulario, el técnico **le pasa el dispositivo al cliente** y el cliente firma con el dedo sobre el canvas HTML5 (responsive, funciona en celular, tablet y desktop).
3. Al guardar:
   - El reporte queda con estado **"Firmado en sitio"**.
   - Se genera un **token único** y se envía un **email al cliente** con copia del reporte y un botón para dar la **segunda confirmación de aprobación**.
4. El cliente abre el link (sin necesidad de loguearse), revisa el reporte y confirma → estado pasa a **"Confirmado por cliente"**.
5. **Supervisor** valida finalmente y aprueba/rechaza → estado **"Aprobado por supervisor"** o **"Rechazado"**.

## Requisitos

- PHP 8.2+
- Composer
- MySQL 8 o MariaDB 10.3+
- Extensiones PHP: `pdo_mysql`, `mbstring`, `xml`, `gd` (recomendada para imágenes)

## Instalación rápida

```bash
# 1. Instalar dependencias
composer install

# 2. Configurar entorno
cp .env.example .env
php artisan key:generate

# 3. Editar .env con tus credenciales de BD
#    DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 4. Crear base de datos en MySQL
mysql -uroot -p -e "CREATE DATABASE service_reports CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# 5. Ejecutar migraciones y seeders
php artisan migrate --seed

# 6. Enlazar storage para que las imágenes sean visibles
php artisan storage:link

# 7. Levantar servidor
php artisan serve
```

Abre `http://localhost:8000`. La página pública carga sin login; para el portal entra por `http://localhost:8000/login`.

## Configuración de correo

Por defecto los emails se loguean en `storage/logs/laravel.log` (driver `log`).
Para envío real, edita `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu_correo@gmail.com
MAIL_PASSWORD=tu_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="no-reply@tuempresa.com"
MAIL_FROM_NAME="Portal Reportes"
```

Para desarrollo, **Mailpit** es excelente: corre en `localhost:1025` con UI en `localhost:8025`.

## Estructura de carpetas

```
app/
  Http/
    Controllers/
      Admin/UserController.php
      Auth/LoginController.php
      Client/ApprovalController.php       ← Aprobación pública por token
      Content/{Brand,Machine,Product}Controller.php
      Public/HomeController.php
      Supervisor/{Report,Technician}Controller.php
      Technician/ReportController.php      ← Crea reportes + firma
    Middleware/EnsureUserHasRole.php
  Mail/ReportClientApprovalMail.php
  Models/{User,Brand,Machine,Product,Client,Report,ReportPhoto}.php
database/
  migrations/                              ← 7 migraciones
  seeders/DatabaseSeeder.php
resources/views/
  layouts/app.blade.php                    ← Sidebar inteligente por rol
  auth/login.blade.php
  dashboard.blade.php
  admin/users/
  content/{brands,machines,products}/
  supervisor/{reports,technicians}/
  technician/reports/
    create.blade.php                       ← ⭐ Canvas de firma digital aquí
  client/{approval,approved}.blade.php
  emails/client_approval.blade.php
  public/home.blade.php
routes/web.php                             ← Rutas protegidas por middleware `role:*`
```

## Cómo probar el flujo completo

1. Login como **técnico** (`tecnico@portal.test` / `password`).
2. Clic en **"+ Nuevo reporte"**.
3. Llena cliente (usa email real si quieres recibir el correo), máquina, producto, observaciones.
4. Sube 1-2 fotos.
5. Firma con el mouse (o si abres en tu teléfono, con el dedo) en el canvas.
6. Guarda. Verás el reporte con estado **"Pendiente confirmación cliente"** y el email se logueará (o se enviará si configuraste SMTP).
7. Copia el link del email (en `storage/logs/laravel.log` busca `cliente/aprobar/`) y ábrelo en otro navegador o incógnito → confirma.
8. Login como **supervisor** → ve el reporte en `Reportes a validar` → aprueba.

## Tecnología

- **Backend**: Laravel 11, PHP 8.2, Eloquent ORM, middleware de roles personalizado
- **Frontend**: Blade + Tailwind CSS (vía CDN para que no necesites Node)
- **Firma digital**: Canvas HTML5 nativo con soporte touch + mouse, exportado a PNG base64 → guardado como archivo en `storage/app/public/reports/{id}/`
- **Base de datos**: MySQL con 7 tablas relacionadas y soft constraints

## Personalizaciones rápidas

- **Cambiar nombre del portal**: edita `APP_NAME` en `.env`.
- **Cambiar colores**: la app usa Tailwind con tema slate+emerald. Busca y reemplaza `emerald-` o `slate-` en las vistas.
- **Agregar campos al reporte**: nueva migración + actualiza `Report::$fillable` + agrega input al `technician/reports/create.blade.php`.
- **Cambiar idioma**: `APP_LOCALE=en` en `.env`.

## Seguridad

- Contraseñas hasheadas con bcrypt.
- CSRF en todos los formularios.
- Middleware `role:*` valida en cada request.
- Tokens de aprobación de cliente con 48 caracteres aleatorios (no enumerables).
- Las firmas se guardan como imágenes (no como vector) — el técnico no puede borrar/modificar después de capturada.

## Licencia

MIT. Úsalo y modifícalo libremente.
