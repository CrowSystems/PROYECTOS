<?php $__env->startSection('title', 'Mis reportes'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Mis reportes</h1>
    <a href="<?php echo e(route('technician.reports.create')); ?>" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">+ Nuevo reporte</a>
</div>
<div class="bg-white rounded-xl shadow overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-100 text-left">
            <tr>
                <th class="px-4 py-3">Código</th>
                <th class="px-4 py-3">Cliente</th>
                <th class="px-4 py-3">Máquina</th>
                <th class="px-4 py-3">Fecha</th>
                <th class="px-4 py-3">Estado</th>
                <th class="px-4 py-3 text-right">Acción</th>
            </tr>
        </thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr class="border-t">
            <td class="px-4 py-3 font-mono text-xs"><?php echo e($r->code); ?></td>
            <td class="px-4 py-3"><?php echo e($r->client?->name ?? '—'); ?></td>
            <td class="px-4 py-3"><?php echo e($r->machine?->name ?? $r->machine_name_snapshot); ?></td>
            <td class="px-4 py-3"><?php echo e(optional($r->service_date)->format('d/m/Y') ?? $r->created_at->format('d/m/Y')); ?></td>
            <td class="px-4 py-3"><span class="text-xs px-2 py-1 rounded <?php echo e($r->statusColor()); ?>"><?php echo e($r->statusLabel()); ?></span></td>
            <td class="px-4 py-3 text-right">
                <a href="<?php echo e(route('technician.reports.show', $r)); ?>" class="text-blue-600 hover:underline">Ver</a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="6" class="px-4 py-8 text-center text-slate-500">Aún no has creado reportes. <a href="<?php echo e(route('technician.reports.create')); ?>" class="text-emerald-600">Crear el primero →</a></td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<div class="mt-4"><?php echo e($reports->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\02-DEVCIJM\00-Proyectos\protecnic.com.mx\resources\views/technician/reports/index.blade.php ENDPATH**/ ?>