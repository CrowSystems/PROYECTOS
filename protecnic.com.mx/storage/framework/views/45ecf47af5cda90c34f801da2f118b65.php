<?php $__env->startSection('title', 'Reportes a validar'); ?>
<?php $__env->startSection('content'); ?>
<div class="mb-6">
    <h1 class="text-2xl font-bold">Reportes a validar</h1>
    <p class="text-slate-500">Revisa, aprueba o rechaza los reportes generados por los técnicos.</p>
</div>

<div class="mb-4 flex flex-wrap gap-2">
    <a href="<?php echo e(route('supervisor.reports.index')); ?>" class="px-3 py-1.5 rounded <?php echo e(!$status ? 'bg-slate-800 text-white' : 'bg-white border'); ?>">Todos</a>
    <?php $__currentLoopData = \App\Models\Report::STATUS_LABELS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('supervisor.reports.index', ['status' => $val])); ?>"
           class="px-3 py-1.5 rounded <?php echo e($status === $val ? 'bg-slate-800 text-white' : 'bg-white border'); ?>">
            <?php echo e($label); ?>

        </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="bg-white rounded-xl shadow overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-100 text-left">
            <tr>
                <th class="px-4 py-3">Código</th>
                <th class="px-4 py-3">Técnico</th>
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
                <td class="px-4 py-3"><?php echo e($r->technician?->name); ?></td>
                <td class="px-4 py-3"><?php echo e($r->client?->name ?? '—'); ?></td>
                <td class="px-4 py-3"><?php echo e($r->machine?->name ?? $r->machine_name_snapshot); ?></td>
                <td class="px-4 py-3 text-slate-600"><?php echo e(optional($r->service_date)->format('d/m/Y') ?? $r->created_at->format('d/m/Y')); ?></td>
                <td class="px-4 py-3"><span class="text-xs px-2 py-1 rounded <?php echo e($r->statusColor()); ?>"><?php echo e($r->statusLabel()); ?></span></td>
                <td class="px-4 py-3 text-right">
                    <a href="<?php echo e(route('supervisor.reports.show', $r)); ?>" class="text-blue-600 hover:underline">Ver</a>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="7" class="px-4 py-8 text-center text-slate-500">No hay reportes.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<div class="mt-4"><?php echo e($reports->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\02-DEVCIJM\00-Proyectos\protecnic.com.mx\resources\views/supervisor/reports/index.blade.php ENDPATH**/ ?>