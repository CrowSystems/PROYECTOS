
<header class="relative z-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-10 pt-6 flex items-start justify-between">

        
        <a href="<?php echo e(route('public.home')); ?>" class="block">
            
            <img src="<?php echo e(asset('images/logo-protecnic-white.png')); ?>" alt="Protecnic Soluciones CNC"
                 class="h-20 md:h-24 lg:h-28 w-auto"
                 onerror="this.style.display='none';this.nextElementSibling.style.display='block';">
            <div style="display:none">
                <div class="text-3xl md:text-4xl font-extrabold tracking-wider text-white">PROTECNIC</div>
                <div class="text-xs tracking-[0.3em] text-slate-300">SOLUCIONES CNC</div>
            </div>
        </a>

        
        <nav class="hidden md:flex items-center gap-10 text-sm font-medium pt-2 text-white">
            <a href="<?php echo e(route('public.blog')); ?>"    class="hover:text-sky-300 transition">Blog</a>
            <a href="<?php echo e(route('public.about')); ?>"   class="hover:text-sky-300 transition">Nosotros</a>
            <a href="<?php echo e(route('public.home')); ?>#contacto" class="hover:text-sky-300 transition">Contacto</a>
            <button type="button" id="btn-search-toggle" aria-label="Buscar"
                    class="hover:text-sky-300 transition"
                    onclick="document.getElementById('search-panel').classList.toggle('open')">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/>
                </svg>
            </button>
        </nav>
    </div>

    
    <div class="max-w-7xl mx-auto px-6 lg:px-10 mt-4">
        <nav class="flex flex-wrap items-center justify-center md:justify-start md:pl-32 gap-8 lg:gap-14 text-[15px] font-semibold text-white">
            <a href="<?php echo e(route('public.products')); ?>"    class="hover:text-sky-300 transition">Productos</a>
            <a href="<?php echo e(route('public.services')); ?>"    class="hover:text-sky-300 transition">Servicios</a>
            <a href="<?php echo e(route('public.consumables')); ?>" class="hover:text-sky-300 transition">Consumibles</a>
            <a href="<?php echo e(route('public.accessories')); ?>" class="hover:text-sky-300 transition">Accesorios</a>
            <a href="<?php echo e(route('public.laboratory')); ?>"  class="hover:text-sky-300 transition">Laboratorio</a>
        </nav>
    </div>

    
    <div id="search-panel" class="search-panel max-w-7xl mx-auto px-6 lg:px-10 mt-4">
        <div class="bg-white text-slate-800 rounded-xl shadow-2xl p-4 mb-4">
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/>
                </svg>
                <input id="search-input" type="text" placeholder="Buscar productos, marcas, servicios..."
                       autocomplete="off"
                       class="flex-1 outline-none text-base"
                       oninput="protecnicSearch(this.value)">
                <button type="button"
                        onclick="document.getElementById('search-panel').classList.remove('open')"
                        class="text-slate-400 hover:text-slate-700 text-lg">&times;</button>
            </div>
            <div id="search-results" class="mt-3 max-h-56 overflow-y-auto text-sm divide-y"></div>
            <p class="text-xs text-slate-400 mt-2">
                Escribe al menos 2 caracteres. El backend de búsqueda completo se conectará en una fase posterior.
            </p>
        </div>
    </div>
</header>

<script>
    // Búsqueda placeholder local: muestra coincidencias entre los enlaces del menú.
    // En fase B esto consultará un endpoint /buscar?q= que devuelva JSON con productos/marcas/páginas.
    const _searchIndex = [
        { label: 'Productos',   url: '<?php echo e(route("public.products")); ?>' },
        { label: 'Servicios',   url: '<?php echo e(route("public.services")); ?>' },
        { label: 'Consumibles', url: '<?php echo e(route("public.consumables")); ?>' },
        { label: 'Accesorios',  url: '<?php echo e(route("public.accessories")); ?>' },
        { label: 'Laboratorio', url: '<?php echo e(route("public.laboratory")); ?>' },
        { label: 'Nosotros',    url: '<?php echo e(route("public.about")); ?>' },
        { label: 'Blog',        url: '<?php echo e(route("public.blog")); ?>' },
        { label: 'Eventos',     url: '<?php echo e(route("public.events.index")); ?>' },
        { label: 'Contacto',    url: '<?php echo e(route("public.home")); ?>#contacto' },
    ];
    function protecnicSearch(term) {
        const out = document.getElementById('search-results');
        term = (term || '').trim().toLowerCase();
        if (term.length < 2) { out.innerHTML = ''; return; }
        const matches = _searchIndex.filter(i => i.label.toLowerCase().includes(term));
        out.innerHTML = matches.length
            ? matches.map(m => `<a href="${m.url}" class="block py-2 px-2 hover:bg-slate-100 rounded">${m.label}</a>`).join('')
            : '<div class="py-3 px-2 text-slate-400">Sin resultados.</div>';
    }
</script>
<?php /**PATH D:\02-DEVCIJM\00-Proyectos\protecnic.com.mx\resources\views/public/partials/navbar.blade.php ENDPATH**/ ?>