

<?php $__env->startSection('title', 'Meet Details'); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .animation-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    


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
                style="background: linear-gradient(180deg, #EBC0C0 0%, #E6D2D2 100%); min-height: calc(100vh - 70px);">

                <div class="bg-white rounded-4 p-5 shadow-sm mx-auto animation-fade-in" style="max-width: 900px;">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <h3 class="fw-bold m-0">Meet Details</h3>
                        <a href="<?php echo e(route('superadmin.dashboard')); ?>" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="bi bi-arrow-left me-2"></i>Back
                        </a>
                    </div>

                    <div class="text-center mb-5">
                        <h2 class="fw-bold text-dark"><?php echo e($meet->name); ?></h2>
                        <?php
                            $badgeClass = match ($meet->status) {
                                'Upcoming' => 'bg-success',
                                'Ongoing' => 'bg-primary',
                                'Completed' => 'bg-secondary',
                                default => 'bg-secondary'
                            };
                        ?>
                        <span class="badge <?php echo e($badgeClass); ?> px-3 py-2 rounded-pill mt-2"><?php echo e($meet->status); ?></span>
                    </div>

                    <div class="row g-4">
                        
                        <div class="col-md-6">
                            <div class="mb-4 border-bottom pb-3">
                                <label class="text-secondary small d-block mb-1">Meet Code</label>
                                <div class="fw-bold fs-5"><?php echo e($meet->code); ?></div>
                            </div>
                            <div class="mb-4 border-bottom pb-3">
                                <label class="text-secondary small d-block mb-1">Start Date</label>
                                <div class="fw-bold fs-5"><?php echo e($meet->start_date ? $meet->start_date->format('d M Y') : '-'); ?></div>
                            </div>
                            <div class="mb-4 border-bottom pb-3">
                                <label class="text-secondary small d-block mb-1">End Date</label>
                                <div class="fw-bold fs-5"><?php echo e($meet->end_date ? $meet->end_date->format('d M Y') : '-'); ?></div>
                            </div>
                        </div>

                        
                        <div class="col-md-6">
                            <div class="mb-4 border-bottom pb-3">
                                <label class="text-secondary small d-block mb-1">Venue</label>
                                <div class="fw-bold fs-5"><?php echo e($meet->venue); ?></div>
                            </div>
                            <div class="mb-4 border-bottom pb-3">
                                <label class="text-secondary small d-block mb-1">Created By</label>
                                <div class="fw-bold fs-5"><?php echo e($meet->created_by); ?></div>
                            </div>
                            <div class="mb-4 border-bottom pb-3">
                                <label class="text-secondary small d-block mb-1">Notes</label>
                                <div class="fw-bold fs-5 fst-italic text-muted"><?php echo e($meet->notes ?? '-'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\.gemini\antigravity\scratch\BDT-K1-Swiming-System\resources\views/dashboard/superadmin/show-meet.blade.php ENDPATH**/ ?>