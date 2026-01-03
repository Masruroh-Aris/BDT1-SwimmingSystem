

<?php $__env->startSection('title', 'Login | Swim Event'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/login.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section class="login-role">
    
    <div class="login-left">
        <div class="login-content text-center">
            <h1 class="gudea-bold">Swim Event</h1>
            <h4 class="gudea-regular">Swimming Competition</h4>

            <h3 class="gudea-bold">Selamat Datang!</h3>
            <h5 class="gudea-regular">Pilih jenis akun untuk melanjutkan</h5>

            
            <div class="d-grid gap-3 w-100">


                <a href="<?php echo e(route('login.login-subrole', ['role' => 'admin'])); ?>" class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                    <i class="ri-shield-user-fill role-icon"></i>
                    <span class="role-text">Admin</span>
                </a>

                <a href="<?php echo e(route('login.login-subrole', ['role' => 'superadmin'])); ?>" class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                    <i class="ri-vip-crown-fill role-icon"></i>
                    <span class="role-text">Superadmin</span>
                </a>


            </div>


        </div>
    </div>

    
    <div class="login-right">
        <img src="<?php echo e(asset('images/ex.jpg')); ?>" 
             alt="Swim Event Illustration" 
             class="img-fluid rounded shadow">
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\.gemini\antigravity\scratch\BDT-K1-Swiming-System\resources\views/public/auth/LoginRole/LoginRole.blade.php ENDPATH**/ ?>