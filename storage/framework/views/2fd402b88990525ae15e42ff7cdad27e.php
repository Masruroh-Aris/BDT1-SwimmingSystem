

<?php $__env->startSection('title', 'Result Detail'); ?>

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
        
        <div class="col-md-2 bg-white border-end py-4 d-flex flex-column align-items-center position-fixed h-100" style="top: 70px; z-index: 100;">
            
            
            <div class="text-center mb-5 mt-3">
                <i class="bi bi-person-circle display-1"></i>
                <h4 class="fw-bold mt-3">Oprator</h4>
                <a href="<?php echo e(route('operator.profile.edit')); ?>" class="text-info text-decoration-none small">Edit Profile</a>
            </div>

            
            <div class="w-100 px-3">
                <nav class="nav flex-column gap-3">
                    <a href="<?php echo e(route('operator.dashboard')); ?>" class="nav-link text-dark fs-5 fw-bold border-bottom border-dark pb-1">Result</a>
                    <a href="<?php echo e(route('operator.athletes.index')); ?>" class="nav-link text-dark fs-5">Athletes</a>
                    <a href="<?php echo e(route('operator.certificate.index')); ?>" class="nav-link text-dark fs-5">Certificate</a>
                    <a href="#" onclick="event.preventDefault(); try { document.getElementById('logout-form').submit(); } catch(e) { console.error('Logout error:', e); window.location.href='<?php echo e(route('logout')); ?>'; }" class="nav-link text-dark fs-5 mt-4">Logout</a>
                </nav>
            </div>
        </div>

        
        <div class="col-md-10 offset-md-2 p-5" style="background: linear-gradient(180deg, #EBC0C0 0%, #E6D2D2 100%); min-height: calc(100vh - 70px);">
            
            <div class="bg-white rounded-4 p-5 shadow-sm mx-auto animation-fade-in" style="max-width: 900px;">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h3 class="fw-bold m-0">Result Details</h3>
                    <a href="<?php echo e(route('operator.dashboard')); ?>" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-2"></i>Back
                    </a>
                </div>

                <div class="text-center mb-5">
                    <h2 class="fw-bold text-dark"><?php echo e($result->athlete_name); ?></h2>
                    <span class="badge bg-success px-3 py-2 rounded-pill mt-2"><?php echo e($result->status); ?></span>
                    
                    <?php if($result->medal): ?>
                        <div class="mt-3">
                            <span class="badge <?php echo e($result->medal == 'Gold' ? 'bg-warning text-dark' : ($result->medal == 'Silver' ? 'bg-secondary' : 'bg-warning text-dark')); ?> px-4 py-2 rounded-pill fs-5">
                                <?php echo e($result->medal); ?> Medal 
                                <?php if($result->medal == 'Gold'): ?> 🥇
                                <?php elseif($result->medal == 'Silver'): ?> 🥈
                                <?php elseif($result->medal == 'Bronze'): ?> 🥉
                                <?php endif; ?>
                            </span>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <div class="mb-4 border-bottom pb-3">
                            <label class="text-secondary small d-block mb-1">Event</label>
                            <div class="fw-bold fs-5"><?php echo e($result->event_name); ?></div>
                        </div>
                        <div class="mb-4 border-bottom pb-3">
                            <label class="text-secondary small d-block mb-1">Lane</label>
                            <div class="fw-bold fs-5"><?php echo e($result->lane ?? '-'); ?></div>
                        </div>
                        <div class="mb-4 border-bottom pb-3">
                            <label class="text-secondary small d-block mb-1">Meet Program</label>
                            <div class="fw-bold fs-5"><?php echo e($result->meet_name); ?></div>
                        </div>
                        <div class="mb-4 border-bottom pb-3">
                            <label class="text-secondary small d-block mb-1">Time Result</label>
                            <div class="fw-bold fs-5"><?php echo e($result->time_result); ?></div>
                        </div>
                         <div class="mb-4 border-bottom pb-3">
                            <label class="text-secondary small d-block mb-1">Points</label>
                            <div class="fw-bold fs-5"><?php echo e($result->points ?? '-'); ?></div>
                        </div>
                        <div class="mb-4 border-bottom pb-3">
                            <label class="text-secondary small d-block mb-1">Rank</label>
                            <div class="fw-bold fs-5 text-primary">#<?php echo e($result->rank ?? 'Unranked'); ?></div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="mb-4 border-bottom pb-3">
                            <label class="text-secondary small d-block mb-1">Note</label>
                            <div class="fw-bold fs-5 fst-italic text-muted"><?php echo e($result->note ?? '-'); ?></div>
                        </div>
                         <div class="mb-4 border-bottom pb-3">
                            <label class="text-secondary small d-block mb-1">Input By</label>
                            <div class="fw-bold fs-5"><?php echo e($result->input_by ?? '-'); ?></div>
                        </div>
                        <div class="mb-4 border-bottom pb-3">
                            <label class="text-secondary small d-block mb-1">Last Updated</label>
                            <div class="fw-bold fs-5"><?php echo e($result->updated_at->format('d M Y, H:i')); ?></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\.gemini\antigravity\scratch\BDT-K1-Swiming-System\resources\views/dashboard/operator/show-result.blade.php ENDPATH**/ ?>