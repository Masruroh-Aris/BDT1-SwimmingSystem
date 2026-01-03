

<?php $__env->startSection('title', 'Buat Akun Baru | Swim Event'); ?>

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
        'user' => 'User',
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

            
            <h5 class="login-title gudea-bold">Buat Akun Baru
                <?php if($role === 'operator'): ?>
                    Operator
                <?php else: ?>
                    <?php echo e($roleNames[$role]); ?>

                    <?php if($subrole && isset($subroleNames[$subrole]) && $subroleNames[$subrole] !== ''): ?>
                        (<?php echo e($subroleNames[$subrole]); ?>)
                    <?php endif; ?>
                <?php endif; ?>
            </h5>


            
            <form method="POST" action="<?php echo e(route('register.submit')); ?>"> 
                <?php echo csrf_field(); ?>

                <input type="hidden" name="role" value="<?php echo e($role); ?>">
                <?php if($subrole): ?>
                    <input type="hidden" name="subrole" value="<?php echo e($subrole); ?>">
                <?php endif; ?>

                <div class="form-input-group">
                    <label class="form-label gudea-bold">Email</label>
                    <i class="ri-mail-line input-icon"></i>
                    <input type="email" name="email" class="form-control" placeholder="Email..." required>
                </div>

                <div class="form-input-group">
                    <label class="form-label gudea-bold">Password</label>
                    <i class="ri-lock-line input-icon"></i>
                    <input type="password" name="password" class="form-control" placeholder="Password..." required>
                </div>

                <div class="form-input-group">
                    <label class="form-label gudea-bold">Konfirmasi Password</label>
                    <i class="ri-lock-line input-icon"></i>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password..." required>
                </div>

                <button type="submit" class="btn btn-login w-100 gudea-bold">Daftar Akun</button>
            </form>
                        
            <div class="divider mt-4">
                <span class="divider-text">atau</span>
            </div>

            
            <a href="<?php echo e(route('google.register', ['role' => $role, 'subrole' => $subrole])); ?>" class="btn btn-google w-100">
                <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                Daftar dengan Google
            </a>
        </div>
    </div>

    
    <div class="login-right">
        <img src="<?php echo e(asset('images/ex.jpg')); ?>" class="login-image" alt="Swim Event Illustration">
    </div>

</section>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if(session('registration_success')): ?>
        Swal.fire({
            title: 'Akun Berhasil Dibuat!',
            text: 'Silakan login untuk melanjutkan.',
            icon: 'success',
            showCancelButton: true,
            confirmButtonText: 'Login',
            cancelButtonText: 'Back',
            confirmButtonColor: '#C32A25',
            cancelButtonColor: '#6c757d',
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo e(route('login')); ?>";
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                window.location.href = "<?php echo e(route('meets.index')); ?>"; // Or home '/'
            }
        });
    <?php endif; ?>
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\.gemini\antigravity\scratch\BDT-K1-Swiming-System\resources\views/public/auth/register-form.blade.php ENDPATH**/ ?>