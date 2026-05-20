<?php $__env->startSection('title', 'Nuevo equipo'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex items-center gap-3 mb-6">
    <a href="<?php echo e(route('assets.index')); ?>" class="text-slate-500 hover:text-slate-700">&larr; Volver</a>
    <h1 class="text-2xl font-bold text-slate-800">Registrar equipo</h1>
</div>

<div class="bg-white rounded-xl shadow p-6">
    <form action="<?php echo e(route('assets.store')); ?>" method="POST">
        <?php echo $__env->make('assets._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\02-DEVCIJM\00-Proyectos\protecnic.com.mx\resources\views/assets/create.blade.php ENDPATH**/ ?>