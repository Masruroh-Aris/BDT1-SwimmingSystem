

<?php $__env->startSection('title', 'Login Operator | Swim Event'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/login.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<section class="login-page">

    
    <div class="login-left">
        <div class="login-card">

            
            <div class="login-icon">
                <i class="ri-user-3-fill"></i>
            </div>

            
            <h5 class="login-title gudea-bold">Login Operator</h5>

            
            <form action="<?php echo e(route('login.perform')); ?>" method="POST" class="mt-4">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="role" value="operator">

                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <?php echo e($errors->first()); ?>

                    </div>
                <?php endif; ?>

                
                <div class="form-input-group mb-3">
                    <label class="form-label">Alamat Email</label>
                    <i class="ri-mail-line input-icon"></i>
                    <input type="email" name="email" class="form-control" placeholder="Email..." required autofocus>
                </div>

                
                <div class="form-input-group mb-3">
                    <label class="form-label">Password</label>
                    <i class="ri-lock-line input-icon"></i>
                    <input type="password" name="password" class="form-control" placeholder="Password..." required>
                </div>

                
                <div class="form-extra d-flex justify-content-between align-items-center mb-4">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember" class="gudea-regular">Ingatkan saya</label>
                    </div>
                    
                </div>

                <button type="submit" class="btn btn-login w-100 gudea-bold">Masuk</button>
            </form>

            
            <div class="divider mt-4">
                <span class="divider-text">atau</span>
            </div>

            
            <a href="<?php echo e(route('google.login')); ?>" class="btn btn-google w-100">
                <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                Masuk dengan Google
            </a>

            <p class="signup-text gudea-regular">Belum punya akun?
                <a href="<?php echo e(route('register.operator')); ?>" class="gudea-bold">Daftar di sini</a>
            </p>

        </div>
    </div>

    
    <div class="login-right">
        <img src="<?php echo e(asset('images/ex.jpg')); ?>"
             class="login-image" alt="Swim Event Illustration">
    </div>

</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\.gemini\antigravity\scratch\BDT-K1-Swiming-System\resources\views/public/auth/login-operator.blade.php ENDPATH**/ ?>