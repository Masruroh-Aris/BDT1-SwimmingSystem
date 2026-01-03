

<?php $__env->startSection('title', 'Edit Meet'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid p-0">
        <div class="row g-0" style="min-height: calc(100vh - 70px);">
            
            <div class="col-md-2 bg-white border-end py-4 d-flex flex-column align-items-center position-fixed h-100"
                style="top: 70px; z-index: 100;">

                
                <div class="text-center mb-5 mt-3">
                    <i class="bi bi-person-circle display-1"></i>
                    <h4 class="fw-bold mt-3">Superadmin</h4>
                    <a href="<?php echo e(route('superadmin.profile.edit')); ?>" class="text-info text-decoration-none small">Edit
                        Profile</a>
                </div>

                
                <div class="w-100 px-3">
                    <nav class="nav flex-column gap-1">
                        <a href="<?php echo e(route('superadmin.dashboard')); ?>" class="nav-link text-dark fs-6">Meet</a>
                        <a href="<?php echo e(route('superadmin.manage-meet')); ?>" class="nav-link text-dark fs-6">Manage Meet</a>
                        <a href="<?php echo e(route('superadmin.manage-event')); ?>" class="nav-link text-dark fs-6">Manage Event</a>
                        <a href="<?php echo e(route('superadmin.manage.regist')); ?>" class="nav-link text-dark fs-6">Manage
                            Registration</a>
                        <a href="#" class="nav-link text-dark fs-6 mt-4" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </nav>
                </div>
            </div>

            
            <div class="col-md-10 offset-md-2 p-5"
                style="background: linear-gradient(180deg, #cc4e4a 0%, #E6D2D2 100%); min-height: calc(100vh - 70px);">

                <div class="bg-white rounded-4 p-5 shadow-sm mx-auto" style="max-width: 900px;">
                    <h3 class="fw-bold text-center mb-5">Edit Meet</h3>
                    
                    
                    <form action="<?php echo e(route('superadmin.manage-meet.update', $meet->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="row g-4">
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">Meet Name</label>
                                    <input type="text" name="name" class="form-control fst-italic text-secondary"
                                        placeholder="meet name" value="<?php echo e(old('name', $meet->name)); ?>"
                                        style="border: 1px solid #dee2e6; border-radius: 10px; padding: 10px;">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">Meet Code</label>
                                    <input type="text" name="code" class="form-control fst-italic text-secondary"
                                        placeholder="meet code" value="<?php echo e(old('code', $meet->code)); ?>"
                                        style="border: 1px solid #dee2e6; border-radius: 10px; padding: 10px;">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">Start Date</label>
                                    <input type="date" name="start_date" class="form-control fst-italic text-secondary"
                                        placeholder="start date" value="<?php echo e(old('start_date', $meet->start_date->format('Y-m-d'))); ?>"
                                        style="border: 1px solid #dee2e6; border-radius: 10px; padding: 10px;">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">End Date</label>
                                    <input type="date" name="end_date" class="form-control fst-italic text-secondary"
                                        placeholder="end date" value="<?php echo e(old('end_date', $meet->end_date->format('Y-m-d'))); ?>"
                                        style="border: 1px solid #dee2e6; border-radius: 10px; padding: 10px;">
                                </div>
                            </div>

                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">Venue</label>
                                    <input type="text" name="venue" class="form-control fst-italic text-secondary"
                                        placeholder="venue" value="<?php echo e(old('venue', $meet->venue)); ?>"
                                        style="border: 1px solid #dee2e6; border-radius: 10px; padding: 10px;">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">Status</label>
                                    <select name="status" class="form-select fst-italic text-secondary"
                                        style="border: 1px solid #dee2e6; border-radius: 10px; padding: 10px;">
                                        <option value="" disabled>Select Status</option>
                                        <option value="Upcoming" <?php echo e(old('status', $meet->status) == 'Upcoming' ? 'selected' : ''); ?>>Upcoming</option>
                                        <option value="Ongoing" <?php echo e(old('status', $meet->status) == 'Ongoing' ? 'selected' : ''); ?>>Ongoing</option>
                                        <option value="Completed" <?php echo e(old('status', $meet->status) == 'Completed' ? 'selected' : ''); ?>>Completed</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">Created by</label>
                                    <input type="text" name="created_by" class="form-control fst-italic text-secondary"
                                        placeholder="created" value="<?php echo e(old('created_by', $meet->created_by)); ?>"
                                        style="border: 1px solid #dee2e6; border-radius: 10px; padding: 10px;">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">Notes</label>
                                    <input type="text" name="notes" class="form-control fst-italic text-secondary"
                                        placeholder="notes" value="<?php echo e(old('notes', $meet->notes)); ?>"
                                        style="border: 1px solid #dee2e6; border-radius: 10px; padding: 10px;">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">Logo</label>
                                    <?php if($meet->logo): ?>
                                        <div class="mb-2">
                                            <img src="<?php echo e(asset($meet->logo)); ?>" alt="Current Logo" style="max-height: 50px;">
                                        </div>
                                    <?php endif; ?>
                                    <input type="file" name="logo" class="form-control fst-italic text-secondary"
                                        style="border: 1px solid #dee2e6; border-radius: 10px; padding: 10px;">
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <button type="submit" class="btn text-white fw-bold px-5 py-2 rounded-3"
                                style="background-color: #A93333;">Update Meet</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\.gemini\antigravity\scratch\BDT-K1-Swiming-System\resources\views/dashboard/superadmin/actions/ManageMeet/edit-meet-sadm.blade.php ENDPATH**/ ?>