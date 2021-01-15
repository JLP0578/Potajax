<?php $__env->startSection('content'); ?>

    <h1 class="text-3xl pb-4">Utilisateur</h1>

        <ul class="pl-4">

            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <li><?php echo e($user->name); ?></li>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </ul>

        <div class="pt-4">
            <?php echo e($users->links()); ?>

        </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH U:\wamp64\www\Paul\resources\views/pages/users_list.blade.php ENDPATH**/ ?>