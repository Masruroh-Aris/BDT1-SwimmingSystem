

<?php $__env->startSection('title', 'Add Athlete'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid p-0">
    <div class="row g-0" style="min-height: calc(100vh - 70px);">
        
        <div class="col-md-2 bg-white border-end py-4 d-flex flex-column align-items-center">
            
            
            <div class="text-center mb-5 mt-3">
                <i class="bi bi-person-circle display-1"></i>
                <h4 class="fw-bold mt-3">Oprator</h4>
                <a href="<?php echo e(route('operator.profile.edit')); ?>" class="text-info text-decoration-none small">Edit Profile</a>
            </div>

            
            <div class="w-100 px-3">
                <nav class="nav flex-column gap-3">
                    <a href="<?php echo e(route('operator.dashboard')); ?>" class="nav-link text-dark fs-5">Result</a>
                    <a href="<?php echo e(route('operator.athletes.index')); ?>" class="nav-link text-dark fs-5 fw-bold border-bottom border-dark pb-1">Athletes</a>
                    <a href="<?php echo e(route('operator.certificate.index')); ?>" class="nav-link text-dark fs-5">Certificate</a>
                    <a href="#" onclick="event.preventDefault(); try { document.getElementById('logout-form').submit(); } catch(e) { console.error('Logout error:', e); window.location.href='<?php echo e(route('logout')); ?>'; }" class="nav-link text-dark fs-5 mt-4">Logout</a>
                </nav>
            </div>
        </div>

        
        <div class="col-md-10 p-5" style="background: linear-gradient(180deg, #EBC0C0 0%, #E6D2D2 100%); min-height: calc(100vh - 70px);">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-dark">Add New Athlete</h2>
                <a href="<?php echo e(route('operator.athletes.index')); ?>" class="btn btn-outline-dark rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Back
                </a>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4">
                <div class="card-body">
                    <form action="<?php echo e(route('operator.athletes.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        
                        <div class="row g-3">
                            
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-bold">Athlete Name</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="name" name="name" value="<?php echo e(old('name')); ?>" required>
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            
                            <div class="col-md-6">
                                <label for="gender" class="form-label fw-bold">Gender</label>
                                <select class="form-select <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="gender" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male" <?php echo e(old('gender') == 'Male' ? 'selected' : ''); ?>>Male</option>
                                    <option value="Female" <?php echo e(old('gender') == 'Female' ? 'selected' : ''); ?>>Female</option>
                                </select>
                                <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            
                            <div class="col-md-6">
                                <label for="birth_date" class="form-label fw-bold">Birth Date</label>
                                <input type="date" class="form-control <?php $__errorArgs = ['birth_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="birth_date" name="birth_date" value="<?php echo e(old('birth_date')); ?>" required>
                                <?php $__errorArgs = ['birth_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            
                            <div class="col-md-6">
                                <label for="place_of_birth" class="form-label fw-bold">Place of Birth</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['place_of_birth'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="place_of_birth" name="place_of_birth" value="<?php echo e(old('place_of_birth')); ?>">
                                <?php $__errorArgs = ['place_of_birth'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            
                            <div class="col-md-12">
                                <label for="organization_id" class="form-label fw-bold">Organization (Admin - Club/School/University)</label>
                                <select class="form-select <?php $__errorArgs = ['organization_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="organization_id" name="organization_id" required>
                                    <option value="">Select Organization</option>
                                    <?php $__currentLoopData = $organizations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $org): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($org->id); ?>" <?php echo e(old('organization_id') == $org->id ? 'selected' : ''); ?>>
                                            <?php echo e($org->name); ?> (<?php echo e(ucfirst($org->sub_role ?? 'Admin')); ?>)
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="form-text mt-2 small text-muted">The system will automatically assign this to Club or Institution based on the organization type.</div>
                                <?php $__errorArgs = ['organization_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-12 mt-4 text-end">
                                <button type="submit" class="btn text-white fw-bold px-5 py-2 rounded-3 shadow-sm" style="background: linear-gradient(180deg, #A93333 0%, #8B1A1A 100%);">
                                    Save Athlete
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\.gemini\antigravity\scratch\BDT-K1-Swiming-System\resources\views/dashboard/operator/athletes/create.blade.php ENDPATH**/ ?>