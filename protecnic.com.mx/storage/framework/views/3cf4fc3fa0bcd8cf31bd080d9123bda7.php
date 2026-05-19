<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', config('app.name')); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', system-ui, sans-serif; }
        .sidebar-link.active { background-color: #1e293b; color: #fff; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
<?php if(auth()->guard()->check()): ?>
<div class="flex min-h-screen">
    
    <aside class="w-64 bg-slate-900 text-slate-200 flex flex-col">
        <div class="p-6 border-b border-slate-800">
            <h1 class="text-xl font-bold text-white">Portal Reportes</h1>
            <p class="text-xs text-slate-400 mt-1"><?php echo e(auth()->user()->roleLabel()); ?></p>
        </div>
        <nav class="flex-1 p-4 space-y-1 text-sm">
            <a href="<?php echo e(route('dashboard')); ?>" class="sidebar-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?> block px-3 py-2 rounded hover:bg-slate-800">
                Dashboard
            </a>

            <?php if(auth()->user()->isAdmin()): ?>
                <div class="pt-4 pb-1 px-3 text-xs uppercase text-slate-500">Administración</div>
                <a href="<?php echo e(route('admin.users.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?> block px-3 py-2 rounded hover:bg-slate-800">Usuarios</a>
            <?php endif; ?>

            <?php if(auth()->user()->hasRole([\App\Models\User::ROLE_ADMIN, \App\Models\User::ROLE_CONTENT_EDITOR])): ?>
                <div class="pt-4 pb-1 px-3 text-xs uppercase text-slate-500">Contenido</div>
                <a href="<?php echo e(route('content.brands.index')); ?>"   class="sidebar-link <?php echo e(request()->routeIs('content.brands.*') ? 'active' : ''); ?> block px-3 py-2 rounded hover:bg-slate-800">Marcas</a>
                <a href="<?php echo e(route('content.machines.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('content.machines.*') ? 'active' : ''); ?> block px-3 py-2 rounded hover:bg-slate-800">Máquinas</a>
                <a href="<?php echo e(route('content.products.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('content.products.*') ? 'active' : ''); ?> block px-3 py-2 rounded hover:bg-slate-800">Productos</a>
            <?php endif; ?>

            <?php if(auth()->user()->hasRole([\App\Models\User::ROLE_ADMIN, \App\Models\User::ROLE_SUPERVISOR])): ?>
                <div class="pt-4 pb-1 px-3 text-xs uppercase text-slate-500">Supervisión</div>
                <a href="<?php echo e(route('supervisor.reports.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('supervisor.reports.*') ? 'active' : ''); ?> block px-3 py-2 rounded hover:bg-slate-800">Reportes a validar</a>
                <a href="<?php echo e(route('supervisor.technicians.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('supervisor.technicians.*') ? 'active' : ''); ?> block px-3 py-2 rounded hover:bg-slate-800">Técnicos</a>
            <?php endif; ?>

            <?php if(auth()->user()->hasRole([\App\Models\User::ROLE_ADMIN, \App\Models\User::ROLE_TECHNICIAN])): ?>
                <div class="pt-4 pb-1 px-3 text-xs uppercase text-slate-500">Operación</div>
                <a href="<?php echo e(route('technician.reports.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('technician.reports.*') ? 'active' : ''); ?> block px-3 py-2 rounded hover:bg-slate-800">Mis reportes</a>
                <a href="<?php echo e(route('technician.reports.create')); ?>" class="block px-3 py-2 rounded bg-emerald-600 hover:bg-emerald-700 text-white mt-2">+ Nuevo reporte</a>
            <?php endif; ?>
        </nav>
        <div class="p-4 border-t border-slate-800 text-sm">
            <div class="text-slate-300"><?php echo e(auth()->user()->name); ?></div>
            <form method="POST" action="<?php echo e(route('logout')); ?>"><?php echo csrf_field(); ?>
                <button class="mt-2 text-slate-400 hover:text-white text-xs">Cerrar sesión</button>
            </form>
        </div>
    </aside>

    
    <main class="flex-1 p-8">
        <?php if(session('success')): ?>
            <div class="mb-4 p-4 bg-emerald-100 text-emerald-800 rounded"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded"><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                <ul class="list-disc pl-5">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </main>
</div>
<?php else: ?>
    <?php echo $__env->yieldContent('content'); ?>
<?php endif; ?>
</body>
</html>
<?php /**PATH D:\02-DEVCIJM\00-Proyectos\protecnic.com.mx\resources\views/layouts/app.blade.php ENDPATH**/ ?>