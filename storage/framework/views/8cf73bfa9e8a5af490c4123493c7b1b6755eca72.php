<?php $__env->startSection('content'); ?>

    <h1 class="text-3xl pb-4">Ajout d'une série</h1>

    <?php if(session('success')): ?>
        <div class="block mt-5 px-5 py-3 border-4 border-transparent bg-green-500 text-white-500 rounded"><?php echo e(session('success')); ?></div>
    <?php endif; ?>



    <form action="<?php echo e(route('serie_add_post')); ?>" method="post">

        <?php echo csrf_field(); ?>

        <label class="block mt-5" for="title">Titre: <span class="font-bold text-red-500 rounded">* </span>
        <?php if($errors->has('title')): ?>
            <span class="font-bold text-red-500 rounded"><?php echo e($errors->first('title')); ?></span>
        <?php endif; ?>
        </label>
        <input class="p-5 py-3 border-4 border-blue-500 bg-transparent text-blue-500 rounded focus:border-blue-700 text-blue-700 cursor-pointer" type="text" name="title" id="title" placeholder="Titre" value="<?php echo e(old('title')); ?>">


        <label class="block mt-5" for="released">Date de création:
        <?php if($errors->has('released')): ?>
            <span class="font-bold text-red-500 rounded"><?php echo e($errors->first('released')); ?></span>
        <?php endif; ?>
        </label>
        <input class="p-5 py-3 border-4 border-blue-500 bg-transparent text-blue-500 rounded focus:border-blue-700 text-blue-700 cursor-pointer" type="date" name="released" id="released" placeholder="Date de création" value="<?php echo e(old('released')); ?>">


        <label class="block mt-5" for="creator_name">Créateur:
        <?php if($errors->has('creator_name')): ?>
            <span class="font-bold text-red-500 rounded"><?php echo e($errors->first('creator_name')); ?></span>
        <?php endif; ?>
        </label>
        <input class="p-5 py-3 border-4 border-blue-500 bg-transparent text-blue-500 rounded focus:border-blue-700 text-blue-700 cursor-pointer" type="text" name="creator_name" id="creator_name" placeholder="Créateur" value="<?php echo e(old('creator_name')); ?>">


        <input class="block mt-5 px-5 py-3 border-4 border-blue-500 bg-transparent text-blue-500 rounded hover:border-blue-700 text-blue-700 cursor-pointer" type="submit" name="Valider" value="Valider">

    </form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH U:\wamp64\www\Paul\resources\views/pages/serie_add.blade.php ENDPATH**/ ?>