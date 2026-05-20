<?php $__env->startSection('title', 'Productos · Protecnic'); ?>

<?php $__env->startSection('content'); ?>
<section class="relative hero-bg text-white py-20 overflow-hidden">
    <?php echo $__env->make('public.partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <div class="relative z-10 max-w-7xl mx-auto px-6 mt-12">
        <h1 class="text-4xl md:text-5xl font-extrabold">Productos</h1>
        <p class="text-slate-200 mt-2">Catálogo de máquinas y soluciones CNC.</p>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <?php if($items->count()): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="bg-white border border-slate-200 rounded-2xl overflow-hidden hover:shadow-xl transition">
                        <?php if($p->image_path): ?>
                            <img src="<?php echo e(asset('storage/'.$p->image_path)); ?>" alt="<?php echo e($p->name); ?>" class="w-full h-48 object-cover">
                        <?php else: ?>
                            <div class="w-full h-48 bg-slate-100 flex items-center justify-center text-slate-300">Sin imagen</div>
                        <?php endif; ?>
                        <div class="p-5">
                            <p class="text-xs text-sky-600 font-semibold uppercase"><?php echo e($p->brand?->name); ?> · <?php echo e($p->product_type); ?></p>
                            <h3 class="font-bold text-slate-900 mt-1"><?php echo e($p->name); ?></h3>
                            <?php if($p->price): ?>
                                <p class="text-emerald-600 font-extrabold mt-2 text-lg">$<?php echo e(number_format((float)$p->price, 2)); ?></p>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="mt-8"><?php echo e($items->links()); ?></div>
        <?php else: ?>
            <p class="text-center text-slate-500 py-20">Aún no hay productos publicados.</p>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('public.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\02-DEVCIJM\00-Proyectos\protecnic.com.mx\resources\views/public/pages/products.blade.php ENDPATH**/ ?>