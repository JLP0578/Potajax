<?php $__env->startSection('content'); ?>
    <h1 class="text-3xl">Ma page d'accueil</h1>
    <p>Bonjour, je suis <?php echo e($name); ?></p>

    <?php if(count($likes) > 0): ?>
        <p>j'aime:
        <?php $__currentLoopData = $likes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $like): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($loop->last): ?> et <?php endif; ?> <?php echo e($like); ?><?php if(!$loop->last): ?>, <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </p>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH U:\wamp64\www\Paul\resources\views/pages/home.blade.php ENDPATH**/ ?>