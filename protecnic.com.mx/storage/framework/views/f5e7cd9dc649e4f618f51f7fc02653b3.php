<?php echo csrf_field(); ?>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium mb-1">Nombre</label>
        <input type="text" name="name" value="<?php echo e(old('name', $product->name)); ?>" required class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">SKU</label>
        <input type="text" name="sku" value="<?php echo e(old('sku', $product->sku)); ?>" class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Marca</label>
        <select name="brand_id" class="w-full px-3 py-2 border rounded-lg">
            <option value="">— sin marca —</option>
            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($b->id); ?>" <?php if(old('brand_id', $product->brand_id) == $b->id): echo 'selected'; endif; ?>><?php echo e($b->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Tipo de producto</label>
        <input type="text" name="product_type" value="<?php echo e(old('product_type', $product->product_type)); ?>" class="w-full px-3 py-2 border rounded-lg" placeholder="Refacción / Consumible / etc.">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Precio</label>
        <input type="number" step="0.01" name="price" value="<?php echo e(old('price', $product->price)); ?>" class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Imagen</label>
        <input type="file" name="image" accept="image/*">
        <?php if($product->image_path): ?><img src="<?php echo e(asset('storage/'.$product->image_path)); ?>" class="mt-2 h-20"><?php endif; ?>
    </div>
    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Descripción</label>
        <textarea name="description" rows="3" class="w-full px-3 py-2 border rounded-lg"><?php echo e(old('description', $product->description)); ?></textarea>
    </div>
    <div>
        <label class="flex items-center">
            <input type="hidden" name="active" value="0">
            <input type="checkbox" name="active" value="1" class="mr-2" <?php if(old('active', $product->active ?? 1)): echo 'checked'; endif; ?>>
            Activo
        </label>
    </div>
</div>
<div class="mt-6 flex gap-2">
    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">Guardar</button>
    <a href="<?php echo e(route('content.products.index')); ?>" class="bg-gray-200 px-4 py-2 rounded">Cancelar</a>
</div>
<?php /**PATH D:\02-DEVCIJM\00-Proyectos\protecnic.com.mx\resources\views/content/products/_form.blade.php ENDPATH**/ ?>