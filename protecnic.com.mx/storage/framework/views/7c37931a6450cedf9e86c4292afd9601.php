<?php $__env->startSection('title', 'Nuevo usuario'); ?>
<?php $__env->startSection('content'); ?>
<h1 class="text-2xl font-bold mb-6">Nuevo usuario</h1>
<form method="POST" action="<?php echo e(route('admin.users.store')); ?>" class="bg-white p-6 rounded-xl shadow">
    <?php echo $__env->make('admin.users._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\02-DEVCIJM\00-Proyectos\protecnic.com.mx\resources\views/admin/users/create.blade.php ENDPATH**/ ?>