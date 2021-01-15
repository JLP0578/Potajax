<?php $__env->startSection('content'); ?>

    <h1 class="text-3xl pb-4">Séries</h1>

    <?php $__currentLoopData = $series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <h2><a class="hover:text-blue-600" href="<?php echo e(route('serie', ['serie_id' => $serie->id])); ?>"><?php echo e($serie->title); ?></a></h2>

        <ul class="pl-4">

            <?php $__currentLoopData = $serie->seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <li>Saison <?php echo e($season->season_number); ?> (<?php echo e(count($season->episodes)); ?> épisodes)</li>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </ul>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH U:\wamp64\www\Paul\resources\views/pages/series_list.blade.php ENDPATH**/ ?>