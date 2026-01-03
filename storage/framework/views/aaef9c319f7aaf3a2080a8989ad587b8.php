

<?php $__env->startSection('title', 'Daftar Akun | Swim Event'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/login.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
$role = request('role');
?>
<?php
$role = trim(request('role') ?? '');
?>


<section class="login-role">
    
    <div class="login-left">
        <div class="login-content text-center">

            
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
                    <input type="hidden" name="role" value="<?php echo e($role); ?>">
                    <input type="hidden" name="subrole" id="selected-subrole" value="">
                </form>
            <?php endif; ?>

            
            <h5 class="gudea-bold mb-3">Pilih Sub-Role untuk <?php echo e(ucfirst($role)); ?></h5>

            <div class="d-grid gap-3 w-100">
                
                <?php if($role == 'admin'): ?>
                    <?php if(session('google_user')): ?>
                        <button type="button" onclick="selectSubrole('club')" class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                            <i class="ri-medal-fill role-icon"></i>
                            <span class="role-text">Club</span>
                        </button>

                        <button type="button" onclick="selectSubrole('school')" class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                            <i class="ri-building-line role-icon"></i>
                            <span class="role-text">School</span>
                        </button>

                        <button type="button" onclick="selectSubrole('university')" class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                            <i class="ri-bank-line role-icon"></i>
                            <span class="role-text">University</span>
                        </button>
                    <?php else: ?>
                        <a href="<?php echo e(route('register.form', ['role' => 'admin', 'subrole' => 'club'])); ?>" 
                           class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                            <i class="ri-medal-fill role-icon"></i>
                            <span class="role-text">Club</span>
                        </a>

                        <a href="<?php echo e(route('register.form', ['role' => 'admin', 'subrole' => 'school'])); ?>" 
                           class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                            <i class="ri-building-line role-icon"></i>
                            <span class="role-text">School</span>
                        </a>

                        <a href="<?php echo e(route('register.form', ['role' => 'admin', 'subrole' => 'university'])); ?>" 
                           class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                            <i class="ri-bank-line role-icon"></i>
                            <span class="role-text">University</span>
                        </a>
                    <?php endif; ?>

                
                <?php elseif($role == 'superadmin'): ?>
                    <?php if(session('google_user')): ?>
                        <button type="button" onclick="selectSubrole('nation')" class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                            <i class="ri-earth-line role-icon"></i>
                            <span class="role-text">Nation</span>
                        </button>

                        <button type="button" onclick="selectSubrole('province')" class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                            <i class="ri-map-pin-2-line role-icon"></i>
                            <span class="role-text">Province</span>
                        </button>

                        <button type="button" onclick="selectSubrole('city')" class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                            <i class="ri-building-4-line role-icon"></i>
                            <span class="role-text">City</span>
                        </button>
                    <?php else: ?>
                        <a href="<?php echo e(route('register.form', ['role' => 'superadmin', 'subrole' => 'nation'])); ?>" 
                           class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                            <i class="ri-earth-line role-icon"></i>
                            <span class="role-text">Nation</span>
                        </a>

                        <a href="<?php echo e(route('register.form', ['role' => 'superadmin', 'subrole' => 'province'])); ?>" 
                           class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                            <i class="ri-map-pin-2-line role-icon"></i>
                            <span class="role-text">Province</span>
                        </a>

                        <a href="<?php echo e(route('register.form', ['role' => 'superadmin', 'subrole' => 'city'])); ?>" 
                           class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                            <i class="ri-building-4-line role-icon"></i>
                            <span class="role-text">City</span>
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
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

<?php $__env->startPush('scripts'); ?>
<?php if(session('google_user')): ?>
<script>
    function selectSubrole(subrole) {
        document.getElementById('selected-subrole').value = subrole;
        document.getElementById('google-register-form').submit();
    }
</script>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\.gemini\antigravity\scratch\BDT-K1-Swiming-System\resources\views/public/auth/register-subrole.blade.php ENDPATH**/ ?>