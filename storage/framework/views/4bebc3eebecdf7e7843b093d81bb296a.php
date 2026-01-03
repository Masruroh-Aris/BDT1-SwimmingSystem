

<?php $__env->startSection('title', 'Login | Swim Event'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/login.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
$role = request('role');
?>

<section class="login-role">
    
    <div class="login-left">
        <div class="login-content text-center">
            <h5 class="gudea-regular">Pilih Sub-Role untuk <?php echo e(ucfirst($role)); ?></h5>

            <div class="d-grid gap-3 w-100">
                
                <?php if($role == 'admin'): ?>
                    <a href="<?php echo e(route('login.form.email', ['role' => 'admin', 'subrole' => 'club'])); ?>" 
                       class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                        <i class="ri-medal-fill role-icon"></i>
                        <span class="role-text">Club</span>
                    </a>
                    <a href="<?php echo e(route('login.form.email', ['role' => 'admin', 'subrole' => 'school'])); ?>" 
                       class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                        <i class="ri-building-line role-icon"></i>
                        <span class="role-text">School</span>
                    </a>

                    <a href="<?php echo e(route('login.form.email', ['role' => 'admin', 'subrole' => 'university'])); ?>" 
                       class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                        <i class="ri-bank-line role-icon"></i>
                        <span class="role-text">University</span>
                    </a>

                
                <?php elseif($role == 'superadmin'): ?>
                    <a href="<?php echo e(route('login.form.email', ['role' => 'superadmin', 'subrole' => 'nation'])); ?>" 
                       class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                        <i class="ri-earth-line role-icon"></i>
                        <span class="role-text">Nation</span>
                    </a>

                    <a href="<?php echo e(route('login.form.email', ['role' => 'superadmin', 'subrole' => 'province'])); ?>" 
                       class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                        <i class="ri-map-pin-2-line role-icon"></i>
                        <span class="role-text">Province</span>
                    </a>

                    <a href="<?php echo e(route('login.form.email', ['role' => 'superadmin', 'subrole' => 'city'])); ?>" 
                       class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                        <i class="ri-building-4-line role-icon"></i>
                        <span class="role-text">City</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="login-right">
        <img src="<?php echo e(asset('images/ex.jpg')); ?>" 
             alt="Swim Event Illustration" 
             class="img-fluid">
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\.gemini\antigravity\scratch\BDT-K1-Swiming-System\resources\views/public/auth/LoginRole/login-subrole.blade.php ENDPATH**/ ?>