# 📦 Carpeta de entrega — Cómo usar estos archivos

Esta carpeta contiene los documentos finales para presentar el proyecto al cliente.

---

## 1️⃣ `ENTREGA-CAF-Sitio-Web.html` — Documento ejecutivo (15 páginas)

**Quién lo usa:** El cliente. Es el documento institucional con la entrega completa.

**Cómo convertirlo a PDF:**

1. Doble clic sobre el archivo `ENTREGA-CAF-Sitio-Web.html` — se abrirá en tu navegador (Chrome, Edge, Firefox).
2. Presiona **`Ctrl + P`** (Imprimir).
3. En el cuadro de impresión:
   - **Destino:** "Guardar como PDF" o "Microsoft Print to PDF".
   - **Diseño:** Vertical.
   - **Márgenes:** Predeterminados.
   - **Más opciones → Gráficos de fondo: ACTIVADO** ✅ (importante para que los colores aparezcan bien).
4. Clic en **Guardar**. Nombra el archivo `ENTREGA-CAF-Sitio-Web.pdf`.

Listo: tienes un PDF profesional de 15 páginas con la portada de marca, mapa del sitio, descripción de cada página, paleta visual, características técnicas, cumplimiento normativo, instalación, credenciales y próximos pasos.

---

## 2️⃣ `ENTREGA.md` — Manifiesto técnico

**Quién lo usa:** El equipo técnico del cliente o cualquier desarrollador que reciba el proyecto en el futuro.

Lista todas las rutas, modelos, migraciones, credenciales, instrucciones de instalación local y producción, configuración SMTP, etc.

Es la "memoria técnica" del proyecto.

---

## 3️⃣ `empaquetar-entrega.ps1` — Script para generar el ZIP final

**Quién lo usa:** Tú (desarrollador), al momento de entregar el proyecto al cliente.

**Qué hace:** Crea un archivo `CAF-Sitio-Web-AAAA-MM-DD.zip` con todo el proyecto **excepto** carpetas que no deben viajar (`vendor`, `node_modules`, `.git`, `.env`, cachés temporales).

**Cómo ejecutarlo:**

1. Abre **PowerShell** (clic derecho en el menú Inicio → "Terminal" o "Windows PowerShell").
2. Navega a la raíz del proyecto:
   ```powershell
   cd "D:\02-DEVCIJM\00-Proyectos\Atención a las Familias"
   ```
3. La primera vez, autoriza la ejecución de scripts (solo una vez en tu PC):
   ```powershell
   Set-ExecutionPolicy -Scope CurrentUser RemoteSigned
   ```
   (Responde **Y** si te pregunta.)
4. Ejecuta el script:
   ```powershell
   .\entrega-cliente\empaquetar-entrega.ps1
   ```

Se generará `entrega-cliente\CAF-Sitio-Web-YYYY-MM-DD.zip`. Ese ZIP es lo que envías al cliente o subes a Google Drive / WeTransfer.

---

## 📋 Lo que envías al cliente

Cuando hagas la entrega final, comparte estos **3 archivos**:

| Archivo | ¿Por qué? |
|---|---|
| `ENTREGA-CAF-Sitio-Web.pdf` | Documento ejecutivo de presentación. |
| `ENTREGA.md` | Manifiesto técnico para su equipo de TI. |
| `CAF-Sitio-Web-YYYY-MM-DD.zip` | El código fuente listo para instalar. |

---

## 🔐 Nota de seguridad

El ZIP **no incluye el archivo `.env`** (que contiene contraseñas y secretos), solo `.env.example`. El cliente o su equipo deberá copiar `.env.example` a `.env` y completarlo con sus propias credenciales reales antes de poner el sitio en producción.

Esto es **estándar de la industria** y obligatorio por seguridad.
