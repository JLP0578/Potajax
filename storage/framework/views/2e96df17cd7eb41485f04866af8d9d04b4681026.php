<!doctype html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        <!-- ... -->
    </head>
    <body class="text-gray-700">
        <?php echo $__env->make('layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="p-8">

            <?php echo $__env->yieldContent('content'); ?>

        </div>

    </body>
</html>
<?php /**PATH U:\wamp64\www\Potajax\resources\views/layouts/app.blade.php ENDPATH**/ ?>