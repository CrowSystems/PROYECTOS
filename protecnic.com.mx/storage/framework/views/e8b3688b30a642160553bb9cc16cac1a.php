<?php $__env->startSection('title', 'Nosotros · Protecnic'); ?>

<?php $__env->startSection('content'); ?>
<section class="relative hero-bg text-white py-20 overflow-hidden">
    <?php echo $__env->make('public.partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <div class="relative z-10 max-w-7xl mx-auto px-6 mt-12">
        <h1 class="text-4xl md:text-5xl font-extrabold">Nosotros</h1>
        <p class="text-slate-200 mt-2">Conoce nuestra historia, misión, visión y valores.</p>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="max-w-5xl mx-auto px-6 grid md:grid-cols-3 gap-8">
        <div>
            <h2 class="text-2xl font-extrabold text-[#0e2540]">Misión</h2>
            <p class="text-slate-700 mt-2">Brindar soluciones CNC integrales que impulsen la productividad y competitividad de nuestros clientes.</p>
        </div>
        <div>
            <h2 class="text-2xl font-extrabold text-[#0e2540]">Visión</h2>
            <p class="text-slate-700 mt-2">Ser el aliado tecnológico CNC líder en México, reconocido por la excelencia técnica y el servicio.</p>
        </div>
        <div>
            <h2 class="text-2xl font-extrabold text-[#0e2540]">Valores</h2>
            <ul class="text-slate-700 mt-2 list-disc pl-4 space-y-1">
                <li>Innovación</li>
                <li>Compromiso</li>
                <li>Integridad</li>
                <li>Trabajo en equipo</li>
            </ul>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('public.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\02-DEVCIJM\00-Proyectos\protecnic.com.mx\resources\views/public/pages/about.blade.php ENDPATH**/ ?>