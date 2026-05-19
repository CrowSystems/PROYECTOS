<?php $__env->startSection('title', 'Iniciar sesión'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-900 to-slate-700">
    <div class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-md">
        <h1 class="text-2xl font-bold text-slate-800 mb-1">Portal Reportes</h1>
        <p class="text-slate-500 mb-6">Inicia sesión para continuar</p>

        <?php if($errors->any()): ?>
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded text-sm">
                <?php echo e($errors->first()); ?>

            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-4">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Correo electrónico</label>
                <input type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Contraseña</label>
                <input type="password" name="password" required
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
            </div>
            <label class="flex items-center text-sm text-slate-600">
                <input type="checkbox" name="remember" class="mr-2"> Recordarme
            </label>
            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 rounded-lg font-medium">
                Entrar
            </button>
        </form>

        <div class="mt-6 p-3 bg-slate-50 rounded text-xs text-slate-600">
            <p class="font-semibold mb-1">Cuentas de prueba (password: <code>password</code>):</p>
            <ul class="space-y-0.5">
                <li>admin@portal.test</li>
                <li>contenido@portal.test</li>
                <li>supervisor@portal.test</li>
                <li>tecnico@portal.test</li>
            </ul>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\02-DEVCIJM\00-Proyectos\protecnic.com.mx\resources\views/auth/login.blade.php ENDPATH**/ ?>