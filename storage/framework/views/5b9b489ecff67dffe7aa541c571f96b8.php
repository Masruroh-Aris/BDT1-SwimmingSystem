

<?php $__env->startSection('title', 'Event Details'); ?>

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
                        <a href="<?php echo e(route('superadmin.manage-event')); ?>"
                            class="nav-link text-dark fs-6">Manage Event</a>
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
                        <h3 class="fw-bold m-0">Event Details</h3>
                        <a href="<?php echo e(route('superadmin.manage-event')); ?>" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="bi bi-arrow-left me-2"></i>Back
                        </a>
                    </div>

                    <div class="text-center mb-5">
                        <h2 class="fw-bold text-dark"><?php echo e($event->name); ?></h2>
                        <span class="badge bg-success px-3 py-2 rounded-pill mt-2"><?php echo e($event->status); ?></span>
                    </div>

                    <div class="row g-4">
                        
                        <div class="col-md-6">
                            <div class="mb-4 border-bottom pb-3">
                                <label class="text-secondary small d-block mb-1">Event Code</label>
                                <div class="fw-bold fs-5"><?php echo e($event->code); ?></div>
                            </div>
                            <div class="mb-4 border-bottom pb-3">
                                <label class="text-secondary small d-block mb-1">Start Time</label>
                                <div class="fw-bold fs-5"><?php echo e($event->start_time); ?></div>
                            </div>
                            <div class="mb-4 border-bottom pb-3">
                                <label class="text-secondary small d-block mb-1">Registration Fees</label>
                                <div class="fw-bold fs-5">Rp <?php echo e(number_format($event->fee, 0, ',', '.')); ?></div>
                            </div>
                            <div class="mb-4 border-bottom pb-3">
                                <label class="text-secondary small d-block mb-1">Gender</label>
                                <div class="fw-bold fs-5"><?php echo e($event->gender); ?></div>
                            </div>
                        </div>

                        
                        <div class="col-md-6">
                            <div class="mb-4 border-bottom pb-3">
                                <label class="text-secondary small d-block mb-1">Age Group</label>
                                <div class="fw-bold fs-5"><?php echo e($event->age_group); ?></div>
                            </div>
                            <div class="mb-4 border-bottom pb-3">
                                <label class="text-secondary small d-block mb-1">Heat</label>
                                <div class="fw-bold fs-5"><?php echo e($event->heat); ?></div>
                            </div>
                            <div class="mb-4 border-bottom pb-3">
                                <label class="text-secondary small d-block mb-1">Relay Event</label>
                                <div class="fw-bold fs-5 <?php echo e($event->relay ? 'text-success' : 'text-danger'); ?>">
                                    <?php echo e($event->relay ? 'Yes' : 'No'); ?>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\.gemini\antigravity\scratch\BDT-K1-Swiming-System\resources\views/dashboard/superadmin/actions/show-event.blade.php ENDPATH**/ ?>