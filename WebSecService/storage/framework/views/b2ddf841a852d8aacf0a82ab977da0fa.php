<?php $__env->startSection('title', 'Edit User'); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-center">
    <div class="row m-4 col-sm-8">
        <form action="<?php echo e(route('save_password', $user->id)); ?>" method="post">
            <?php echo e(csrf_field()); ?>

            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="alert alert-danger">
            <strong>Error!</strong> <?php echo e($error); ?>

            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if(!auth()->user()->hasPermissionTo('admin_users') || auth()->id()==$user->id): ?>
                <div class="row mb-2">
                    <div class="col-12">
                        <label class="form-label">Old Password:</label>
                        <input type="password" class="form-control" placeholder="Old Password" name="old_password" required>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row mb-2">
                <div class="col-12">
                    <label class="form-label">Password:</label>
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                </div>
            </div>
            
            <div class="row mb-2">
                <div class="col-12">
                    <label class="form-label">Password Confirmtion:</label>
                    <input type="password" class="form-control" placeholder="Password Confirmtion" name="password_confirmation" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Practice/WebSecService/resources/views/users/edit_password.blade.php ENDPATH**/ ?>