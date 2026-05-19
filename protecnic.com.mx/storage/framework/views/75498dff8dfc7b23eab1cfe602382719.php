<?php $__env->startSection('title', 'Usuarios'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-slate-800">Usuarios</h1>
    <a href="<?php echo e(route('admin.users.create')); ?>" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">+ Nuevo usuario</a>
</div>

<div class="bg-white rounded-xl shadow overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-100 text-left">
            <tr>
                <th class="px-4 py-3">Nombre</th>
                <th class="px-4 py-3">Email</th>
                <th class="px-4 py-3">Rol</th>
                <th class="px-4 py-3">Activo</th>
                <th class="px-4 py-3 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-t">
                    <td class="px-4 py-3 font-medium"><?php echo e($u->name); ?></td>
                    <td class="px-4 py-3 text-slate-600"><?php echo e($u->email); ?></td>
                    <td class="px-4 py-3"><span class="px-2 py-1 rounded text-xs bg-slate-100"><?php echo e($u->roleLabel()); ?></span></td>
                    <td class="px-4 py-3">
                        <?php if($u->active): ?><span class="text-emerald-600">●</span> Activo
                        <?php else: ?><span class="text-red-500">●</span> Inactivo
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <a href="<?php echo e(route('admin.users.edit', $u)); ?>" class="text-blue-600 hover:underline">Editar</a>
                        <form action="<?php echo e(route('admin.users.destroy', $u)); ?>" method="POST" class="inline" onsubmit="return confirm('¿Eliminar usuario?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="text-red-600 hover:underline ml-2">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<div class="mt-4"><?php echo e($users->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\02-DEVCIJM\00-Proyectos\protecnic.com.mx\resources\views/admin/users/index.blade.php ENDPATH**/ ?>