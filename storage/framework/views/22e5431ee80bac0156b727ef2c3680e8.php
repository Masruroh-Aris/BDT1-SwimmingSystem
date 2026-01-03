

<?php $__env->startSection('title', 'Login | Swim Event'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/login.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<?php
$role = request('role') ?? 'operator';
$subrole = request('subrole') ?? null;

$roleNames = [
    'admin' => 'Admin',
    'superadmin' => 'Superadmin',
    'operator' => 'Operator',
];

$subroleNames = [
    'club' => 'Club',
    'school' => 'School',
    'university' => 'University',
    'nation' => 'Nation',
    'province' => 'Province',
    'city' => 'City',
    'default' => '',
];
?>

<section class="login-page">

    
    <div class="login-left">
        <div class="login-card">

            
            <div class="login-icon">
                <i class="ri-user-3-fill"></i>
            </div>

            
            <h5 class="login-title gudea-bold">Masuk Sebagai 
                <?php if($role === 'operator'): ?>
                    Operator
                <?php else: ?>
                    <?php echo e($roleNames[$role]); ?>

                    <?php if($subrole && isset($subroleNames[$subrole]) && $subroleNames[$subrole] !== ''): ?>
                        (<?php echo e($subroleNames[$subrole]); ?>)
                    <?php endif; ?>
                <?php endif; ?>
            </h5>


            
            <div class="login-step">
                <div class="step-wrapper">
                    <div class="step-number-icon">2</div>
                    <span class="step-number gudea-bold">Langkah 2 dari 2</span>
                </div>
                <span class="step-desc gudea-regular">Masukkan password untuk masuk</span>
            </div>

            
            
            <form action="<?php echo e(route('login.perform')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <input type="hidden" name="email" value="<?php echo e(request('email')); ?>">
                <input type="hidden" name="role" value="<?php echo e($role); ?>">
                <?php if($subrole): ?>
                    <input type="hidden" name="subrole" value="<?php echo e($subrole); ?>">
                <?php endif; ?>
                
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <?php echo e($errors->first('email')); ?>

                    </div>
                <?php endif; ?>

                <div class="form-input-group">
                    <label class="form-label gudea-bold">Password</label>
                    <i class="ri-lock-line input-icon"></i>
                    <input type="password" name="password" class="form-control" placeholder="Password..." required>
                </div>

                
                <div class="form-extra d-flex justify-content-between align-items-center">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember" class="gudea-regular">Ingatkan saya</label>
                    </div>
                    <div class="forgot-password">
                        <a href="<?php echo e(route('password.request')); ?>"  class="gudea-bold">Lupa password?</a> 
                    </div>
                </div>

                <button type="submit" class="btn btn-login w-100 gudea-bold">Masuk ke Dashboard</button>
            </form>

        </div>
    </div>

    
    <div class="login-right">
        <img src="<?php echo e(asset('images/ex.jpg')); ?>"
             class="login-image" alt="Swim Event Illustration">
    </div>

</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\.gemini\antigravity\scratch\BDT-K1-Swiming-System\resources\views/public/auth/login-form-password.blade.php ENDPATH**/ ?>