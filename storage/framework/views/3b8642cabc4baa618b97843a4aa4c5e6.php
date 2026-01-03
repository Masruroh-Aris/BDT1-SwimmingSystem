

<?php $__env->startSection('title', 'Athlete List'); ?>

<?php $__env->startSection('content'); ?>

    
    <section class="meet-section position-relative">
        <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['image' => 'images/AthletePage.jpg','line1' => 'The Champion','line2' => 'Swim Event','searchPlaceholder' => 'Search Athlete','searchAction' => ''.e(route('athletes.index')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['image' => 'images/AthletePage.jpg','line1' => 'The Champion','line2' => 'Swim Event','searchPlaceholder' => 'Search Athlete','searchAction' => ''.e(route('athletes.index')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal04f02f1e0f152287a127192de01fe241)): ?>
<?php $attributes = $__attributesOriginal04f02f1e0f152287a127192de01fe241; ?>
<?php unset($__attributesOriginal04f02f1e0f152287a127192de01fe241); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal04f02f1e0f152287a127192de01fe241)): ?>
<?php $component = $__componentOriginal04f02f1e0f152287a127192de01fe241; ?>
<?php unset($__componentOriginal04f02f1e0f152287a127192de01fe241); ?>
<?php endif; ?>
    </section>

    
    <section class="container my-5">
        <div class="athlete-list">
            <?php $__empty_1 = true; $__currentLoopData = $athletes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $athlete): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                
                
                <a href="<?php echo e(route('athlete.detail', ['id' => $athlete->id])); ?>" class="card-link-wrapper">
                    <div class="card athlete-card mb-4 border-0 shadow-sm">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="athlete-photo me-3 overflow-hidden">
                                    
                                    <?php if(isset($athlete->photo) && $athlete->photo): ?>
                                        <img src="<?php echo e($athlete->photo); ?>" alt="<?php echo e($athlete->name); ?>"
                                            class="w-100 h-100 object-fit-cover rounded-circle">
                                    <?php else: ?>
                                        <div class="bg-secondary-subtle rounded-circle d-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
                                            <i class="bi bi-person-fill fs-3 text-secondary"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="card-text">
                                    <h4 class="fw-bold mb-1 gudea-bold text-dark"><?php echo e($athlete->name); ?></h4>
                                    <div class="card-text2">
                                        
                                        <h5 class="mb-0 gudea-regular text-muted">
                                            <?php echo e($athlete->club->name ?? ($athlete->institution->name ?? '-')); ?>

                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <i class="bi <?php echo e(strtolower($athlete->gender) == 'male' ? 'bi-gender-male text-primary' : 'bi-gender-female text-danger'); ?> fs-4"></i>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="text-center py-5">
                    <p class="text-muted">No athletes found.</p>
                </div>
            <?php endif; ?>

            
            <div class="d-flex justify-content-center mt-4">
                <?php echo e($athletes->withQueryString()->links()); ?>

            </div>

        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\.gemini\antigravity\scratch\BDT-K1-Swiming-System\resources\views/public/athletes/index.blade.php ENDPATH**/ ?>