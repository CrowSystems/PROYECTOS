<?php $__env->startSection('title', 'Técnicos'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Técnicos generadores de reportes</h1>
    <a href="<?php echo e(route('supervisor.technicians.create')); ?>" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">+ Nuevo técnico</a>
</div>
<div class="bg-white rounded-xl shadow overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-100 text-left">
            <tr>
                <th class="px-4 py-3">Nombre</th>
                <th class="px-4 py-3">Email</th>
                <th class="px-4 py-3">Tel.</th>
                <th class="px-4 py-3">Reportes</th>
                <th class="px-4 py-3">Activo</th>
                <th class="px-4 py-3 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $technicians; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr class="border-t">
            <td class="px-4 py-3 font-medium"><?php echo e($t->name); ?></td>
            <td class="px-4 py-3"><?php echo e($t->email); ?></td>
            <td class="px-4 py-3"><?php echo e($t->phone); ?></td>
            <td class="px-4 py-3"><?php echo e($t->reports_count); ?></td>
            <td class="px-4 py-3"><?php echo $t->active ? '<span class="text-emerald-600">●</span> Sí' : '<span class="text-red-500">●</span> No'; ?></td>
            <td class="px-4 py-3 text-right">
                <a href="<?php echo e(route('supervisor.technicians.edit', $t)); ?>" class="text-blue-600 hover:underline">Editar</a>
                <form action="<?php echo e(route('supervisor.technicians.destroy', $t)); ?>" method="POST" class="inline" onsubmit="return confirm('¿Desactivar?')">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button class="text-red-600 hover:underline ml-2">Desactivar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<div class="mt-4"><?php echo e($technicians->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\02-DEVCIJM\00-Proyectos\protecnic.com.mx\resources\views/supervisor/technicians/index.blade.php ENDPATH**/ ?>