<?php
    // Fallback de marcas en caso de que aún no haya registros activos en BD
    $brandFallback = collect([
        (object)['name' => 'Sodick',     'logo_path' => null, 'description' => null],
        (object)['name' => 'SMEC',       'logo_path' => null, 'description' => null],
        (object)['name' => 'NOMURA DS',  'logo_path' => null, 'description' => null],
        (object)['name' => 'AXILE',      'logo_path' => null, 'description' => null],
        (object)['name' => 'CHETO',      'logo_path' => null, 'description' => null],
        (object)['name' => 'KEN',        'logo_path' => null, 'description' => null],
    ]);
    $brandsToShow = $brands->count() ? $brands : $brandFallback;
    // Duplicamos para lograr el efecto de carrusel infinito sin huecos
    $carouselBrands = $brandsToShow->concat($brandsToShow);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(config('app.name')); ?> · Soluciones CNC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', system-ui, sans-serif; }

        /* Hero industrial: gradiente oscuro + patrón sutil. Reemplazable por una foto real. */
        .hero-bg {
            background:
                linear-gradient(135deg, rgba(8,15,30,.85) 0%, rgba(15,30,55,.75) 50%, rgba(8,15,30,.9) 100%),
                radial-gradient(circle at 20% 30%, rgba(80,120,180,.25) 0%, transparent 40%),
                radial-gradient(circle at 80% 70%, rgba(40,60,100,.35) 0%, transparent 45%),
                linear-gradient(180deg, #0b1426 0%, #0f1c33 100%);
        }
        .hero-bg::after {
            content: "";
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.04) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
        }
        .hero-curves {
            position: absolute; bottom: -10%; left: -5%; right: -5%; height: 60%;
            background:
                radial-gradient(ellipse at center, rgba(255,255,255,.06) 0%, transparent 60%);
            transform: rotate(-3deg);
            pointer-events: none;
        }

        /* Carrusel infinito con CSS */
        @keyframes scroll-x {
            from { transform: translateX(0); }
            to   { transform: translateX(-50%); }
        }
        .marquee-track {
            animation: scroll-x 30s linear infinite;
        }
        .marquee:hover .marquee-track { animation-play-state: paused; }

        /* Item del carrusel */
        .brand-card {
            transition: transform .25s ease, box-shadow .25s ease;
        }
        .brand-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px -10px rgba(15,23,42,.25);
        }

        /* Logo Protecnic en SVG inline (sol + texto) */
        .logo-sun {
            width: 60px; height: 60px;
        }
    </style>
</head>
<body class="bg-white text-slate-800">


<section class="relative hero-bg text-white overflow-hidden min-h-screen flex flex-col">

    <div class="hero-curves"></div>

    
    <header class="relative z-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-10 pt-6 flex items-start justify-between">
            
            <a href="<?php echo e(route('public.home')); ?>" class="flex items-center gap-3">
                <svg class="logo-sun" viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg" fill="white">
                    
                    <?php for($i = 0; $i < 16; $i++): ?>
                        <rect x="38" y="2" width="4" height="14"
                              transform="rotate(<?php echo e($i * 22.5); ?> 40 40)" rx="1"/>
                    <?php endfor; ?>
                    
                    <circle cx="40" cy="40" r="18" fill="white"/>
                    <circle cx="40" cy="40" r="16" fill="#0b1426"/>
                    
                    <path d="M30 36 Q35 30 42 33 Q48 36 46 42 Q43 47 36 45 Q31 42 30 36 Z" fill="white"/>
                    <path d="M48 44 Q52 42 53 46 Q52 50 48 49 Z" fill="white"/>
                </svg>
                <div class="leading-tight">
                    <div class="text-2xl font-extrabold tracking-wider">PROTECNIC</div>
                    <div class="text-[11px] tracking-[0.3em] text-slate-300">SOLUCIONES CNC</div>
                </div>
            </a>

            
            <nav class="hidden md:flex items-center gap-10 text-sm font-medium pt-2">
                <a href="#blog"     class="hover:text-sky-300 transition">Blog</a>
                <a href="#nosotros" class="hover:text-sky-300 transition">Nosotros</a>
                <a href="#contacto" class="hover:text-sky-300 transition">Contacto</a>
                <button type="button" aria-label="Buscar" class="hover:text-sky-300 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/>
                    </svg>
                </button>
            </nav>
        </div>

        
        <div class="max-w-7xl mx-auto px-6 lg:px-10 mt-4">
            <nav class="flex flex-wrap items-center justify-center md:justify-start md:pl-32 gap-8 lg:gap-14 text-[15px] font-semibold">
                <a href="#productos"   class="hover:text-sky-300 transition">Productos</a>
                <a href="#servicios"   class="hover:text-sky-300 transition">Servicios</a>
                <a href="#consumibles" class="hover:text-sky-300 transition">Consumibles</a>
                <a href="#accesorios"  class="hover:text-sky-300 transition">Accesorios</a>
                <a href="#laboratorio" class="hover:text-sky-300 transition">Laboratorio</a>
            </nav>
        </div>
    </header>

    
    <div class="relative z-10 flex-1 flex items-center justify-center px-6 text-center">
        <div class="max-w-5xl">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight drop-shadow-lg">
                Nuestra tecnología CNC <br class="hidden sm:block">
                <span class="font-extrabold">se adapta a tus necesidades</span>
            </h1>

            <div class="mt-10">
                <a href="#presentacion"
                   class="inline-block bg-slate-700/80 hover:bg-slate-600 backdrop-blur-sm border border-slate-500/40
                          px-8 py-3 rounded-md text-white font-medium transition shadow-lg">
                    Ver Presentación
                </a>
            </div>
        </div>
    </div>

    
    <div class="relative z-10 pb-8 flex justify-center">
        <a href="#marcas"
           class="w-12 h-12 rounded-full bg-white/90 hover:bg-white flex items-center justify-center shadow-md transition animate-bounce">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path d="M19 9l-7 7-7-7"/>
            </svg>
        </a>
    </div>
