<section class="hero-section position-relative">
    <img 
    src="<?php echo e(asset($image)); ?>" 
    srcset="<?php echo e(asset($image)); ?> 1x, <?php echo e(asset(preg_replace('/(\.\w+)$/', '@2x$1', $image))); ?> 2x"
    alt="Hero Banner" 
    class="hero-bg">

    <div class="hero-overlay"></div>

    <div class="hero-content text-white">
        <div class="hero-title">
            <h1 class="fw-bold first-line"><?php echo e($line1); ?></h1>
            <h1 class="fw-bold second-line"><?php echo e($line2); ?></h1>
        </div>

        <?php if(isset($searchPlaceholder)): ?>
        <div class="search-box">
            <form action="<?php echo e($searchAction); ?>" method="GET" class="search-form">
                <i class="bi bi-search"></i>
                <input type="text" name="search" placeholder="<?php echo e($searchPlaceholder); ?>">
            </form>
        </div>
        <?php endif; ?>
    </div>
</section><?php /**PATH C:\Users\HP\.gemini\antigravity\scratch\BDT-K1-Swiming-System\resources\views/components/hero.blade.php ENDPATH**/ ?>