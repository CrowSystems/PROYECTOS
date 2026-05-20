<?php $__env->startSection('title', 'Nuevo técnico'); ?>
<?php $__env->startSection('content'); ?>
<h1 class="text-2xl font-bold mb-6">Nuevo técnico</h1>
<form method="POST" action="<?php echo e(route('supervisor.technicians.store')); ?>" class="bg-white p-6 rounded-xl shadow">
    <?php echo $__env->make('supervisor.technicians._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\02-DEVCIJM\00-Proyectos\protecnic.com.mx\resources\views/supervisor/technicians/create.blade.php ENDPATH**/ ?>