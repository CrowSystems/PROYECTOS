<?php echo csrf_field(); ?>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium mb-1">Nombre</label>
        <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" required
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Email</label>
        <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" required
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Teléfono</label>
        <input type="text" name="phone" value="<?php echo e(old('phone', $user->phone)); ?>"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Rol</label>
        <select name="role" required class="w-full px-3 py-2 border rounded-lg">
            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($value); ?>" <?php if(old('role', $user->role) === $value): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">
            <?php echo e($user->exists ? 'Nueva contraseña (dejar vacío para no cambiar)' : 'Contraseña'); ?>

        </label>
        <input type="password" name="password" <?php echo e($user->exists ? '' : 'required'); ?>

               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div class="flex items-end">
        <label class="flex items-center">
            <input type="hidden" name="active" value="0">
            <input type="checkbox" name="active" value="1" class="mr-2" <?php if(old('active', $user->active ?? 1)): echo 'checked'; endif; ?>>
            Usuario activo
        </label>
    </div>
</div>
<div class="mt-6 flex gap-2">
    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">Guardar</button>
    <a href="<?php echo e(route('admin.users.index')); ?>" class="bg-gray-200 px-4 py-2 rounded">Cancelar</a>
</div>
<?php /**PATH D:\02-DEVCIJM\00-Proyectos\protecnic.com.mx\resources\views/admin/users/_form.blade.php ENDPATH**/ ?>