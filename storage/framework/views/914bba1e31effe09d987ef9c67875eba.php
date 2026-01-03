

<?php $__env->startSection('title', 'Meet Program'); ?>

<?php $__env->startSection('content'); ?>

    
    <section class="meet-section position-relative">
        <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['image' => 'images/meet.jpg','line1' => 'Welcome to','line2' => 'Swim Event','searchPlaceholder' => 'Search Meet Program','searchAction' => ''.e(route('meets.index')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['image' => 'images/meet.jpg','line1' => 'Welcome to','line2' => 'Swim Event','searchPlaceholder' => 'Search Meet Program','searchAction' => ''.e(route('meets.index')).'']); ?>
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
        <div class="meet-list">
            <!-- Container for Dynamic Meets -->
            <div id="meet-list-container">
                <?php $__empty_1 = true; $__currentLoopData = $meets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e(route('meet.detail', $meet->id)); ?>" 
                       class="card-link-wrapper meet-item" 
                       style="text-decoration: none; animation: fadeInUp 0.8s ease-out <?php echo e($loop->index * 0.2); ?>s backwards;">
                        <div class="card meet-card mb-4 border-0 shadow-lg" style="background-color: #DA291C; color: white;"> 
                            <div class="card-body d-flex justify-content-between align-items-center text-white">
                                <div class="card-text">
                                    <h4 class="fw-bold mb-1 gudea-bold"><?php echo e($meet->name); ?></h4> 
                                    
                                    
                                    <h4 class="mb-0 gudea-regular" style="opacity: 0.9; font-size: 1rem;">
                                        <?php if($meet->events->isNotEmpty()): ?>
                                            <?php echo e($meet->events->pluck('name')->unique()->take(3)->implode(', ')); ?>

                                            <?php if($meet->events->unique('name')->count() > 3): ?>
                                                ...
                                            <?php endif; ?>
                                        <?php else: ?>
                                            No Events Listed
                                        <?php endif; ?>
                                    </h4> 
                                </div>
                                <div class="card-text2 gudea-regular text-end">
                                    <h5 class="mb-0 fw-bold"><?php echo e($meet->start_date ? $meet->start_date->format('d M Y') : 'Date TBA'); ?></h5>
                                    <h5 class="mb-0"><?php echo e($meet->venue); ?></h5>
                                    <h5 class="mb-0" style="font-style: italic;">Status: <?php echo e($meet->status); ?></h5> 
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="alert alert-light text-center" style="border: 2px solid #DA291C; color: #DA291C;">
                        <i class="fas fa-info-circle me-2"></i> Tidak ada acara renang yang ditemukan.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\.gemini\antigravity\scratch\BDT-K1-Swiming-System\resources\views/public/meets/index.blade.php ENDPATH**/ ?>