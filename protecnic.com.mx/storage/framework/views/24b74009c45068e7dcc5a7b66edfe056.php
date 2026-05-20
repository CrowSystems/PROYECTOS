<?php $__env->startSection('title', 'Editar equipo'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex items-center gap-3 mb-6">
    <a href="<?php echo e(route('assets.index')); ?>" class="text-slate-500 hover:text-slate-700">&larr; Volver</a>
    <h1 class="text-2xl font-bold text-slate-800">Editar equipo <?php echo e($asset->code); ?></h1>
</div>

<div class="bg-white rounded-xl shadow p-6">
    <form action="<?php echo e(route('assets.update', $asset)); ?>" method="POST">
        <?php echo method_field('PUT'); ?>
        <?php echo $__env->make('assets._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </form>
</div>

<?php if($asset->assignments->count()): ?>
<div class="bg-white rounded-xl shadow p-6 mt-6">
    <h2 class="text-lg font-bold text-slate-800 mb-3">Historial de asignaciones</h2>
    <table class="min-w-full text-sm">
        <thead class="bg-slate-100 text-left text-xs uppercase tracking-wider text-slate-600">
            <tr>
                <th class="px-3 py-2">Colaborador</th>
                <th class="px-3 py-2">Asignado</th>
                <th class="px-3 py-2">Liberado</th>
                <th class="px-3 py-2">Notas</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $asset->assignments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-t">
                    <td class="px-3 py-2"><?php echo e($h->user->name); ?></td>
                    <td class="px-3 py-2 text-slate-600"><?php echo e($h->assigned_at?->format('d/m/Y H:i')); ?></td>
                    <td class="px-3 py-2 text-slate-600">
                        <?php echo e($h->released_at ? $h->released_at->format('d/m/Y H:i') : '— vigente —'); ?>

                    </td>
                    <td class="px-3 py-2 text-slate-600">
                        <?php echo e($h->assignment_notes); ?>

                        <?php if($h->release_notes): ?><div class="text-xs text-slate-500">Baja: <?php echo e($h->release_notes); ?></div><?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\02-DEVCIJM\00-Proyectos\protecnic.com.mx\resources\views/assets/edit.blade.php ENDPATH**/ ?>