<?php
    // Si no hay eventos en BD, mostramos placeholders demostrativos (3 imágenes referenciadas en el documento)
    $eventsToShow = $events ?? collect();
    if (! $eventsToShow->count()) {
        $eventsToShow = collect([
            (object)['title' => 'Expo Maq 2024', 'subtitle' => 'Expo',         'slug' => null, 'main_image_path' => null, 'event_date' => null],
            (object)['title' => 'Seminario Técnico', 'subtitle' => 'Seminario','slug' => null, 'main_image_path' => null, 'event_date' => null],
            (object)['title' => 'Open House Protecnic', 'subtitle' => 'Open',  'slug' => null, 'main_image_path' => null, 'event_date' => null],
            (object)['title' => 'Mexitec 2025',  'subtitle' => 'Expo',         'slug' => null, 'main_image_path' => null, 'event_date' => null],
        ]);
    }
    $first  = $eventsToShow->get(0);
    $second = $eventsToShow->get(1);
    $third  = $eventsToShow->get(2);
    $fourth = $eventsToShow->get(3);

    $eventUrl = function ($e) {
        return $e?->slug ? route('public.events.show', $e->slug) : route('public.events.index');
    };
?>

<section id="eventos" class="bg-white pb-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-end justify-between mb-6">
            <div>
                <p class="text-sky-600 font-semibold text-sm tracking-wider uppercase">Comunidad</p>
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mt-1">Eventos</h2>
            </div>
            <a href="<?php echo e(route('public.events.index')); ?>" class="text-sky-600 hover:text-sky-700 font-medium text-sm">
                Ver todos →
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-3 h-[420px]">

            
            <?php if($first): ?>
                <a href="<?php echo e($eventUrl($first)); ?>"
                   class="relative md:col-span-1 md:row-span-2 rounded-xl overflow-hidden group bg-slate-300">
                    <?php if($first->main_image_path ?? null): ?>
                        <img src="<?php echo e(asset('storage/'.$first->main_image_path)); ?>" alt="<?php echo e($first->title); ?>"
                             class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <?php else: ?>
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-700 to-slate-900"></div>
                    <?php endif; ?>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-black/10"></div>
                    <span class="absolute top-4 left-4 text-white text-xs uppercase tracking-widest font-bold bg-sky-600 px-2 py-1 rounded">EVENTOS</span>
                    <span class="absolute bottom-4 left-4 text-white text-2xl font-extrabold"><?php echo e($first->title); ?></span>
                </a>
            <?php endif; ?>

            
            <div class="md:col-span-2 grid grid-rows-2 gap-3">
                <?php $__currentLoopData = [$second, $third]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($e): ?>
                        <a href="<?php echo e($eventUrl($e)); ?>"
                           class="relative rounded-xl overflow-hidden group bg-slate-300">
                            <?php if($e->main_image_path ?? null): ?>
                                <img src="<?php echo e(asset('storage/'.$e->main_image_path)); ?>" alt="<?php echo e($e->title); ?>"
                                     class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <?php else: ?>
                                <div class="absolute inset-0 bg-gradient-to-br from-slate-600 to-slate-800"></div>
                            <?php endif; ?>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-black/10"></div>
                            <span class="absolute bottom-3 left-4 text-white text-xl font-bold"><?php echo e($e->title); ?></span>
                        </a>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <?php if($fourth): ?>
                <a href="<?php echo e($eventUrl($fourth)); ?>"
                   class="relative md:col-span-1 md:row-span-2 rounded-xl overflow-hidden group bg-slate-300">
                    <?php if($fourth->main_image_path ?? null): ?>
                        <img src="<?php echo e(asset('storage/'.$fourth->main_image_path)); ?>" alt="<?php echo e($fourth->title); ?>"
                             class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <?php else: ?>
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-700 to-slate-900"></div>
                    <?php endif; ?>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-black/10"></div>
                    <span class="absolute bottom-4 left-4 text-white text-2xl font-extrabold"><?php echo e($fourth->title); ?></span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php /**PATH D:\02-DEVCIJM\00-Proyectos\protecnic.com.mx\resources\views/public/partials/events-section.blade.php ENDPATH**/ ?>