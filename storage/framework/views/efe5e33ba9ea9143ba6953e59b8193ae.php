

<?php $__env->startSection('title', 'Super Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .animation-fade-in {
        animation: fadeIn 0.8s ease-out forwards;
        opacity: 0;
        transform: translateY(20px);
    }

    @keyframes fadeIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hover-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
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

        
        <div class="col-md-10 offset-md-2 p-5" style="background: linear-gradient(180deg, #EBC0C0 0%, #E6D2D2 100%); min-height: calc(100vh - 70px);">
            
            
            <?php
                use Carbon\Carbon;
                $currentDate = Carbon::now('Asia/Jakarta');
                $hour = $currentDate->hour;
                
                if ($hour < 12) {
                    $greeting = 'Good Morning';
                } elseif ($hour < 18) {
                    $greeting = 'Good Afternoon';
                } else {
                    $greeting = 'Good Evening';
                }
            ?>
            <div class="mb-5 animation-fade-in">
                <h2 class="fw-bold display-6" style="color: #A93333;"><?php echo e($greeting); ?>, <?php echo e(Auth::user()->name); ?> 👋</h2>
                <p class="fs-5" style="color: #8B1A1A;">Welcome back to your dashboard overview.</p>
            </div>

            
            <div class="d-flex justify-content-end align-items-center mb-5">
                <form action="<?php echo e(route('superadmin.dashboard')); ?>" method="GET" class="bg-white rounded-pill px-4 py-2 d-flex align-items-center shadow-sm" style="width: 400px;">
                    <i class="bi bi-search me-2 text-dark"></i>
                    <input type="text" name="search" class="form-control border-0 shadow-none" placeholder="Search Meet" value="<?php echo e(request('search')); ?>">
                </form>
            </div>

            
            <div class="row g-4">
                
                <?php $__empty_1 = true; $__currentLoopData = $meets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3 hover-card animation-fade-in" onclick="window.location='<?php echo e(route('superadmin.meet.show', $meet->id)); ?>'">
                        <div class="card-body">
                            <h5 class="fw-bold text-center mb-4"><?php echo e($meet->name); ?></h5>
                            
                            <div class="row mb-2">
                                <div class="col-4 text-secondary small">Meet Code</div>
                                <div class="col-1 text-center">:</div>
                                <div class="col-7 small fw-bold"><?php echo e($meet->code); ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4 text-secondary small">Start Date</div>
                                <div class="col-1 text-center">:</div>
                                <div class="col-7 small"><?php echo e($meet->start_date->format('d/m/Y')); ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4 text-secondary small">End Date</div>
                                <div class="col-1 text-center">:</div>
                                <div class="col-7 small"><?php echo e($meet->end_date->format('d/m/Y')); ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4 text-secondary small">Venue</div>
                                <div class="col-1 text-center">:</div>
                                <div class="col-7 small"><?php echo e($meet->venue); ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4 text-secondary small">Status</div>
                                <div class="col-1 text-center">:</div>
                                <div class="col-7 small">
                                    <?php
                                        $statusClass = match(strtolower($meet->status)) {
                                            'upcoming' => 'text-success',
                                            'ongoing' => 'text-primary',
                                            'completed' => 'text-secondary',
                                            default => 'text-dark'
                                        };
                                    ?>
                                    <span class="<?php echo e($statusClass); ?> fw-bold"><?php echo e($meet->status); ?></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4 text-secondary small">Created</div>
                                <div class="col-1 text-center">:</div>
                                <div class="col-7 small"><?php echo e($meet->created_by); ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4 text-secondary small">Notes</div>
                                <div class="col-1 text-center">:</div>
                                <div class="col-7 small text-truncate"><?php echo e($meet->notes ?? '-'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No meets found.</p>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\.gemini\antigravity\scratch\BDT-K1-Swiming-System\resources\views/dashboard/superadmin/index-admdef.blade.php ENDPATH**/ ?>