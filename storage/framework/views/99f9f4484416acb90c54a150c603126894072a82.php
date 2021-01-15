<?php $__env->startSection('content'); ?>

    <h1 class="text-3xl pb-4"><?php echo e($serie->title); ?></h1>

    <ul class="">

        <?php $__currentLoopData = $serie->seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <li>Saison <?php echo e($season->season_number); ?> (<?php echo e(count($season->episodes)); ?> épisodes)</li>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </ul>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH U:\wamp64\www\Paul\resources\views/pages/serie.blade.php ENDPATH**/ ?>