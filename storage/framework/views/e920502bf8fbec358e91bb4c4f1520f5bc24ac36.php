<?php $__env->startSection('content'); ?>
    <h1 class="text-3xl">Ma page d'accueil</h1>
    <p>Bonjour, je suis <?php echo e($name); ?></p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH U:\wamp64\www\Paul\resources\views/pages/hello.blade.php ENDPATH**/ ?>