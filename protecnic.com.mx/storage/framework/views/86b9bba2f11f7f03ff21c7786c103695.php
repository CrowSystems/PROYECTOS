<?php $__env->startSection('title', 'Tipos de equipo'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Tipos de equipo</h1>
        <p class="text-sm text-slate-500">Catálogo editable: laptop, celular, switch, AP, etc.</p>
    </div>
    <div class="flex gap-2">
        <a href="<?php echo e(route('assets.index')); ?>" class="bg-slate-200 hover:bg-slate-300 text-slate-800 px-4 py-2 rounded">
            ← Inventario
        </a>
        <a href="<?php echo e(route('assets.types.create')); ?>" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">
            + Nuevo tipo
        </a>
    </div>
</div>

<div class="bg-white rounded-xl shadow overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-100 text-left text-xs uppercase tracking-wider text-slate-600">
            <tr>
                <th class="px-4 py-3">Nombre</th>
                <th class="px-4 py-3">Slug</th>
                <th class="px-4 py-3">Equipos</th>
                <th class="px-4 py-3">Activo</th>
                <th class="px-4 py-3 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-t">
                    <td class="px-4 py-3 font-medium"><?php echo e($t->name); ?></td>
                    <td class="px-4 py-3 text-slate-500 text-xs"><?php echo e($t->slug); ?></td>
                    <td class="px-4 py-3"><?php echo e($t->assets_count); ?></td>
                    <td class="px-4 py-3">
                        <?php if($t->active): ?><span class="text-emerald-600">●</span> Activo
                        <?php else: ?><span class="text-slate-400">●</span> Inactivo
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <a href="<?php echo e(route('assets.types.edit', $t)); ?>" class="text-blue-600 hover:underline">Editar</a>
                        <form action="<?php echo e(route('assets.types.destroy', $t)); ?>" method="POST" class="inline"
                              onsubmit="return confirm('¿Eliminar este tipo?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="text-red-600 hover:underline ml-2">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="5" class="px-4 py-10 text-center text-slate-500">No hay tipos registrados.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="mt-4"><?php echo e($types->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\02-DEVCIJM\00-Proyectos\protecnic.com.mx\resources\views/assets/types/index.blade.php ENDPATH**/ ?>