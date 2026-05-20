<?php $__env->startSection('title', $event->title.' · Protecnic'); ?>

<?php $__env->startSection('content'); ?>
<section class="relative hero-bg text-white py-20 overflow-hidden">
    <?php echo $__env->make('public.partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <div class="relative z-10 max-w-7xl mx-auto px-6 mt-12">
        <a href="<?php echo e(route('public.events.index')); ?>" class="text-sky-300 hover:text-white text-sm">&larr; Volver a eventos</a>
        <h1 class="text-4xl md:text-5xl font-extrabold mt-4"><?php echo e($event->title); ?></h1>
        <?php if($event->subtitle): ?>
            <p class="text-slate-200 mt-2 text-lg"><?php echo e($event->subtitle); ?></p>
        <?php endif; ?>
        <div class="text-xs text-sky-300 uppercase tracking-widest mt-2">
            <?php echo e($event->event_date?->format('d M Y')); ?> <?php echo e($event->location ? '· '.$event->location : ''); ?>

        </div>
    </div>
</section>

<?php if($event->main_image_path): ?>
    <div class="bg-black">
        <img src="<?php echo e(asset('storage/'.$event->main_image_path)); ?>" alt="<?php echo e($event->title); ?>"
             class="w-full max-h-[500px] object-cover">
    </div>
<?php endif; ?>

<section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-6 prose prose-slate">
        <?php echo nl2br(e($event->body)); ?>

    </div>
</section>

<?php if($event->images->count()): ?>
<section class="py-10 bg-slate-50">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl font-extrabold text-slate-800 mb-6">Galería</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <?php $__currentLoopData = $event->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(asset('storage/'.$img->image_path)); ?>" target="_blank"
                   class="block aspect-square rounded-lg overflow-hidden bg-slate-200">
                    <img src="<?php echo e(asset('storage/'.$img->image_path)); ?>" alt="<?php echo e($img->caption); ?>"
                         class="w-full h-full object-cover hover:scale-105 transition duration-500">
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if($event->brands->count()): ?>
<section class="py-10 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl font-extrabold text-slate-800 mb-6">Proveedores que participaron</h2>
        <div class="flex flex-wrap gap-4 items-center">
            <?php $__currentLoopData = $event->brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white border border-slate-200 rounded-xl p-4 w-40 h-24 flex items-center justify-center shadow-sm">
                    <?php if($b->hasLogo()): ?>
                        <img src="<?php echo e($b->logoUrl()); ?>" alt="<?php echo e($b->name); ?>" class="max-h-12 object-contain">
                    <?php else: ?>
                        <span class="font-bold text-slate-700"><?php echo e($b->name); ?></span>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('public.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\02-DEVCIJM\00-Proyectos\protecnic.com.mx\resources\views/public/events/show.blade.php ENDPATH**/ ?>