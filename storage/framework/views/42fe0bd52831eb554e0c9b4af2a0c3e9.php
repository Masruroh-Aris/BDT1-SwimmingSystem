<nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm fixed-top">
    <div class="container">

        
        <a class="navbar-brand d-flex align-items-center" href="<?php echo e(route('meets.index')); ?>">
            <img src="<?php echo e(asset('images/prsi-logo.png')); ?>" alt="Logo PRSI" height="45" class="me-2">
                <div class="brand-text rufina-bold">
                    <span class="brand-swim">Swim</span>
                    <span class="brand-event">Event</span>
                </div>
        </a>

        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('meets.index') ? 'active text-danger border-bottom border-danger' : ''); ?>"
                       href="<?php echo e(route('meets.index')); ?>">Meet Program</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('athletes.index') ? 'active text-danger border-bottom border-danger' : ''); ?>"
                       href="<?php echo e(route('athletes.index')); ?>">Athlete</a>
                </li>
                <li class="nav-item">
                    <?php if(auth()->guard()->check()): ?>
                        <?php
                            $dashboardRoute = '#';
                            $rawRole = Auth::user()->role ?? '';
                            $role = strtolower(trim($rawRole));
                            
                            if($role === 'operator') $dashboardRoute = route('operator.dashboard');
                            elseif($role === 'admin') $dashboardRoute = route('admin.dashboard');
                            elseif($role === 'super_admin' || $role === 'superadmin') $dashboardRoute = route('superadmin.dashboard');
                        ?>
                        <a href="<?php echo e($dashboardRoute); ?>"
                            class="nav-link <?php echo e(request()->routeIs('*.dashboard')? 'active text-danger border-bottom border-danger' : ''); ?>">Dashboard
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>"
                            class="nav-link <?php echo e(request()->routeIs('login', 'login.*', 'password.*')? 'active text-danger border-bottom border-danger' : ''); ?>">Login
                        </a>
                    <?php endif; ?>
                </li>

            </ul>
        </div>
    </div>
</nav><?php /**PATH C:\Users\HP\.gemini\antigravity\scratch\BDT-K1-Swiming-System\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>