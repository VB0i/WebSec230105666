<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aziz's website - <?php echo $__env->yieldContent('title'); ?></title>
    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
    <script src="<?php echo e(asset('js/bootstrap.bundle.min.js')); ?>"></script>
</head>
<body>
    <?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Practice/WebSecService/resources/views/layouts/master.blade.php ENDPATH**/ ?>