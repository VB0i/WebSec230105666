<?php $__env->startSection('title', 'User Profile'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="m-4 col-sm-6">
        <table class="table table-striped">
            <tr>
                <th>Name</th><td><?php echo e($user->name); ?></td>
            </tr>
            <tr>
                <th>Email</th><td><?php echo e($user->email); ?></td>
            </tr>
            <tr>
                <th>Roles</th>
                <td>
                    <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="badge bg-primary"><?php echo e($role->name); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
            </tr>
            <tr>
                <th>Credit Balance</th>
                <td>
                    <span class="badge bg-primary">$<?php echo e($user->credit); ?></span>

                    <?php if(auth()->user()->hasRole('Employee') && $user->hasRole('Customer')): ?>
                    <form method="POST" action="<?php echo e(route('users.addCredit', $user->id)); ?>" class="mt-2">
                        <?php echo csrf_field(); ?>
                        <div class="input-group">
                            <input type="number" name="amount" step="0.01" min="0.01" class="form-control" placeholder="Amount" required>
                            <button type="submit" class="btn btn-sm btn-success">Add Credit</button>
                        </div>
                    </form>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>Permissions</th>
                <td>
                    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="badge bg-success"><?php echo e($permission->display_name); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
            </tr>
        </table>

        <div class="row">
            <div class="col col-6">
            <?php if(auth()->user()->hasRole('Employee') || auth()->user()->hasRole('Admin')): ?>
                <a href="<?php echo e(route('customers.list')); ?>" class="btn btn-primary">Show Customers</a>
            <?php endif; ?>
            </div>
            <?php if(auth()->user()->hasPermissionTo('admin_users')||auth()->id()==$user->id): ?>
            <div class="col col-4">
                <a class="btn btn-primary" href='<?php echo e(route('edit_password', $user->id)); ?>'>Change Password</a>
            </div>
            <?php else: ?>
            <div class="col col-4">
            </div>
            <?php endif; ?>
            <?php if(auth()->user()->hasPermissionTo('edit_users')||auth()->id()==$user->id): ?>
            <div class="col col-2">
                <a href="<?php echo e(route('users_edit', $user->id)); ?>" class="btn btn-success form-control">Edit</a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Practice/WebSecService/resources/views/users/profile.blade.php ENDPATH**/ ?>