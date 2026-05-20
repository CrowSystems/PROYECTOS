<?php $__env->startSection('title', 'Inventario de equipos'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Inventario de equipos</h1>
        <p class="text-sm text-slate-500">Control de activos de TI y su asignación a colaboradores.</p>
    </div>
    <div class="flex gap-2">
        <button type="button"
                onclick="document.getElementById('modal-asignar').classList.remove('hidden')"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Asignar equipo
        </button>
        <a href="<?php echo e(route('assets.types.index')); ?>" class="bg-slate-200 hover:bg-slate-300 text-slate-800 px-4 py-2 rounded">
            Tipos
        </a>
        <a href="<?php echo e(route('assets.create')); ?>" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">
            + Nuevo equipo
        </a>
    </div>
</div>


<form method="GET" class="bg-white rounded-xl shadow p-4 mb-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
        <div>
            <label class="block text-xs font-medium text-slate-600 mb-1">Buscar</label>
            <input type="text" name="q" value="<?php echo e($filters['q'] ?? ''); ?>"
                   placeholder="Código, marca, serie..."
                   class="w-full px-3 py-2 border rounded-lg text-sm">
        </div>
        <div>
            <label class="block text-xs font-medium text-slate-600 mb-1">Tipo</label>
            <select name="type_id" class="w-full px-3 py-2 border rounded-lg text-sm">
                <option value="">Todos</option>
                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($t->id); ?>" <?php if(($filters['type_id'] ?? null) == $t->id): echo 'selected'; endif; ?>>
                        <?php echo e($t->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div>
            <label class="block text-xs font-medium text-slate-600 mb-1">Estatus</label>
            <select name="status" class="w-full px-3 py-2 border rounded-lg text-sm">
                <option value="">Todos</option>
                <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($value); ?>" <?php if(($filters['status'] ?? null) === $value): echo 'selected'; endif; ?>>
                        <?php echo e($label); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="flex items-end gap-2">
            <button class="bg-slate-800 hover:bg-slate-900 text-white px-4 py-2 rounded text-sm">Filtrar</button>
            <a href="<?php echo e(route('assets.index')); ?>" class="text-sm text-slate-600 hover:underline">Limpiar</a>
        </div>
    </div>
</form>


<div class="bg-white rounded-xl shadow overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-100 text-left text-xs uppercase tracking-wider text-slate-600">
            <tr>
                <th class="px-4 py-3">Equipo</th>
                <th class="px-4 py-3">Marca</th>
                <th class="px-4 py-3">Modelo</th>
                <th class="px-4 py-3">Tipo</th>
                <th class="px-4 py-3">N.º Serie</th>
                <th class="px-4 py-3">Ubicación</th>
                <th class="px-4 py-3">Asignado a</th>
                <th class="px-4 py-3">Estatus</th>
                <th class="px-4 py-3 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $statusColor = [
                        'available'      => 'bg-emerald-100 text-emerald-700',
                        'assigned'       => 'bg-blue-100 text-blue-700',
                        'maintenance'    => 'bg-amber-100 text-amber-700',
                        'decommissioned' => 'bg-slate-200 text-slate-600',
                    ][$a->status] ?? 'bg-slate-100 text-slate-700';
                ?>
                <tr class="border-t hover:bg-slate-50">
                    <td class="px-4 py-3 font-semibold text-slate-800"><?php echo e($a->code); ?></td>
                    <td class="px-4 py-3"><?php echo e($a->brand ?? '—'); ?></td>
                    <td class="px-4 py-3"><?php echo e($a->model ?? '—'); ?></td>
                    <td class="px-4 py-3 text-slate-600"><?php echo e($a->type?->name ?? '—'); ?></td>
                    <td class="px-4 py-3 text-slate-600"><?php echo e($a->serial_number ?? '—'); ?></td>
                    <td class="px-4 py-3 text-slate-600"><?php echo e($a->location ?? '—'); ?></td>
                    <td class="px-4 py-3 text-slate-700">
                        <?php if($a->currentAssignment): ?>
                            <div class="font-medium"><?php echo e($a->currentAssignment->user->name); ?></div>
                            <div class="text-xs text-slate-500"><?php echo e($a->currentAssignment->user->roleLabel()); ?></div>
                        <?php else: ?>
                            <span class="text-slate-400">— sin asignar —</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded text-xs font-semibold <?php echo e($statusColor); ?>">
                            <?php echo e($a->statusLabel()); ?>

                        </span>
                    </td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <?php if($a->isAssigned()): ?>
                            <form action="<?php echo e(route('assets.release', $a)); ?>" method="POST" class="inline"
                                  onsubmit="return confirm('¿Liberar la asignación del equipo <?php echo e($a->code); ?> de <?php echo e($a->currentAssignment->user->name); ?>?');">
                                <?php echo csrf_field(); ?>
                                <button class="text-amber-600 hover:text-amber-800 font-medium">BAJA</button>
                            </form>
                        <?php endif; ?>
                        <a href="<?php echo e(route('assets.edit', $a)); ?>" class="text-blue-600 hover:underline ml-2">Modificar</a>
                        <form action="<?php echo e(route('assets.destroy', $a)); ?>" method="POST" class="inline"
                              onsubmit="return confirm('¿Eliminar este equipo del inventario?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="text-red-600 hover:underline ml-2">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="9" class="px-4 py-10 text-center text-slate-500">
                        No hay equipos registrados con los filtros aplicados.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="mt-4"><?php echo e($assets->links()); ?></div>


<div id="modal-asignar" class="hidden fixed inset-0 bg-black/50 z-40 flex items-start justify-center p-4 overflow-y-auto">
    <div class="bg-white rounded-xl shadow-xl max-w-3xl w-full mt-12">
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h2 class="text-lg font-bold text-slate-800">Asignar equipo a colaborador</h2>
            <button type="button"
                    onclick="document.getElementById('modal-asignar').classList.add('hidden')"
                    class="text-slate-400 hover:text-slate-600 text-2xl leading-none">&times;</button>
        </div>

        <form action="<?php echo e(route('assets.assign')); ?>" method="POST" class="px-6 py-4">
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Colaboradores sin equipo
                        <span class="text-xs text-slate-500">(<?php echo e($usersWithoutEquipment->count()); ?>)</span>
                    </label>
                    <select name="user_id" required size="8"
                            class="w-full border rounded-lg p-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                        <?php $__empty_1 = true; $__currentLoopData = $usersWithoutEquipment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <option value="<?php echo e($u->id); ?>">
                                <?php echo e($u->name); ?> — <?php echo e($u->roleLabel()); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <option disabled>Todos los colaboradores ya tienen equipo asignado.</option>
                        <?php endif; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Equipos disponibles
                        <span class="text-xs text-slate-500">(<?php echo e($availableAssets->count()); ?>)</span>
                    </label>
                    <select name="asset_id" required size="8"
                            class="w-full border rounded-lg p-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                        <?php $__empty_1 = true; $__currentLoopData = $availableAssets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $av): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <option value="<?php echo e($av->id); ?>">
                                <?php echo e($av->code); ?> — <?php echo e($av->type?->name); ?> <?php echo e($av->brand); ?> <?php echo e($av->model); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <option disabled>No hay equipos disponibles para asignar.</option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Notas de la asignación (opcional)</label>
                <textarea name="assignment_notes" rows="2"
                          class="w-full border rounded-lg px-3 py-2 text-sm"
                          placeholder="Ej. Entrega en oficina central, con maletín y cargador."></textarea>
            </div>

            <div class="flex justify-end gap-2 mt-5">
                <button type="button"
                        onclick="document.getElementById('modal-asignar').classList.add('hidden')"
                        class="bg-slate-200 hover:bg-slate-300 px-4 py-2 rounded text-sm">
                    Cancelar
                </button>
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                    Confirmar asignación
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\02-DEVCIJM\00-Proyectos\protecnic.com.mx\resources\views/assets/index.blade.php ENDPATH**/ ?>