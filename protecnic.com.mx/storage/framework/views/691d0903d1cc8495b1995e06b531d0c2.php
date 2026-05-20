
<div class="relative p-6 md:p-10 flex items-center justify-center">
    <svg viewBox="0 0 600 400" class="w-full max-w-xl" xmlns="http://www.w3.org/2000/svg">
        
        <path d="M40 120
                 Q60 80, 120 90
                 Q180 95, 220 110
                 Q280 105, 330 130
                 Q380 140, 420 150
                 L460 170
                 Q500 175, 530 200
                 Q545 230, 530 260
                 Q510 290, 470 295
                 Q430 305, 400 295
                 Q380 320, 365 340
                 Q345 360, 330 340
                 Q310 320, 290 310
                 Q260 305, 240 290
                 Q200 270, 180 250
                 Q150 240, 120 230
                 Q90 210, 70 190
                 Q50 160, 40 120 Z"
              fill="#1e3a8a" stroke="#3b82f6" stroke-width="1.5" opacity="0.6"/>

        
        <path d="M55 115 Q60 130 65 165 Q70 195 80 215 Q85 200 80 175 Q75 145 70 125 Z"
              fill="#1e3a8a" stroke="#3b82f6" stroke-width="1"/>

        
        <path d="M480 230 Q510 220 525 230 Q535 250 520 270 Q505 275 485 265 Z"
              fill="#1e3a8a" stroke="#3b82f6" stroke-width="1"/>

        
        <?php
            $states = [
                ['name' => 'Monterrey',    'short' => 'NL',  'cx' => 300, 'cy' => 165],
                ['name' => 'Guadalajara',  'short' => 'JAL', 'cx' => 240, 'cy' => 220],
                ['name' => 'Querétaro',    'short' => 'QRO', 'cx' => 310, 'cy' => 240],
                ['name' => 'CDMX',         'short' => 'CMX', 'cx' => 335, 'cy' => 255],
            ];
        ?>

        <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <g class="mx-state-group" data-name="<?php echo e($s['name']); ?>">
                
                <circle cx="<?php echo e($s['cx']); ?>" cy="<?php echo e($s['cy']); ?>" r="22"
                        fill="#38bdf8" opacity="0.15"/>
                <circle class="state-dot" cx="<?php echo e($s['cx']); ?>" cy="<?php echo e($s['cy']); ?>" r="10"
                        fill="#0ea5e9"
                        onmouseover="this.setAttribute('r', 16); this.setAttribute('fill', '#7dd3fc');"
                        onmouseout="this.setAttribute('r', 10); this.setAttribute('fill', '#0ea5e9');"/>
                <text x="<?php echo e($s['cx'] + 15); ?>" y="<?php echo e($s['cy'] - 10); ?>"
                      fill="white" font-size="13" font-weight="bold"><?php echo e($s['name']); ?></text>
            </g>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
        <text x="510" y="395" fill="#94a3b8" font-size="10">@ Protecnic 2025</text>
    </svg>
</div>
<?php /**PATH D:\02-DEVCIJM\00-Proyectos\protecnic.com.mx\resources\views/public/partials/mexico-map.blade.php ENDPATH**/ ?>