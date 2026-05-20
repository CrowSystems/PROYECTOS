<?php echo csrf_field(); ?>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium mb-1">Nombre</label>
        <input type="text" name="name" value="<?php echo e(old('name', $machine->name)); ?>" required class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Marca</label>
        <select name="brand_id" class="w-full px-3 py-2 border rounded-lg">
            <option value="">— sin marca —</option>
            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($b->id); ?>" <?php if(old('brand_id', $machine->brand_id) == $b->id): echo 'selected'; endif; ?>><?php echo e($b->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Modelo</label>
        <input type="text" name="model" value="<?php echo e(old('model', $machine->model)); ?>" class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Serie</label>
        <input type="text" name="serial" value="<?php echo e(old('serial', $machine->serial)); ?>" class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Descripción</label>
        <textarea name="description" rows="3" class="w-full px-3 py-2 border rounded-lg"><?php echo e(old('description', $machine->description)); ?></textarea>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Imagen</label>
        <input type="file" name="image" accept="image/*">
        <?php if($machine->image_path): ?><img src="<?php echo e(asset('storage/'.$machine->image_path)); ?>" class="mt-2 h-20"><?php endif; ?>
    </div>
    <div class="flex items-end">
        <label class="flex items-center">
            <input type="hidden" name="active" value="0">
            <input type="checkbox" name="active" value="1" class="mr-2" <?php if(old('active', $machine->active ?? 1)): echo 'checked'; endif; ?>>
            Activa
        </label>
    </div>
</div>
<div class="mt-6 flex gap-2">
    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">Guardar</button>
    <a href="<?php echo e(route('content.machines.index')); ?>" class="bg-gray-200 px-4 py-2 rounded">Cancelar</a>
</div>
<?php /**PATH D:\02-DEVCIJM\00-Proyectos\protecnic.com.mx\resources\views/content/machines/_form.blade.php ENDPATH**/ ?>