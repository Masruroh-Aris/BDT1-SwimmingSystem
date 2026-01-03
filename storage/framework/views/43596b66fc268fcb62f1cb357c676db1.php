

<?php $__env->startSection('title', 'Daftar Akun | Swim Event'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/login.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section class="login-role">
    
    <div class="login-left">
        <div class="login-content text-center">

            
            <h3 class="gudea-bold">Buat Akun Baru</h3>
            <h5 class="gudea-regular">Pilih jenis akun untuk didaftarkan</h5>

            
            <?php if(session('google_user')): ?>
                
                <div class="google-user-info mb-4 p-3 bg-white bg-opacity-10 rounded">
                    <div class="d-flex align-items-center justify-content-center gap-3">
                        <?php if(session('google_user')['avatar']): ?>
                            <img src="<?php echo e(session('google_user')['avatar']); ?>" alt="Profile" class="rounded-circle" style="width: 50px; height: 50px;">
                        <?php else: ?>
                            <i class="ri-user-fill text-white" style="font-size: 50px;"></i>
                        <?php endif; ?>
                        <div class="text-start">
                            <h6 class="text-white mb-0"><?php echo e(session('google_user')['name']); ?></h6>
                            <small class="text-white-50"><?php echo e(session('google_user')['email']); ?></small>
                        </div>
                    </div>
                </div>

                
                <form id="google-register-form" action="<?php echo e(route('register.google.submit')); ?>" method="POST" style="display: none;">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="google_id" value="<?php echo e(session('google_user')['id']); ?>">
                    <input type="hidden" name="name" value="<?php echo e(session('google_user')['name']); ?>">
                    <input type="hidden" name="email" value="<?php echo e(session('google_user')['email']); ?>">
                    <input type="hidden" name="avatar" value="<?php echo e(session('google_user')['avatar'] ?? ''); ?>">
                    <input type="hidden" name="role" id="selected-role" value="">
                    <input type="hidden" name="subrole" id="selected-subrole" value="">
                </form>
            <?php endif; ?>

            
            <div class="d-grid gap-3 w-100">
                <?php if(session('google_user')): ?>
                    
                    <button type="button" onclick="selectRole('admin')" class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                        <i class="ri-shield-user-fill role-icon"></i>
                        <span class="role-text">Admin</span>
                    </button>

                    <button type="button" onclick="selectRole('superadmin')" class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                        <i class="ri-vip-crown-fill role-icon"></i>
                        <span class="role-text">Superadmin</span>
                    </button>

                    <button type="button" onclick="selectRole('operator')" class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                        <i class="ri-file-list-3-line role-icon"></i>
                        <span class="role-text">Operator</span>
                    </button>
                <?php else: ?>
                    
                    <a href="<?php echo e(route('register.subrole', ['role' => 'admin'])); ?>" class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                        <i class="ri-shield-user-fill role-icon"></i>
                        <span class="role-text">Admin</span>
                    </a>

                    <a href="<?php echo e(route('register.subrole', ['role' => 'superadmin'])); ?>" class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                        <i class="ri-vip-crown-fill role-icon"></i>
                        <span class="role-text">Superadmin</span>
                    </a>

                    <a href="<?php echo e(route('register.operator', ['role' => 'operator'])); ?>" class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                        <i class="ri-file-list-3-line role-icon"></i>
                        <span class="role-text">Operator</span>
                    </a>
                <?php endif; ?>
            </div>

            
            <p class="mt-4 gudea-regular">
                Sudah punya akun?
                <a href="<?php echo e(route('login')); ?>" class="text-light fw-bold text-decoration-underline">
                    Masuk di sini
                </a>
            </p>
        </div>
    </div>

    
    <div class="login-right">
        <img src="<?php echo e(asset('images/ex.jpg')); ?>" 
             alt="Swim Event Illustration" 
             class="img-fluid rounded shadow">
    </div>
</section>

<?php $__env->startPush('scripts'); ?>
<?php if(session('google_user')): ?>
<script>
function selectRole(role) {
    if (role === 'admin' || role === 'superadmin') {
        // For admin/superadmin, redirect to subrole selection
        window.location.href = '<?php echo e(route("register.subrole", ":role")); ?>'.replace(':role', role);
    } else {
        // For operator, directly submit
        document.getElementById('selected-role').value = role;
        document.getElementById('google-register-form').submit();
    }
}
</script>
<?php endif; ?>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\.gemini\antigravity\scratch\BDT-K1-Swiming-System\resources\views/public/auth/register-role.blade.php ENDPATH**/ ?>