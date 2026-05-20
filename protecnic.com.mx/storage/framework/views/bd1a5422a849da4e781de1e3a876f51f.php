<?php $__env->startSection('title', 'Blog · Protecnic'); ?>

<?php $__env->startSection('content'); ?>
<section class="relative hero-bg text-white py-20 overflow-hidden">
    <?php echo $__env->make('public.partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <div class="relative z-10 max-w-7xl mx-auto px-6 mt-12">
        <h1 class="text-4xl md:text-5xl font-extrabold">Blog</h1>
        <p class="text-slate-200 mt-2">Artículos y novedades del mundo CNC.</p>
    </div>
</section>
<section class="py-16 bg-white">
    <div class="max-w-5xl mx-auto px-6">
        <p class="text-slate-700">Próximamente: artículos técnicos y casos de éxito.</p>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('public.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\02-DEVCIJM\00-Proyectos\protecnic.com.mx\resources\views/public/pages/blog.blade.php ENDPATH**/ ?>