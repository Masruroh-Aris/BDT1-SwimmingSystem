<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate - <?php echo e($data->athlete_name); ?></title>
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13z07paq/k0ge/75420rKn20XCI99wqmbP8hLQQQ+EzQQyG9bv47 Werg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        @page {
            size: landscape;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            font-family: 'Times New Roman', serif;
            -webkit-print-color-adjust: exact;
        }

        .certificate-container {
            position: relative;
            width: 1000px; /* Base width for scaling */
            height: 707px; /* Aspect ratio roughly A4 landscape */
            background-image: url('<?php echo e(asset($certificate->image_path)); ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 20px auto;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        /* Print Override */
        @media print {
            body {
                background-color: white;
            }

            .certificate-container {
                width: 100%;
                height: 100vh;
                margin: 0;
                box-shadow: none;
                page-break-after: always;
            }

            .no-print {
                display: none !important;
            }
        }

        /* Dynamic Text Overlays based on the provided Template */
        .overlay-text {
            position: absolute;
            text-align: center;
            width: 100%;
            /* text-transform: uppercase; */
        }

        /* REFINED POSITIONS FOR NEATNESS */
        
        /* 1. Certificate Number (Next to "NOMOR:") */
        .cert-number {
            top: 225px; /* Moved up significantly */
            left: 220px; /* Adjusted horizontal position */
            width: auto;
            text-align: left;
            font-size: 1.1rem;
            color: #1f4e78;
            font-weight: bold;
            font-family: 'Arial', sans-serif;
            letter-spacing: 1px;
        }
        
        /* 2. Athlete Name (On the Line) */
        .athlete-name {
            top: 365px; /* Moved up to sit on the line */
            left: 0;
            width: 100%; /* Spans full width for centering */
            text-align: center;
            font-size: 2.5rem;
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
        }

        /* 3. Role/Rank (Below "SEBAGAI") */
        .role-info {
            top: 485px; /* Adjusted relative to SEBAGAI label */
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 1.6rem;
            font-weight: bold;
            color: #333;
            text-transform: uppercase;
        }

        /* 4. Event Name (Below "Pada") */
        .event-info {
            top: 545px; /* Adjusted relative to Pada label */
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 1.3rem;
            color: #000;
            font-weight: bold;
        }

        /* QR Code Box */
        .qr-code-box {
            position: absolute;
            bottom: 60px;
            left: 60px;
            width: 80px;
            height: 80px;
            background: white; 
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Controls */
        .controls {
            position: fixed;
            bottom: 30px;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: center;
            z-index: 1000;
            pointer-events: none; /* Let clicks pass through outside the panel */
        }

        .control-panel {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 15px 25px;
            border-radius: 50px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            display: flex;
            gap: 15px;
            pointer-events: auto;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
            text-decoration: none;
            font-size: 1rem;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .btn-print {
            background: linear-gradient(135deg, #C32A25 0%, #8B1A1A 100%);
            color: white;
        }
        
        .btn-print:hover {
            background: linear-gradient(135deg, #D43B36 0%, #9C2B2B 100%);
            color: white; /* Ensure text remains white */
        }

        .btn-back {
            background-color: #f8f9fa;
            color: #495057;
            border: 1px solid #dee2e6;
        }
        
        .btn-back:hover {
            background-color: #e9ecef;
            color: #212529;
        }

        .bi {
            margin-right: 8px;
            font-size: 1.1em;
        }
    </style>
</head>

<body>

    <div class="certificate-container">
        
        <?php
            $layout = $certificate->layout ?? null;
        ?>

        <!-- 1. Certificate Number -->
        <div class="overlay-text cert-number" 
             style="<?php echo e($layout ? 'top: '.$layout['cert_number']['top'].'; left: '.$layout['cert_number']['left'].'; position: absolute;' : ''); ?>">
            <?php echo e(str_pad($data->id, 4, '0', STR_PAD_LEFT)); ?>/SERTIF/<?php echo e(date('Y')); ?>

        </div>

        <!-- 2. Athlete Name -->
        <div class="overlay-text athlete-name"
             style="<?php echo e($layout ? 'top: '.$layout['athlete_name']['top'].'; left: '.$layout['athlete_name']['left'].'; transform: none; text-align: center; width: auto; position: absolute;' : ''); ?>">
            <?php echo e($data->athlete_name); ?>

        </div>

        <!-- 3. Role / Rank (Under "SEBAGAI") -->
        <div class="overlay-text role-info"
             style="<?php echo e($layout ? 'top: '.$layout['role_info']['top'].'; left: '.$layout['role_info']['left'].'; transform: none; text-align: center; width: auto; position: absolute;' : ''); ?>">
            <?php if(isset($data->rank)): ?>
                JUARA <?php echo e($data->rank); ?>

            <?php else: ?>
                PARTICIPANT
            <?php endif; ?>
        </div>

        <!-- 4. Event Name (Under "Pada") -->
        <div class="overlay-text event-info"
             style="<?php echo e($layout ? 'top: '.$layout['event_info']['top'].'; left: '.$layout['event_info']['left'].'; transform: none; text-align: center; width: auto; position: absolute;' : ''); ?>">
             <?php echo e($data->event_name); ?>

        </div>

        <!-- 5. QR Code Area -->
        <div class="qr-code-box"
             style="<?php echo e($layout ? 'top: '.$layout['qr_code']['top'].'; left: '.$layout['qr_code']['left'].'; bottom: auto; position: absolute;' : ''); ?>">
             <!-- Using Public API for reliable image generation -->
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=<?php echo e(urlencode(route('certificate.show.registration', $data->id))); ?>" 
                 alt="QR Code" 
                 style="width: 100%; height: 100%;">
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <div class="controls no-print">
        <div class="control-panel">
            <a href="javascript:history.back()" class="btn btn-back">
                <i class="bi bi-arrow-left me-2"></i> Back
            </a>
            <button onclick="window.print()" class="btn btn-print">
                <i class="bi bi-printer-fill me-2"></i> Print Certificate
            </button>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\HP\.gemini\antigravity\scratch\BDT-K1-Swiming-System\resources\views/certificate/show.blade.php ENDPATH**/ ?>