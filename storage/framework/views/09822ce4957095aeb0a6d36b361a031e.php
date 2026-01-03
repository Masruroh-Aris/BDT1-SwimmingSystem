

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .hover-card {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    .hover-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 10px 20px rgba(0,0,0,0.12) !important;
    }
    .animate-fade-in {
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
        transform: translateY(20px);
    }
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid p-0">
    <div class="row g-0" style="min-height: calc(100vh - 70px);">
        
        <div class="col-md-2 bg-white border-end py-4 d-flex flex-column align-items-center">

            
            <div class="text-center mb-5">
                <i class="bi bi-person-circle display-1"></i>
                <h4 class="fw-bold mt-2">Admin</h4>
                <a href="<?php echo e(route('admin.profile.edit')); ?>" class="text-info text-decoration-none small">Edit Profile</a>
            </div>

            
            <div class="w-100 px-3">
                <nav class="nav flex-column gap-3">
                    <a href="<?php echo e(route('admin.register')); ?>" class="nav-link text-dark border-bottom fw-bold fs-5">Registration</a>
                    <a href="#" onclick="event.preventDefault(); try { document.getElementById('logout-form').submit(); } catch(e) { console.error('Logout error:', e); window.location.href='<?php echo e(route('logout')); ?>'; }" class="nav-link text-dark fs-5 mt-3">Logout</a>
                </nav>
            </div>
        </div>

        
        <div class="col-md-10 p-5" style="background: linear-gradient(180deg, #C32A25 0%, #ffffff 100%);">
            
            
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
            <div class="mb-5 animate-fade-in">
                <h2 class="text-white fw-bold display-6"><?php echo e($greeting); ?>, <?php echo e(Auth::user()->name); ?> 👋</h2>
                <p class="text-white-50 fs-5">Welcome back to your dashboard overview.</p>
            </div>

            
            <?php if(isset($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error:</strong> <?php echo e($error); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>

            
            <div class="d-flex justify-content-between mb-4 animate-fade-in">
                <?php if(Route::has('admin.register')): ?>
                <a href="<?php echo e(route('admin.register')); ?>" class="btn rounded-pill px-4 shadow-sm fw-bold d-flex align-items-center text-white" style="background: #C32A25;">
                    <i class="bi bi-plus-lg me-2"></i> New Registration
                </a>
                <?php else: ?>
                <button class="btn rounded-pill px-4 shadow-sm fw-bold d-flex align-items-center text-white" style="background: #C32A25;" disabled>
                    <i class="bi bi-plus-lg me-2"></i> New Registration (Not Available)
                </button>
                <?php endif; ?>
                <form action="<?php echo e(route('admin.dashboard')); ?>" method="GET" class="bg-white rounded-pill px-3 py-2 d-flex align-items-center shadow-sm" style="width: 400px;">
                    <i class="bi bi-search me-2"></i>
                    <input type="text" name="search" class="form-control border-0 shadow-none" placeholder="Search Registration" value="<?php echo e(request('search')); ?>">
                </form>
            </div>

            <div class="row g-4">
                <?php $__empty_1 = true; $__currentLoopData = $registrations ?? collect(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $reg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-6 animate-fade-in" style="animation-delay: <?php echo e($index * 0.1); ?>s">
                    
                    <div class="card border-0 shadow-sm rounded-4 h-100 hover-card" style="min-height: 250px; cursor: pointer;" onclick="<?php if(Route::has('admin.history')): ?> window.location.href='<?php echo e(route('admin.history', $reg->id ?? 0)); ?>'; <?php else: ?> alert('History page not available'); <?php endif; ?>">
                        <div class="card-body p-4 position-relative d-flex flex-column">
                            <h5 class="card-title text-center fw-bold mb-4">Registration #<?php echo e($reg->id ?? 'N/A'); ?></h5>

                            <div class="d-flex flex-column gap-2 mb-4">
                                <span class="text-secondary fw-bold text-dark"><?php echo e($reg->athlete_name ?? 'N/A'); ?></span>
                                <span class="text-secondary">Meet: <?php echo e($reg->meet_name ?? 'N/A'); ?></span>
                                <span class="text-secondary">Event: <?php echo e($reg->event_name ?? 'N/A'); ?></span>
                                <span class="text-secondary small">Status:
                                    <?php
                                        $statusClass = match($reg->status ?? '') {
                                            'Paid' => 'bg-success',
                                            'Rejected' => 'bg-danger',
                                            default => 'bg-warning'
                                        };
                                    ?>
                                    <span class="badge <?php echo e($statusClass); ?>"><?php echo e($reg->status ?? 'N/A'); ?></span>
                                </span>
                            </div>

                                <div class="mt-auto text-center d-flex justify-content-center gap-2">
                                    <?php
                                        $combinedName = ($reg->meet_name ?? '') . ' ' . ($reg->event_name ?? '');
                                        $hasCert = isset($validEvents) ? (in_array($reg->event_name ?? '', $validEvents) || in_array($combinedName, $validEvents)) : false;
                                    ?>

                                    <?php if(($reg->status ?? '') === 'Paid'): ?>
                                        
                                        <?php if($hasCert): ?>
                                            <button class="btn text-white fw-bold px-4 py-2 rounded-3 shadow-sm w-100" style="background: linear-gradient(180deg, #A93333 0%, #8B1A1A 100%);" onclick="event.stopPropagation(); <?php if(Route::has('certificate.show.registration')): ?> window.open('<?php echo e(route('certificate.show.registration', $reg->id ?? 0)); ?>', '_blank'); <?php else: ?> alert('Certificate view not available'); <?php endif; ?>">
                                                <i class="bi bi-file-earmark-text me-2"></i> View Certificate
                                            </button>
                                        <?php else: ?>
                                            <button class="btn btn-light text-muted fw-bold px-4 py-2 rounded-3 shadow-sm w-100" disabled>
                                                <i class="bi bi-clock me-2"></i> No Certificate
                                            </button>
                                        <?php endif; ?>
                                    <?php elseif(($reg->status ?? '') === 'Rejected'): ?>
                                        
                                        <button class="btn btn-light text-danger fw-bold px-4 py-2 rounded-3 shadow-sm w-100" disabled style="background-color: #f8d7da; border: 1px solid #f5c6cb;">
                                            <i class="bi bi-x-circle me-2"></i> Rejected
                                        </button>
                                    <?php else: ?>
                                        
                                        <button class="btn btn-light text-warning fw-bold px-4 py-2 rounded-3 shadow-sm w-100" disabled style="background-color: #fff3cd; border: 1px solid #ffeeba;">
                                            <i class="bi bi-hourglass-split me-2"></i> Waiting Validation
                                        </button>
                                    <?php endif; ?>
                                </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center py-5">
                    <p class="text-white fs-5">No registrations found.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\.gemini\antigravity\scratch\BDT-K1-Swiming-System\resources\views/dashboard/admin/indexdsbadmin.blade.php ENDPATH**/ ?>