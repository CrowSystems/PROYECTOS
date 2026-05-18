/**
 * Genera el documento Word de entrega del sitio CAF.
 * Uso:  node generar-word.js
 * Requiere: npm install docx --no-save
 */

const fs = require('fs');
const path = require('path');
const {
    Document, Packer, Paragraph, TextRun, Table, TableRow, TableCell,
    Header, Footer, AlignmentType, LevelFormat, HeadingLevel,
    BorderStyle, WidthType, ShadingType, PageBreak, PageNumber,
    VerticalAlign, TabStopType, TabStopPosition
} = require('docx');

// ============================================================
// Paleta CAF
// ============================================================
const COLOR = {
    PRIMARY: '5E3B9E',
    PRIMARY_DARK: '3D2370',
    SECONDARY: '2BB8C4',
    ACCENT: 'E91E63',
    ACCENT_SOFT: 'FFE1ED',
    TEXT: '2C2738',
    MUTED: '6C757D',
    LIGHT: 'FAF7FD',
    WHITE: 'FFFFFF',
    SUCCESS: '28A745',
};

const today = new Date();
const meses = ['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];
const FECHA = `${today.getDate()} de ${meses[today.getMonth()]} de ${today.getFullYear()}`;
const YEAR  = today.getFullYear();

// ============================================================
// Helpers
// ============================================================
const border = { style: BorderStyle.SINGLE, size: 4, color: 'CCCCCC' };
const cellBorders = { top: border, bottom: border, left: border, right: border };

function P(text, opts = {}) {
    return new Paragraph({
        spacing: { before: 80, after: 80 },
        ...opts,
        children: [ new TextRun({ text, ...opts.run }) ],
    });
}

function H(text, level) {
    const sizes = { 1: 36, 2: 26, 3: 20 };
    return new Paragraph({
        heading: level === 1 ? HeadingLevel.HEADING_1 : level === 2 ? HeadingLevel.HEADING_2 : HeadingLevel.HEADING_3,
        spacing: { before: 320, after: 160 },
        children: [ new TextRun({ text, bold: true, color: COLOR.PRIMARY, size: sizes[level] || 22 }) ],
    });
}

function bullet(text) {
    return new Paragraph({
        numbering: { reference: 'bullets', level: 0 },
        spacing: { before: 40, after: 40 },
        children: [ new TextRun({ text, size: 22 }) ],
    });
}

function numbered(text) {
    return new Paragraph({
        numbering: { reference: 'numbers', level: 0 },
        spacing: { before: 40, after: 40 },
        children: [ new TextRun({ text, size: 22 }) ],
    });
}

function cell(text, opts = {}) {
    const width = opts.width || 4680;
    return new TableCell({
        borders: cellBorders,
        width: { size: width, type: WidthType.DXA },
        shading: opts.shading ? { fill: opts.shading, type: ShadingType.CLEAR, color: 'auto' } : undefined,
        margins: { top: 100, bottom: 100, left: 150, right: 150 },
        verticalAlign: VerticalAlign.TOP,
        children: [
            new Paragraph({
                spacing: { before: 40, after: 40 },
                children: [ new TextRun({
                    text,
                    bold: !!opts.bold,
                    color: opts.color || COLOR.TEXT,
                    size: opts.size || 20,
                })],
            }),
        ],
    });
}

function table(rows, columnWidths) {
    return new Table({
        width: { size: columnWidths.reduce((a,b)=>a+b,0), type: WidthType.DXA },
        columnWidths,
        rows,
    });
}

function headerRow(labels, columnWidths) {
    return new TableRow({
        tableHeader: true,
        children: labels.map((t, i) => cell(t, { width: columnWidths[i], bold: true, color: COLOR.WHITE, shading: COLOR.PRIMARY, size: 20 })),
    });
}

function divider() {
    return new Paragraph({
        spacing: { before: 100, after: 100 },
        border: { bottom: { style: BorderStyle.SINGLE, size: 6, color: COLOR.ACCENT } },
        children: [],
    });
}

function blankLine() {
    return new Paragraph({ spacing: { before: 0, after: 0 }, children: [new TextRun('')] });
}

function pageBreak() {
    return new Paragraph({ children: [new PageBreak()] });
}

// ============================================================
// PORTADA
// ============================================================
const portada = [
    new Paragraph({ spacing: { before: 1200, after: 0 }, alignment: AlignmentType.CENTER,
        children: [ new TextRun({ text: 'CAF', bold: true, color: COLOR.PRIMARY, size: 110 }) ]}),
    new Paragraph({ spacing: { before: 0, after: 0 }, alignment: AlignmentType.CENTER,
        children: [ new TextRun({ text: 'Centro de Apoyo para la Familia A.C.', italics: true, color: COLOR.MUTED, size: 22 }) ]}),

    new Paragraph({ spacing: { before: 1600, after: 200 }, alignment: AlignmentType.CENTER, border: { top: { style: BorderStyle.SINGLE, size: 12, color: COLOR.ACCENT } },
        children: []}),

    new Paragraph({ spacing: { before: 400, after: 200 }, alignment: AlignmentType.CENTER,
        children: [ new TextRun({ text: `ENTREGA DE PROYECTO  ·  ${YEAR}`, bold: true, color: COLOR.ACCENT, size: 22 }) ]}),

    new Paragraph({ spacing: { before: 200, after: 200 }, alignment: AlignmentType.CENTER,
        children: [ new TextRun({ text: 'Sitio Web Institucional', bold: true, color: COLOR.PRIMARY, size: 64 }) ]}),

    new Paragraph({ spacing: { before: 0, after: 800 }, alignment: AlignmentType.CENTER,
        children: [ new TextRun({ text: 'Plataforma web profesional, responsive y conforme a la LFPDPPP', color: COLOR.TEXT, size: 24 }) ]}),

    new Paragraph({ spacing: { before: 200, after: 200 }, alignment: AlignmentType.CENTER, border: { bottom: { style: BorderStyle.SINGLE, size: 6, color: COLOR.SECONDARY } },
        children: []}),

    new Paragraph({ spacing: { before: 400, after: 100 }, alignment: AlignmentType.CENTER,
        children: [ new TextRun({ text: 'Cliente', bold: true, color: COLOR.PRIMARY, size: 22 }) ]}),
    new Paragraph({ spacing: { before: 0, after: 300 }, alignment: AlignmentType.CENTER,
        children: [ new TextRun({ text: 'Centro de Apoyo para la Familia A.C.', color: COLOR.TEXT, size: 22 }) ]}),

    new Paragraph({ spacing: { before: 0, after: 100 }, alignment: AlignmentType.CENTER,
        children: [ new TextRun({ text: 'Fecha de entrega', bold: true, color: COLOR.PRIMARY, size: 22 }) ]}),
    new Paragraph({ spacing: { before: 0, after: 0 }, alignment: AlignmentType.CENTER,
        children: [ new TextRun({ text: FECHA, color: COLOR.TEXT, size: 22 }) ]}),

    pageBreak(),
];

// ============================================================
// ÍNDICE
// ============================================================
const indice = [
    H('Índice', 1),
    P('Contenido del documento de entrega.', { run: { italics: true, color: COLOR.MUTED, size: 22 } }),
    blankLine(),

    table([
        headerRow(['No.', 'Sección'], [1000, 8360]),
        new TableRow({ children: [ cell('1', { width: 1000 }), cell('Resumen ejecutivo del proyecto', { width: 8360 }) ] }),
        new TableRow({ children: [ cell('2', { width: 1000 }), cell('Cumplimiento de la propuesta original', { width: 8360 }) ] }),
        new TableRow({ children: [ cell('3', { width: 1000 }), cell('Mapa del sitio', { width: 8360 }) ] }),
        new TableRow({ children: [ cell('4', { width: 1000 }), cell('Detalle de páginas públicas', { width: 8360 }) ] }),
        new TableRow({ children: [ cell('5', { width: 1000 }), cell('Servicios ofrecidos', { width: 8360 }) ] }),
        new TableRow({ children: [ cell('6', { width: 1000 }), cell('Panel administrativo', { width: 8360 }) ] }),
        new TableRow({ children: [ cell('7', { width: 1000 }), cell('Identidad visual y experiencia de usuario', { width: 8360 }) ] }),
        new TableRow({ children: [ cell('8', { width: 1000 }), cell('Características técnicas', { width: 8360 }) ] }),
        new TableRow({ children: [ cell('9', { width: 1000 }), cell('Cumplimiento normativo (LFPDPPP)', { width: 8360 }) ] }),
        new TableRow({ children: [ cell('10', { width: 1000 }), cell('Instalación y despliegue', { width: 8360 }) ] }),
        new TableRow({ children: [ cell('11', { width: 1000 }), cell('Credenciales y accesos', { width: 8360 }) ] }),
        new TableRow({ children: [ cell('12', { width: 1000 }), cell('Soporte y próximos pasos', { width: 8360 }) ] }),
    ], [1000, 8360]),

    pageBreak(),
];

// ============================================================
// 1. RESUMEN EJECUTIVO
// ============================================================
const seccion1 = [
    H('1. Resumen ejecutivo', 1),
    P('El presente proyecto consiste en el desarrollo e implementación de un sitio web institucional para el Centro de Apoyo para la Familia A.C. (CAF), organización civil sin fines de lucro dedicada a brindar atención integral y profesional a las familias en sus retos jurídicos, emocionales y sociales.'),

    H('Objetivos cumplidos', 2),
    bullet('Posicionar institucionalmente al CAF mediante un sitio profesional y moderno.'),
    bullet('Facilitar el contacto entre la comunidad y los servicios de la asociación.'),
    bullet('Comunicar de forma clara los tres servicios ofrecidos: Asesoría Legal, Apoyo Psicológico y Asistencia Social.'),
    bullet('Permitir la administración autónoma del contenido a través de un panel privado.'),
    bullet('Cumplir con la Ley Federal de Protección de Datos Personales en Posesión de los Particulares (LFPDPPP).'),

    H('Alcance entregado', 2),
    bullet('4 páginas públicas: Inicio, Nosotros, Servicios y Contacto.'),
    bullet('Panel administrativo con login privado para gestión de servicios y mensajes.'),
    bullet('Páginas legales: Aviso de Privacidad y Política de Cookies conforme a la LFPDPPP.'),
    bullet('Diseño responsive adaptable a móvil, tableta y escritorio.'),
    bullet('SEO optimizado con meta tags, Open Graph y datos estructurados JSON-LD.'),
    bullet('Protección anti-spam: CAPTCHA matemático y honeypot en el formulario de contacto.'),
    bullet('Banner emergente de cookies con consentimiento.'),
    bullet('Soporte para dos sedes (CAF San Francisco y CAF Zaragoza) con WhatsApp directo.'),

    H('Estado del proyecto', 2),
    P('100% funcional, probado en entorno local con Laragon (Apache + MySQL + PHP 8.4). Listo para despliegue a producción.'),

    pageBreak(),
];

// ============================================================
// 2. CUMPLIMIENTO DE LA PROPUESTA
// ============================================================
const seccion2 = [
    H('2. Cumplimiento de la propuesta original', 1),
    P('A continuación se contrasta cada elemento solicitado en la propuesta inicial con lo entregado.'),

    blankLine(),
    table([
        headerRow(['Solicitado', 'Entregado', 'Estado'], [2400, 6360, 600]),
        new TableRow({ children: [
            cell('Archivo fuente', { bold: true, width: 2400 }),
            cell('Proyecto Laravel 11 completo entregado en carpeta organizada con todos sus componentes.', { width: 6360 }),
            cell('✓', { bold: true, color: COLOR.SUCCESS, width: 600 }),
        ]}),
        new TableRow({ children: [
            cell('3 revisiones', { bold: true, width: 2400 }),
            cell('Incluidas en el ciclo de desarrollo. Reservadas para ajustes finales del cliente.', { width: 6360 }),
            cell('✓', { bold: true, color: COLOR.SUCCESS, width: 600 }),
        ]}),
        new TableRow({ children: [
            cell('Íconos de redes sociales', { bold: true, width: 2400 }),
            cell('Íconos SVG para Facebook, Instagram, Twitter/X, YouTube y WhatsApp, configurables desde .env.', { width: 6360 }),
            cell('✓', { bold: true, color: COLOR.SUCCESS, width: 600 }),
        ]}),
        new TableRow({ children: [
            cell('3 a 5 páginas', { bold: true, width: 2400 }),
            cell('4 páginas públicas + 2 páginas legales + página de detalle por servicio.', { width: 6360 }),
            cell('✓', { bold: true, color: COLOR.SUCCESS, width: 600 }),
        ]}),
        new TableRow({ children: [
            cell('SEO', { bold: true, width: 2400 }),
            cell('Meta tags, Open Graph, Twitter Cards, JSON-LD tipo NGO, canonical y optimización de imágenes.', { width: 6360 }),
            cell('✓', { bold: true, color: COLOR.SUCCESS, width: 600 }),
        ]}),
        new TableRow({ children: [
            cell('Formulario de contacto', { bold: true, width: 2400 }),
            cell('Validación completa, CAPTCHA matemático, honeypot, almacenamiento en BD y envío al admin.', { width: 6360 }),
            cell('✓', { bold: true, color: COLOR.SUCCESS, width: 600 }),
        ]}),
        new TableRow({ children: [
            cell('Uso comercial', { bold: true, width: 2400 }),
            cell('Sin restricciones. Código basado en Laravel (licencia MIT).', { width: 6360 }),
            cell('✓', { bold: true, color: COLOR.SUCCESS, width: 600 }),
        ]}),
        new TableRow({ children: [
            cell('Entrega en 1 semana', { bold: true, width: 2400 }),
            cell('Cumplida.', { width: 6360 }),
            cell('✓', { bold: true, color: COLOR.SUCCESS, width: 600 }),
        ]}),
        new TableRow({ children: [
            cell('Imágenes', { bold: true, width: 2400 }),
            cell('Estructura lista en /public/images con guía documentada para colocar las fotografías del cliente.', { width: 6360 }),
            cell('✓', { bold: true, color: COLOR.SUCCESS, width: 600 }),
        ]}),
    ], [2400, 6360, 600]),

    H('Extras incluidos sin costo adicional', 2),
    bullet('Panel administrativo completo con CRUD de servicios y bandeja de mensajes.'),
    bullet('Banner emergente de cookies conforme a LFPDPPP.'),
    bullet('Aviso de Privacidad Integral con derechos ARCO.'),
    bullet('Soporte para múltiples sedes (San Francisco y Zaragoza).'),
    bullet('Botones de WhatsApp directo para cada sede.'),

    pageBreak(),
];

// ============================================================
// 3. MAPA DEL SITIO
// ============================================================
const seccion3 = [
    H('3. Mapa del sitio', 1),
    P('Estructura jerárquica de navegación del sitio.'),

    H('Páginas públicas', 2),
    bullet('/ — Inicio: Hero "Fortaleciendo Familias", servicios destacados, valores y CTA.'),
    bullet('/nosotros — Nosotros: Historia, Misión/Visión/Valores, comunidades atendidas.'),
    bullet('/programas — Servicios: Catálogo de los 3 servicios profesionales.'),
    bullet('/programas/{slug} — Detalle: Página individual con descripción completa de cada servicio.'),
    bullet('/contacto — Contacto: Sedes (San Francisco y Zaragoza), formulario con CAPTCHA y horario.'),
    bullet('/cookies — Política de Cookies conforme a LFPDPPP.'),
    bullet('/aviso-de-privacidad — Aviso de Privacidad Integral.'),

    H('Zona privada (panel administrativo)', 2),
    bullet('/admin/login — Pantalla de inicio de sesión.'),
    bullet('/admin — Dashboard con estadísticas.'),
    bullet('/admin/programs — CRUD de servicios (crear, editar, eliminar).'),
    bullet('/admin/messages — Bandeja de mensajes del formulario de contacto.'),

    pageBreak(),
];

// ============================================================
// 4. DETALLE DE PÁGINAS PÚBLICAS
// ============================================================
const seccion4 = [
    H('4. Detalle de páginas públicas', 1),
    P('Contenido y bloques de cada vista pública del sitio.'),

    H('4.1 Inicio', 2),
    P('Página de entrada. Capta la atención, comunica el propósito de CAF y guía al visitante hacia los servicios o el contacto.'),
    H('Bloques:', 3),
    bullet('Hero principal con fondo en degradado de marca y dos llamados a la acción.'),
    bullet('Bloque "Familias unidas, familias fuertes" con texto institucional y fotografía.'),
    bullet('Sección de servicios destacados con tarjetas e íconos.'),
    bullet('Sección de valores (Amor, Solidaridad, Justicia, Familia).'),
    bullet('CTA final con invitación a agendar cita.'),

    H('4.2 Nosotros', 2),
    P('Página institucional. Comunica historia, misión y valores del CAF, con evidencia visual del trabajo.'),
    H('Bloques:', 3),
    bullet('Banner secundario con título "Quiénes somos".'),
    bullet('Sección "Nuestra historia" con fotografía y narrativa.'),
    bullet('Misión, Visión y Valores en tres tarjetas con íconos.'),
    bullet('Galería "Comunidades que atendemos" con tres fotografías.'),
    bullet('CTA hacia Contacto.'),

    H('4.3 Servicios', 2),
    P('Catálogo completo de los tres servicios profesionales. Cada uno con su propia página de detalle.'),
    H('Bloques:', 3),
    bullet('Banner secundario "Nuestros servicios — Atención integral y profesional".'),
    bullet('Tres tarjetas con ícono o foto, título, resumen y botón "Más información".'),
    bullet('Página de detalle individual por servicio con descripción completa.'),
    bullet('CTA "Agendar una cita".'),

    H('4.4 Contacto', 2),
    P('Página de conversión. Permite conocer ambas sedes y enviar un mensaje a la asociación.'),
    H('Bloques:', 3),
    bullet('Banner secundario "Contáctanos".'),
    bullet('CAF San Francisco: C. Soneto 156, Carlos Castillo Peraza 951, Col. Chihuahua. Tel. (656) 634 7031 / Cel. (656) 275 5776 con enlace a WhatsApp.'),
    bullet('CAF Zaragoza: C. Aguascalientes 107 Oriente, Zaragoza, 32590 Juárez, Chih. Tel. (656) 639 5874 / Cel. (656) 843 7143 con enlace a WhatsApp.'),
    bullet('Información general: correo (mujer_familia@hotmail.com) y horario (Lunes a viernes, 8:00 am – 6:00 pm).'),
    bullet('Formulario con campos: Nombre, Correo, Teléfono, Asunto, Mensaje y verificación CAPTCHA matemática.'),
    bullet('Íconos de redes sociales al pie del formulario.'),

    H('4.5 Páginas legales', 2),
    H('Política de Cookies', 3),
    P('Explica qué cookies se utilizan, sus finalidades, duración y cómo gestionarlas. Incluye enlaces a las guías oficiales de configuración de los principales navegadores.'),
    H('Aviso de Privacidad Integral', 3),
    P('Incluye los 12 apartados que exige la LFPDPPP: identidad del responsable, datos recabados (incluidos datos sensibles), finalidades primarias y secundarias, fundamento legal, transferencias, derechos ARCO, revocación del consentimiento, limitación del uso, cookies, medidas de seguridad, cambios al aviso y autoridad reguladora.'),

    H('4.6 Banner emergente de cookies', 2),
    P('Aparece en la primera visita. Permite al usuario aceptar todas, permitir solo las necesarias o configurar. La elección se guarda en localStorage del navegador y puede revocarse en cualquier momento desde la política de cookies.'),

    pageBreak(),
];

// ============================================================
// 5. SERVICIOS OFRECIDOS
// ============================================================
const seccion5 = [
    H('5. Servicios ofrecidos', 1),
    P('Tres áreas profesionales de atención.'),

    blankLine(),
    table([
        headerRow(['Servicio', 'Descripción'], [3000, 6360]),
        new TableRow({ children: [
            cell('Asesoría Legal\nOrientación y apoyo profesional para su familia.', { bold: true, color: COLOR.ACCENT, width: 3000 }),
            cell('Orientación jurídica gratuita y acompañamiento legal en temas familiares: divorcios, pensión alimenticia, custodia de menores, violencia familiar, regularización de documentos y trámites civiles. Equipo de abogados con cédula profesional.', { width: 6360 }),
        ]}),
        new TableRow({ children: [
            cell('Apoyo Psicológico\nOrientación y apoyo profesional para su familia.', { bold: true, color: COLOR.ACCENT, width: 3000 }),
            cell('Atención psicológica individual, de pareja y familiar a precios accesibles. Terapia para niñas, niños, adolescentes y adultos en duelo, ansiedad, depresión, manejo de emociones, comunicación familiar y violencia. Psicólogos con cédula profesional.', { width: 6360 }),
        ]}),
        new TableRow({ children: [
            cell('Asistencia Social\nOrientación y apoyo profesional para tu familia.', { bold: true, color: COLOR.ACCENT, width: 3000 }),
            cell('Acompañamiento en la gestión de apoyos sociales, canalización a instituciones públicas y privadas, talleres de desarrollo humano y orientación para familias en situación de vulnerabilidad.', { width: 6360 }),
        ]}),
    ], [3000, 6360]),

    H('Cómo se administran los servicios', 2),
    P('Cada servicio es editable desde el panel administrativo. El administrador puede:'),
    bullet('Cambiar título, resumen, descripción larga e imagen.'),
    bullet('Activar o desactivar un servicio sin eliminarlo.'),
    bullet('Marcar un servicio como "destacado" para que aparezca en la portada.'),
    bullet('Definir el orden en que se muestran.'),
    bullet('Agregar nuevos servicios si crece la oferta.'),

    pageBreak(),
];

// ============================================================
// 6. PANEL ADMINISTRATIVO
// ============================================================
const seccion6 = [
    H('6. Panel administrativo', 1),
    P('Zona privada para gestionar el sitio. Acceso desde /admin/login con credenciales privadas.'),

    H('6.1 Dashboard', 2),
    P('Pantalla inicial al iniciar sesión. Muestra cuatro indicadores en tiempo real: servicios totales, servicios activos, mensajes totales y mensajes sin leer. Además, una tabla con los 5 mensajes más recientes para acceso rápido.'),

    H('6.2 Gestión de servicios', 2),
    P('Pantalla de listado con todos los servicios. Acciones disponibles:'),
    bullet('Crear un nuevo servicio con título, resumen, descripción larga e imagen.'),
    bullet('Editar cualquier servicio existente.'),
    bullet('Activar / desactivar un servicio (lo oculta o lo muestra al público).'),
    bullet('Destacar en home: lo muestra en la portada del sitio.'),
    bullet('Ordenar mediante un campo numérico.'),
    bullet('Eliminar un servicio (con confirmación de seguridad).'),

    H('6.3 Bandeja de mensajes', 2),
    P('Inbox de los mensajes recibidos a través del formulario de contacto. Funciones:'),
    bullet('Listado paginado con fecha, remitente, asunto y estado (leído / sin leer).'),
    bullet('Vista detallada con botón "Responder por correo" que abre el cliente de email.'),
    bullet('Marcar como leído / no leído manualmente.'),
    bullet('Eliminar mensajes individualmente.'),
    bullet('Notificación automática por correo al administrador cuando llega un mensaje nuevo.'),

    H('6.4 Seguridad del panel', 2),
    bullet('Autenticación con sesión y contraseña cifrada con bcrypt.'),
    bullet('Protección CSRF en todas las acciones que modifican datos.'),
    bullet('Middleware que valida que solo usuarios administradores puedan ingresar.'),
    bullet('Sesiones que expiran tras 2 horas de inactividad por defecto.'),

    pageBreak(),
];

// ============================================================
// 7. IDENTIDAD VISUAL
// ============================================================
const seccion7 = [
    H('7. Identidad visual', 1),
    P('Marca, paleta y experiencia de usuario.'),

    H('7.1 Marca', 2),
    P('Se respeta la identidad existente del CAF: el isotipo del corazón con figuras en degradado se usa en el navbar, footer y otros puntos del sitio. El nombre completo "Centro de Apoyo para la Familia A.C." acompaña al logo, junto al lema "Atención integral y profesional".'),

    H('7.2 Paleta institucional', 2),
    blankLine(),
    table([
        headerRow(['Color', 'Hexadecimal', 'Uso'], [3120, 3120, 3120]),
        new TableRow({ children: [
            cell('Rosa magenta', { bold: true, color: COLOR.WHITE, shading: COLOR.ACCENT, width: 3120 }),
            cell('#E91E63', { width: 3120 }),
            cell('Acento, llamadas a la acción, énfasis', { width: 3120 }),
        ]}),
        new TableRow({ children: [
            cell('Púrpura', { bold: true, color: COLOR.WHITE, shading: COLOR.PRIMARY, width: 3120 }),
            cell('#5E3B9E', { width: 3120 }),
            cell('Color primario, títulos y barras de navegación', { width: 3120 }),
        ]}),
        new TableRow({ children: [
            cell('Turquesa', { bold: true, color: COLOR.WHITE, shading: COLOR.SECONDARY, width: 3120 }),
            cell('#2BB8C4', { width: 3120 }),
            cell('Color secundario, acentos y bordes', { width: 3120 }),
        ]}),
    ], [3120, 3120, 3120]),

    H('7.3 Tipografía', 2),
    bullet('Montserrat (Google Fonts) para títulos y encabezados.'),
    bullet('Open Sans (Google Fonts) para texto corrido.'),
    bullet('Ambas son libres, gratuitas y legibles en todos los dispositivos.'),

    H('7.4 Experiencia de usuario (UX)', 2),
    bullet('Diseño responsive: se adapta a móvil (320 px), tableta (768 px) y escritorio.'),
    bullet('Menú hamburguesa en pantallas pequeñas.'),
    bullet('Animaciones suaves en hover de botones y tarjetas.'),
    bullet('Contraste alto en textos sobre fondos coloridos.'),
    bullet('Accesibilidad: atributos alt en imágenes, aria-label en íconos y formularios.'),

    pageBreak(),
];

// ============================================================
// 8. CARACTERÍSTICAS TÉCNICAS
// ============================================================
const seccion8 = [
    H('8. Características técnicas', 1),
    P('Tecnologías, requisitos y rendimiento.'),

    H('8.1 Stack tecnológico', 2),
    blankLine(),
    table([
        headerRow(['Componente', 'Tecnología'], [3120, 6240]),
        new TableRow({ children: [ cell('Framework', { bold: true, width: 3120 }), cell('Laravel 11 (PHP)', { width: 6240 }) ]}),
        new TableRow({ children: [ cell('Lenguaje', { bold: true, width: 3120 }), cell('PHP 8.2 o superior', { width: 6240 }) ]}),
        new TableRow({ children: [ cell('Base de datos', { bold: true, width: 3120 }), cell('MySQL 8 (también MariaDB 10.4+)', { width: 6240 }) ]}),
        new TableRow({ children: [ cell('Servidor web', { bold: true, width: 3120 }), cell('Apache 2.4 o Nginx', { width: 6240 }) ]}),
        new TableRow({ children: [ cell('Plantillas', { bold: true, width: 3120 }), cell('Blade (motor nativo de Laravel)', { width: 6240 }) ]}),
        new TableRow({ children: [ cell('Estilos', { bold: true, width: 3120 }), cell('CSS 3 con variables nativas', { width: 6240 }) ]}),
        new TableRow({ children: [ cell('JavaScript', { bold: true, width: 3120 }), cell('Vanilla JS (sin frameworks)', { width: 6240 }) ]}),
        new TableRow({ children: [ cell('Tipografía', { bold: true, width: 3120 }), cell('Google Fonts (Montserrat + Open Sans)', { width: 6240 }) ]}),
        new TableRow({ children: [ cell('Íconos', { bold: true, width: 3120 }), cell('SVG inline (sin librerías)', { width: 6240 }) ]}),
        new TableRow({ children: [ cell('Sistema de correo', { bold: true, width: 3120 }), cell('Laravel Mail con SMTP', { width: 6240 }) ]}),
    ], [3120, 6240]),

    H('8.2 Requisitos de servidor', 2),
    bullet('PHP 8.2+ con extensiones: pdo_mysql, mbstring, openssl, tokenizer, xml, ctype, json, bcmath, fileinfo.'),
    bullet('MySQL 8 / MariaDB 10.4+.'),
    bullet('Composer 2 instalado en el servidor.'),
    bullet('Espacio en disco: 200 MB iniciales.'),
    bullet('Memoria PHP recomendada: 128 MB o más.'),

    H('8.3 Funcionalidades de seguridad', 2),
    bullet('Protección CSRF en todos los formularios.'),
    bullet('Sanitización automática de entradas (Eloquent + Blade).'),
    bullet('Hashing bcrypt para contraseñas.'),
    bullet('CAPTCHA matemático en el formulario de contacto.'),
    bullet('Honeypot invisible adicional contra bots básicos.'),
    bullet('Validación de tipos y longitudes en todos los inputs.'),
    bullet('Sesiones cifradas con clave única por instalación (APP_KEY).'),

    H('8.4 SEO incluido', 2),
    bullet('Meta title y meta description únicos por página.'),
    bullet('Etiquetas Open Graph (Facebook, LinkedIn).'),
    bullet('Twitter Cards.'),
    bullet('Datos estructurados JSON-LD (tipo NGO de schema.org).'),
    bullet('URLs amigables con slugs (ej. /programas/asesoria-legal).'),
    bullet('Etiquetas canonical automáticas.'),
    bullet('Imágenes con texto alternativo.'),

    pageBreak(),
];

// ============================================================
// 9. CUMPLIMIENTO NORMATIVO
// ============================================================
const seccion9 = [
    H('9. Cumplimiento normativo', 1),
    P('Protección de datos personales según la ley mexicana.'),
    P('El sitio está diseñado para cumplir con la Ley Federal de Protección de Datos Personales en Posesión de los Particulares (LFPDPPP), su Reglamento y los Lineamientos del Aviso de Privacidad publicados por el INAI.'),

    H('9.1 Aviso de Privacidad Integral', 2),
    P('Contiene los 12 apartados que exige la normativa mexicana:'),
    bullet('Identidad y domicilio del responsable.'),
    bullet('Tipos de datos personales recabados, incluyendo datos sensibles (salud, estado emocional, situación familiar).'),
    bullet('Finalidades primarias (atención al usuario) y secundarias (boletines, eventos), con opción de oposición.'),
    bullet('Fundamento legal de cada tratamiento.'),
    bullet('Transferencia de datos: casos en los que CAF podría compartir información.'),
    bullet('Procedimiento completo para ejercer los derechos ARCO (Acceso, Rectificación, Cancelación, Oposición), con plazo de 20 días hábiles.'),
    bullet('Revocación del consentimiento.'),
    bullet('Limitación del uso o divulgación.'),
    bullet('Medidas de seguridad implementadas.'),
    bullet('Información de la autoridad reguladora (INAI).'),

    H('9.2 Política de Cookies', 2),
    bullet('Banner emergente en la primera visita con opciones claras.'),
    bullet('Página detallada que clasifica las cookies (técnicas, de preferencias, de análisis).'),
    bullet('Mecanismo de revocación visible y accesible.'),
    bullet('Enlaces a las guías oficiales de configuración para los principales navegadores.'),

    H('9.3 Recomendaciones para mantener el cumplimiento', 2),
    numbered('Validar el Aviso de Privacidad con el responsable legal de CAF antes del lanzamiento.'),
    numbered('Revisar el aviso al menos una vez al año o ante cambios en los servicios.'),
    numbered('Capacitar al equipo administrador en la confidencialidad de los mensajes recibidos.'),
    numbered('Conservar registros internos del cumplimiento por al menos 5 años.'),

    pageBreak(),
];

// ============================================================
// 10. INSTALACIÓN Y DESPLIEGUE
// ============================================================
const seccion10 = [
    H('10. Instalación y despliegue', 1),
    P('Pasos para poner el sitio en producción.'),

    H('10.1 Instalación local (desarrollo)', 2),
    P('Recomendado para Windows: Laragon (incluye PHP, MySQL, Apache, Node).'),
    bullet('composer install'),
    bullet('cp .env.example .env'),
    bullet('php artisan key:generate'),
    bullet('Crear la base de datos "valores_familia" con utf8mb4.'),
    bullet('php artisan migrate --seed'),
    bullet('php artisan storage:link'),
    bullet('php artisan serve'),
    P('El sitio queda disponible en http://localhost:8000.'),

    H('10.2 Despliegue a producción', 2),
    P('El sitio es compatible con cualquier hosting que soporte Laravel: cPanel, Plesk, VPS, Hostinger, SiteGround, Forge, etc.'),
    numbered('Subir la totalidad del proyecto (sin la carpeta vendor) por FTP, SFTP o Git.'),
    numbered('Apuntar el dominio a la carpeta public/ (no a la raíz del proyecto).'),
    numbered('Ejecutar composer install --no-dev --optimize-autoloader.'),
    numbered('Ejecutar php artisan migrate --seed --force.'),
    numbered('Ejecutar php artisan storage:link.'),
    numbered('Cachear configuración: php artisan config:cache && route:cache && view:cache.'),
    numbered('Configurar el archivo .env de producción con APP_ENV=production, APP_DEBUG=false y APP_URL real.'),
    numbered('Instalar certificado SSL con Let’s Encrypt.'),

    H('10.3 Configuración del correo SMTP', 2),
    P('Para que el formulario de contacto envíe correos reales, configurar en el archivo .env los datos del servidor SMTP del proveedor de correo. Para cuentas Hotmail/Outlook se recomienda usar una contraseña de aplicación generada en la cuenta del correo, no la contraseña personal.'),

    pageBreak(),
];

// ============================================================
// 11. CREDENCIALES Y ACCESOS
// ============================================================
const seccion11 = [
    H('11. Credenciales y accesos', 1),
    P('Información sensible — guardar en lugar seguro y cambiar antes del lanzamiento.'),

    H('11.1 Acceso al panel administrativo', 2),
    blankLine(),
    table([
        headerRow(['Campo', 'Valor'], [3120, 6240]),
        new TableRow({ children: [ cell('URL', { bold: true, width: 3120 }), cell('https://[dominio]/admin/login', { width: 6240 }) ]}),
        new TableRow({ children: [ cell('Email', { bold: true, width: 3120 }), cell('admin@cafamilias.org', { width: 6240 }) ]}),
        new TableRow({ children: [ cell('Contraseña', { bold: true, width: 3120 }), cell('AdminCAF2026!', { width: 6240 }) ]}),
        new TableRow({ children: [ cell('Rol', { bold: true, width: 3120 }), cell('Administrador (acceso total)', { width: 6240 }) ]}),
    ], [3120, 6240]),

    H('11.2 Información institucional configurada', 2),
    blankLine(),
    table([
        headerRow(['Dato', 'Valor actual'], [3120, 6240]),
        new TableRow({ children: [ cell('Nombre institucional', { bold: true, width: 3120 }), cell('Centro de Apoyo para la Familia A.C.', { width: 6240 }) ]}),
        new TableRow({ children: [ cell('Abreviatura', { bold: true, width: 3120 }), cell('CAF', { width: 6240 }) ]}),
        new TableRow({ children: [ cell('Lema', { bold: true, width: 3120 }), cell('Atención integral y profesional', { width: 6240 }) ]}),
        new TableRow({ children: [ cell('Frase complementaria', { bold: true, width: 3120 }), cell('Familias unidas, familias fuertes', { width: 6240 }) ]}),
        new TableRow({ children: [ cell('Correo institucional', { bold: true, width: 3120 }), cell('mujer_familia@hotmail.com', { width: 6240 }) ]}),
        new TableRow({ children: [ cell('Horario', { bold: true, width: 3120 }), cell('Lunes a viernes: 8:00 am – 6:00 pm', { width: 6240 }) ]}),
    ], [3120, 6240]),

    H('11.3 Sedes registradas', 2),
    blankLine(),
    table([
        headerRow(['Sede', 'Información'], [3120, 6240]),
        new TableRow({ children: [
            cell('CAF San Francisco', { bold: true, color: COLOR.PRIMARY, width: 3120 }),
            cell('C. Soneto 156, Carlos Castillo Peraza 951, Col. Chihuahua, México. Tel: (656) 634 7031 · Cel: (656) 275 5776', { width: 6240 }),
        ]}),
        new TableRow({ children: [
            cell('CAF Zaragoza', { bold: true, color: COLOR.PRIMARY, width: 3120 }),
            cell('C. Aguascalientes 107 Oriente, Zaragoza, 32590 Juárez, Chih., México. Tel: (656) 639 5874 · Cel: (656) 843 7143', { width: 6240 }),
        ]}),
    ], [3120, 6240]),

    pageBreak(),
];

// ============================================================
// 12. SOPORTE Y PRÓXIMOS PASOS
// ============================================================
const seccion12 = [
    H('12. Soporte y próximos pasos', 1),
    P('Recomendaciones para mantener y hacer crecer el sitio.'),

    H('12.1 Mantenimiento recomendado', 2),
    bullet('Mensual: revisar la bandeja de mensajes y respaldar la base de datos.'),
    bullet('Trimestral: actualizar dependencias de Laravel (parches de seguridad).'),
    bullet('Semestral: revisar el contenido del Aviso de Privacidad y la Política de Cookies.'),
    bullet('Anual: renovar el certificado SSL si no es automático, revisar dominio y hosting.'),

    H('12.2 Posibles ampliaciones (fase 2)', 2),
    bullet('Blog / Noticias: publicación de artículos sobre los temas que atiende CAF.'),
    bullet('Donaciones online con pasarela de pago segura (PayPal, Mercado Pago, Stripe).'),
    bullet('Agenda de citas online con calendario y confirmación por correo.'),
    bullet('Multi-idioma: versión en inglés para públicos binacionales (Juárez).'),
    bullet('Google Analytics 4 para medir visitas.'),
    bullet('Mapas interactivos de Google con ambas sedes.'),

    H('12.3 Garantía y soporte', 2),
    P('El proyecto se entrega 100% funcional y probado. Se incluyen las 3 revisiones acordadas en la propuesta para ajustes y correcciones.'),

    H('12.4 Recursos incluidos en la entrega', 2),
    bullet('codigo-fuente/ — Carpeta completa del proyecto Laravel listo para instalar.'),
    bullet('README.md — Guía técnica de instalación local y producción.'),
    bullet('ENTREGA.md — Manifiesto técnico estructurado.'),
    bullet('ENTREGA-CAF-Sitio-Web.docx — Este documento institucional de entrega.'),
    bullet('public/images/README-IMAGENES.md — Guía para colocar las fotografías.'),

    divider(),
    new Paragraph({
        alignment: AlignmentType.CENTER,
        spacing: { before: 200, after: 0 },
        children: [ new TextRun({ text: `Documento generado para Centro de Apoyo para la Familia A.C. — ${FECHA}`, color: COLOR.MUTED, italics: true, size: 18 }) ],
    }),
    new Paragraph({
        alignment: AlignmentType.CENTER,
        spacing: { before: 0, after: 0 },
        children: [ new TextRun({ text: 'Confidencial. Solo para uso interno del cliente.', color: COLOR.MUTED, italics: true, size: 18 }) ],
    }),
];

// ============================================================
// DOCUMENTO
// ============================================================
const doc = new Document({
    creator: 'CAF',
    title: 'Entrega — Sitio Web CAF',
    description: 'Documento de entrega del sitio web institucional del Centro de Apoyo para la Familia A.C.',
    styles: {
        default: {
            document: { run: { font: 'Arial', size: 22, color: COLOR.TEXT } },
        },
        paragraphStyles: [
            { id: 'Heading1', name: 'Heading 1', basedOn: 'Normal', next: 'Normal', quickFormat: true,
              run: { size: 36, bold: true, color: COLOR.PRIMARY, font: 'Arial' },
              paragraph: { spacing: { before: 320, after: 200 }, outlineLevel: 0 } },
            { id: 'Heading2', name: 'Heading 2', basedOn: 'Normal', next: 'Normal', quickFormat: true,
              run: { size: 26, bold: true, color: COLOR.PRIMARY_DARK, font: 'Arial' },
              paragraph: { spacing: { before: 240, after: 120 }, outlineLevel: 1 } },
            { id: 'Heading3', name: 'Heading 3', basedOn: 'Normal', next: 'Normal', quickFormat: true,
              run: { size: 22, bold: true, color: COLOR.PRIMARY, font: 'Arial' },
              paragraph: { spacing: { before: 160, after: 80 }, outlineLevel: 2 } },
        ],
    },
    numbering: {
        config: [
            { reference: 'bullets',
              levels: [{ level: 0, format: LevelFormat.BULLET, text: '•', alignment: AlignmentType.LEFT,
                style: { paragraph: { indent: { left: 720, hanging: 360 } } } }] },
            { reference: 'numbers',
              levels: [{ level: 0, format: LevelFormat.DECIMAL, text: '%1.', alignment: AlignmentType.LEFT,
                style: { paragraph: { indent: { left: 720, hanging: 360 } } } }] },
        ],
    },
    sections: [
        // Portada — sin header/footer
        {
            properties: {
                page: {
                    size: { width: 12240, height: 15840 },
                    margin: { top: 1440, right: 1440, bottom: 1440, left: 1440 },
                },
            },
            children: portada,
        },
        // Resto del documento — con header y footer
        {
            properties: {
                page: {
                    size: { width: 12240, height: 15840 },
                    margin: { top: 1440, right: 1440, bottom: 1440, left: 1440 },
                },
            },
            headers: {
                default: new Header({
                    children: [
                        new Paragraph({
                            border: { bottom: { style: BorderStyle.SINGLE, size: 8, color: COLOR.ACCENT } },
                            tabStops: [{ type: TabStopType.RIGHT, position: TabStopPosition.MAX }],
                            children: [
                                new TextRun({ text: 'Centro de Apoyo para la Familia A.C.', bold: true, color: COLOR.PRIMARY, size: 18 }),
                                new TextRun({ text: '\tEntrega de proyecto', color: COLOR.MUTED, size: 18 }),
                            ],
                        }),
                    ],
                }),
            },
            footers: {
                default: new Footer({
                    children: [
                        new Paragraph({
                            alignment: AlignmentType.CENTER,
                            border: { top: { style: BorderStyle.SINGLE, size: 4, color: 'DDDDDD' } },
                            children: [
                                new TextRun({ text: 'Página ', color: COLOR.MUTED, size: 16 }),
                                new TextRun({ children: [PageNumber.CURRENT], color: COLOR.MUTED, size: 16 }),
                                new TextRun({ text: ' / ', color: COLOR.MUTED, size: 16 }),
                                new TextRun({ children: [PageNumber.TOTAL_PAGES], color: COLOR.MUTED, size: 16 }),
                                new TextRun({ text: '   ·   Confidencial   ·   ' + FECHA, color: COLOR.MUTED, size: 16 }),
                            ],
                        }),
                    ],
                }),
            },
            children: [
                ...indice,
                ...seccion1,
                ...seccion2,
                ...seccion3,
                ...seccion4,
                ...seccion5,
                ...seccion6,
                ...seccion7,
                ...seccion8,
                ...seccion9,
                ...seccion10,
                ...seccion11,
                ...seccion12,
            ],
        },
    ],
});

// ============================================================
// Guardar
// ============================================================
const outPath = path.join(__dirname, 'ENTREGA-CAF-Sitio-Web.docx');
Packer.toBuffer(doc).then(buffer => {
    fs.writeFileSync(outPath, buffer);
    console.log('');
    console.log('  ✓ Documento generado correctamente:');
    console.log('    ' + outPath);
    console.log('');
});
