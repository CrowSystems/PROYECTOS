<?php $__env->startSection('title', 'Máquinas'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Máquinas</h1>
    <a href="<?php echo e(route('content.machines.create')); ?>" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">+ Nueva máquina</a>
</div>
<div class="bg-white rounded-xl shadow overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-100 text-left">
            <tr>
                <th class="px-4 py-3">Imagen</th>
                <th class="px-4 py-3">Nombre</th>
                <th class="px-4 py-3">Marca</th>
                <th class="px-4 py-3">Modelo</th>
                <th class="px-4 py-3">Activa</th>
                <th class="px-4 py-3 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $machines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="border-t">
                <td class="px-4 py-3">
                    <?php if($m->image_path): ?><img src="<?php echo e(asset('storage/'.$m->image_path)); ?>" class="w-12 h-12 object-cover rounded"><?php else: ?> <span class="text-slate-400">—</span> <?php endif; ?>
                </td>
                <td class="px-4 py-3 font-medium"><?php echo e($m->name); ?></td>
                <td class="px-4 py-3"><?php echo e($m->brand?->name ?? '—'); ?></td>
                <td class="px-4 py-3"><?php echo e($m->model); ?></td>
                <td class="px-4 py-3"><?php echo $m->active ? '<span class="text-emerald-600">●</span> Sí' : '<span class="text-red-500">●</span> No'; ?></td>
                <td class="px-4 py-3 text-right">
                    <a href="<?php echo e(route('content.machines.edit', $m)); ?>" class="text-blue-600 hover:underline">Editar</a>
                    <form action="<?php echo e(route('content.machines.destroy', $m)); ?>" method="POST" class="inline" onsubmit="return confirm('¿Eliminar?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button class="text-red-600 hover:underline ml-2">Eliminar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<div class="mt-4"><?php echo e($machines->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\02-DEVCIJM\00-Proyectos\protecnic.com.mx\resources\views/content/machines/index.blade.php ENDPATH**/ ?>