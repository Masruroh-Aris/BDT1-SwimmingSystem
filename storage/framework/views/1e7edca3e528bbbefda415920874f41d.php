<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Swim Event'); ?></title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">


    
    <link href="https://fonts.googleapis.com/css2?family=Gudea:ital,wght@0,400;0,700;1,400&family=Rufina:wght@400;700&display=swap" rel="stylesheet">

    
    <link rel="stylesheet" href="<?php echo e(asset('css/global.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/public.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/login.css')); ?>">

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://unpkg.com/html5-qrcode" defer></script>

    <style>
      body {
        overflow-x: hidden;
        padding-top: 80px; /* Adjust for fixed navbar */
      }

      main {
        min-height: 100vh;
      }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

    
    <?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <main class="container-fluid p-0">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    
    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
        <?php echo csrf_field(); ?>
    </form>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\Users\HP\.gemini\antigravity\scratch\BDT-K1-Swiming-System\resources\views/layouts/app.blade.php ENDPATH**/ ?>