</section>


<section id="marcas" class="relative bg-gradient-to-b from-slate-50 to-white py-14">
    <div class="max-w-7xl mx-auto px-4">
        <div class="marquee overflow-hidden">
            <div class="marquee-track flex gap-6 w-max">
                <?php $__currentLoopData = $carouselBrands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="brand-card flex-shrink-0 w-56 h-40 bg-white rounded-2xl shadow-md
                                flex items-center justify-center p-6 border border-slate-100">
                        <?php if(!empty($b->logo_path)): ?>
                            <img src="<?php echo e(asset('storage/'.$b->logo_path)); ?>"
                                 alt="<?php echo e($b->name); ?>"
                                 class="max-h-20 max-w-full object-contain">
                        <?php else: ?>
                            <span class="text-2xl font-extrabold text-slate-700 tracking-wide">
                                <?php echo e($b->name); ?>

                            </span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <?php if(!$brands->count()): ?>
            <p class="text-center text-xs text-slate-400 mt-6">
                * Marcas de ejemplo. Cuando registres marcas en el panel, aparecerán aquí con su logo.
            </p>
        <?php endif; ?>
    </div>
</section>


<?php if($machines->count()): ?>
<section id="productos" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-end justify-between mb-8">
            <div>
                <p class="text-sky-600 font-semibold text-sm tracking-wider uppercase">Catálogo</p>
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mt-1">Máquinas</h2>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php $__currentLoopData = $machines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="bg-white border border-slate-200 rounded-2xl overflow-hidden hover:shadow-xl transition">
                    <?php if($m->image_path): ?>
                        <img src="<?php echo e(asset('storage/'.$m->image_path)); ?>" alt="<?php echo e($m->name); ?>" class="w-full h-48 object-cover">
                    <?php else: ?>
                        <div class="w-full h-48 bg-slate-100 flex items-center justify-center text-slate-300 text-sm">Sin imagen</div>
                    <?php endif; ?>
                    <div class="p-5">
                        <p class="text-xs text-sky-600 font-semibold uppercase tracking-wider"><?php echo e($m->brand?->name); ?></p>
                        <h3 class="font-bold text-slate-900 mt-1"><?php echo e($m->name); ?></h3>
                        <p class="text-sm text-slate-600 mt-2"><?php echo e(Str::limit($m->description, 90)); ?></p>
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>


<?php if($products->count()): ?>
<section id="consumibles" class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-end justify-between mb-8">
            <div>
                <p class="text-sky-600 font-semibold text-sm tracking-wider uppercase">Catálogo</p>
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mt-1">Productos y refacciones</h2>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="bg-white border border-slate-200 rounded-2xl overflow-hidden hover:shadow-xl transition">
                    <?php if($p->image_path): ?>
                        <img src="<?php echo e(asset('storage/'.$p->image_path)); ?>" alt="<?php echo e($p->name); ?>" class="w-full h-48 object-cover">
                    <?php else: ?>
                        <div class="w-full h-48 bg-slate-100 flex items-center justify-center text-slate-300 text-sm">Sin imagen</div>
                    <?php endif; ?>
                    <div class="p-5">
                        <p class="text-xs text-sky-600 font-semibold uppercase tracking-wider">
                            <?php echo e($p->brand?->name); ?> · <?php echo e($p->product_type); ?>

                        </p>
                        <h3 class="font-bold text-slate-900 mt-1"><?php echo e($p->name); ?></h3>
                        <?php if($p->price): ?>
                            <p class="text-emerald-600 font-extrabold mt-2 text-lg">
                                $<?php echo e(number_format((float)$p->price, 2)); ?>

                            </p>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>


