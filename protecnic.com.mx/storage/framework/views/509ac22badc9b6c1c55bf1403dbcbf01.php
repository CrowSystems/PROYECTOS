<?php $__env->startSection('title', 'Marcas'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Marcas</h1>
    <a href="<?php echo e(route('content.brands.create')); ?>" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">+ Nueva marca</a>
</div>
<div class="bg-white rounded-xl shadow overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-100 text-left">
            <tr>
                <th class="px-4 py-3">Logo</th>
                <th class="px-4 py-3">Nombre</th>
                <th class="px-4 py-3">Descripción</th>
                <th class="px-4 py-3 text-center">Activa</th>
                <th class="px-4 py-3 text-center">En carrusel</th>
                <th class="px-4 py-3 text-center">Orden</th>
                <th class="px-4 py-3 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="border-t">
                <td class="px-4 py-3">
                    <?php if($b->logo_path): ?>
                        <img src="<?php echo e(asset('storage/'.$b->logo_path)); ?>" class="w-12 h-12 object-contain rounded">
                    <?php else: ?> <span class="text-slate-400">—</span> <?php endif; ?>
                </td>
                <td class="px-4 py-3 font-medium"><?php echo e($b->name); ?></td>
                <td class="px-4 py-3 text-slate-600"><?php echo e(Str::limit($b->description, 60)); ?></td>
                <td class="px-4 py-3 text-center"><?php echo $b->active ? '<span class="text-emerald-600">●</span> Sí' : '<span class="text-red-500">●</span> No'; ?></td>
                <td class="px-4 py-3 text-center">
                    <?php if($b->show_in_carousel): ?>
                        <span class="inline-block px-2 py-0.5 text-xs rounded bg-sky-100 text-sky-700 font-semibold">Sí</span>
                    <?php else: ?>
                        <span class="text-slate-400 text-xs">No</span>
                    <?php endif; ?>
                </td>
                <td class="px-4 py-3 text-center text-slate-600"><?php echo e($b->carousel_order); ?></td>
                <td class="px-4 py-3 text-right">
                    <a href="<?php echo e(route('content.brands.edit', $b)); ?>" class="text-blue-600 hover:underline">Editar</a>
                    <form action="<?php echo e(route('content.brands.destroy', $b)); ?>" method="POST" class="inline" onsubmit="return confirm('¿Eliminar?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button class="text-red-600 hover:underline ml-2">Eliminar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<div class="mt-4"><?php echo e($brands->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\02-DEVCIJM\00-Proyectos\protecnic.com.mx\resources\views/content/brands/index.blade.php ENDPATH**/ ?>