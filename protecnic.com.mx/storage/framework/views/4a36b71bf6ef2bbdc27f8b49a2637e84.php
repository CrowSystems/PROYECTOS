<?php echo csrf_field(); ?>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">

    
    <div>
        <label class="block text-sm font-medium mb-1">Código / Nombre del equipo *</label>
        <input type="text" name="code" value="<?php echo e(old('code', $asset->code)); ?>" required
               placeholder="PROTECNIC-1"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Tipo *</label>
        <select name="asset_type_id" required class="w-full px-3 py-2 border rounded-lg">
            <option value="">Selecciona…</option>
            <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($t->id); ?>" <?php if(old('asset_type_id', $asset->asset_type_id) == $t->id): echo 'selected'; endif; ?>>
                    <?php echo e($t->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Estatus *</label>
        <select name="status" required class="w-full px-3 py-2 border rounded-lg">
            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($value); ?>" <?php if(old('status', $asset->status ?? 'available') === $value): echo 'selected'; endif; ?>>
                    <?php echo e($label); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Marca</label>
        <input type="text" name="brand" value="<?php echo e(old('brand', $asset->brand)); ?>"
               placeholder="LENOVO"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Modelo</label>
        <input type="text" name="model" value="<?php echo e(old('model', $asset->model)); ?>"
               placeholder="THINKPAD"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Costo</label>
        <input type="number" step="0.01" min="0" name="cost" value="<?php echo e(old('cost', $asset->cost)); ?>"
               class="w-full px-3 py-2 border rounded-lg">
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">N.º de serie</label>
        <input type="text" name="serial_number" value="<?php echo e(old('serial_number', $asset->serial_number)); ?>"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Service Tag</label>
        <input type="text" name="service_tag" value="<?php echo e(old('service_tag', $asset->service_tag)); ?>"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Ubicación</label>
        <input type="text" name="location" value="<?php echo e(old('location', $asset->location)); ?>"
               placeholder="Oficina Querétaro, piso 2"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
</div>

<h3 class="font-semibold text-slate-700 mt-6 mb-3">Especificaciones técnicas</h3>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div>
        <label class="block text-sm font-medium mb-1">Procesador</label>
        <input type="text" name="processor" value="<?php echo e(old('processor', $asset->processor)); ?>"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">RAM</label>
        <input type="text" name="ram" value="<?php echo e(old('ram', $asset->ram)); ?>"
               placeholder="16 GB DDR4"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Disco duro</label>
        <input type="text" name="disk" value="<?php echo e(old('disk', $asset->disk)); ?>"
               placeholder="512 GB SSD"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Sistema operativo</label>
        <input type="text" name="operating_system" value="<?php echo e(old('operating_system', $asset->operating_system)); ?>"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">MAC Ethernet</label>
        <input type="text" name="mac_ethernet" value="<?php echo e(old('mac_ethernet', $asset->mac_ethernet)); ?>"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">MAC Wi-Fi</label>
        <input type="text" name="mac_wifi" value="<?php echo e(old('mac_wifi', $asset->mac_wifi)); ?>"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
</div>

<h3 class="font-semibold text-slate-700 mt-6 mb-3">Fechas</h3>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div>
        <label class="block text-sm font-medium mb-1">Fecha de registro</label>
        <input type="date" name="registered_at"
               value="<?php echo e(old('registered_at', optional($asset->registered_at)->format('Y-m-d'))); ?>"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Último mantenimiento</label>
        <input type="date" name="last_maintenance_at"
               value="<?php echo e(old('last_maintenance_at', optional($asset->last_maintenance_at)->format('Y-m-d'))); ?>"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
</div>

<div class="mt-4">
    <label class="block text-sm font-medium mb-1">Notas / observaciones</label>
    <textarea name="notes" rows="3" class="w-full px-3 py-2 border rounded-lg"><?php echo e(old('notes', $asset->notes)); ?></textarea>
</div>

<div class="mt-6 flex gap-2">
    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">Guardar</button>
    <a href="<?php echo e(route('assets.index')); ?>" class="bg-gray-200 px-4 py-2 rounded">Cancelar</a>
</div>
<?php /**PATH D:\02-DEVCIJM\00-Proyectos\protecnic.com.mx\resources\views/assets/_form.blade.php ENDPATH**/ ?>