<footer id="contacto" class="bg-[#102a43] text-slate-200">
    <div class="max-w-7xl mx-auto px-6 lg:px-10 pt-16 pb-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-16">

            
            <div>
                <h3 class="text-2xl font-bold text-white mb-6">¿Tienes alguna duda?</h3>
                <ul class="space-y-2 text-sm text-slate-300">
                    <li><a href="#faq"        class="hover:text-white transition">Preguntas Frecuentes.</a></li>
                    <li><a href="#vendedores" class="hover:text-white transition">Encuentra a tu vendedor local.</a></li>
                    <li><a href="#testimonios" class="hover:text-white transition">Testimonios.</a></li>
                </ul>
            </div>

            
            <div class="text-center">
                <h3 class="text-2xl font-bold text-white mb-6">Showroom</h3>
                <div class="text-sm text-slate-300 space-y-1">
                    <p>Av. Hércules #500 Nave 30</p>
                    <p>Polígono Empresarial Santa Rosa</p>
                    <p>Querétaro, Qro. C.P. 76220</p>
                </div>
                <div class="text-sm text-slate-300 space-y-1 mt-5">
                    <p>Calle Titanio #216</p>
                    <p>Fraccionamiento Terra Park</p>
                    <p>Santa Catarina, Nuevo León. C.P. 66367</p>
                </div>
            </div>

            
            <div class="md:text-right">
                <h3 class="text-2xl font-bold text-white mb-6">Contacto</h3>
                <div class="space-y-2 text-sm text-slate-300">
                    <a href="tel:+524422208333" class="flex md:justify-end items-center gap-2 hover:text-white transition">
                        <span class="w-6 h-6 rounded-full border border-slate-300 flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.13.98.37 1.94.7 2.86a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.22-1.22a2 2 0 012.11-.45c.92.33 1.88.57 2.86.7A2 2 0 0122 16.92z"/>
                            </svg>
                        </span>
                        <span>+52 (442) 220 - 8333</span>
                    </a>
                    <a href="mailto:ventas@protecnic.com.mx" class="flex md:justify-end items-center gap-2 hover:text-white transition">
                        <span class="w-6 h-6 rounded-full border border-slate-300 flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </span>
                        <span>ventas@protecnic.com.mx</span>
                    </a>
                </div>

                
                <div class="flex md:justify-end gap-3 mt-4">
                    
                    <a href="#" aria-label="YouTube" class="w-8 h-8 rounded-full bg-white text-[#102a43] flex items-center justify-center hover:bg-slate-200 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                    
                    <a href="#" aria-label="Facebook" class="w-8 h-8 rounded-full bg-white text-[#102a43] flex items-center justify-center hover:bg-slate-200 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    
                    <a href="#" aria-label="LinkedIn" class="w-8 h-8 rounded-full bg-white text-[#102a43] flex items-center justify-center hover:bg-slate-200 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.063 2.063 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                    
                    <a href="https://wa.me/524422208333" aria-label="WhatsApp" class="w-8 h-8 rounded-full bg-white text-[#102a43] flex items-center justify-center hover:bg-slate-200 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M.057 24l1.687-6.163a11.867 11.867 0 01-1.587-5.945C.16 5.335 5.495 0 12.05 0a11.817 11.817 0 018.413 3.488 11.824 11.824 0 013.48 8.414c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 01-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884a9.86 9.86 0 001.692 5.525l-.999 3.648 3.796-.972zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        
        <div class="mt-16 flex flex-col md:flex-row items-center md:items-end justify-between gap-6">
            <a href="<?php echo e(route('public.home')); ?>" class="flex items-center gap-3">
                <svg width="42" height="42" viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg" fill="white">
                    <?php for($i = 0; $i < 16; $i++): ?>
                        <rect x="38" y="2" width="4" height="12"
                              transform="rotate(<?php echo e($i * 22.5); ?> 40 40)" rx="1"/>
                    <?php endfor; ?>
                    <circle cx="40" cy="40" r="16" fill="white"/>
                    <circle cx="40" cy="40" r="14" fill="#102a43"/>
                    <path d="M30 36 Q35 30 42 33 Q48 36 46 42 Q43 47 36 45 Q31 42 30 36 Z" fill="white"/>
                    <path d="M48 44 Q52 42 53 46 Q52 50 48 49 Z" fill="white"/>
                </svg>
                <span class="text-2xl font-extrabold text-white tracking-wider">PROTECNIC</span>
            </a>
            <div class="text-sm text-slate-200">
                <a href="#aviso"  class="hover:text-white transition">Aviso de Privacidad</a>
                <span class="mx-2 text-slate-400">|</span>
                <a href="#bolsa"  class="hover:text-white transition">Bolsa de Trabajo</a>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
<?php /**PATH D:\02-DEVCIJM\00-Proyectos\protecnic.com.mx\resources\views/public/home.blade.php ENDPATH**/ ?>