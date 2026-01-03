

<?php $__env->startSection('title', 'Upload Certificate'); ?>

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

    .upload-area {
        border: 2px dashed #dee2e6;
        transition: all 0.3s ease;
    }

    .upload-area:hover {
        border-color: #A93333;
        background-color: #f8f9fa;
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
                    <a href="<?php echo e(route('operator.dashboard')); ?>" class="nav-link text-dark fs-5">Result</a>
                    <a href="<?php echo e(route('operator.athletes.index')); ?>" class="nav-link text-dark fs-5">Athletes</a>
                    <a href="<?php echo e(route('operator.certificate.index')); ?>" class="nav-link text-dark fs-5 fw-bold border-bottom border-dark pb-1">Certificate</a>
                    <a href="#" onclick="event.preventDefault(); try { document.getElementById('logout-form').submit(); } catch(e) { console.error('Logout error:', e); window.location.href='<?php echo e(route('logout')); ?>'; }" class="nav-link text-dark fs-5 mt-4">Logout</a>
                </nav>
            </div>
        </div>

        
        
        <div class="col-md-10 offset-md-2 p-5" style="background: linear-gradient(180deg, #EBC0C0 0%, #E6D2D2 100%); min-height: calc(100vh - 70px);">
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Upload Certificate Background</h5>

                            <?php if(session('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php echo e(session('success')); ?>

                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                            
                            <?php if(session('error')): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo e(session('error')); ?>

                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <form action="<?php echo e(route('operator.certificate.store')); ?>" method="POST" enctype="multipart/form-data" id="certForm">
                                <?php echo csrf_field(); ?>
                                
                                
                                <div class="mb-3">
                                    <label for="event_name" class="form-label">Event Name</label>
                                    <input class="form-control" list="eventOptions" id="event_name" name="event_name" placeholder="Type to search..." required autocomplete="off">
                                    <datalist id="eventOptions">
                                        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($event); ?>">
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </datalist>
                                    <div class="form-text">Choose the event this certificate is for. Use "Meet Name + Event Name" for accuracy.</div>
                                </div>

                                
                                <div class="mb-3">
                                    <label for="serial_number_format" class="form-label">Serial Number Format</label>
                                    <input type="text" class="form-control" id="serial_number_format" name="serial_number_format" placeholder="e.g. [No]/SP/[Event]/[Month]/[Year]" required>
                                    <div class="form-text">
                                        Use <code>[No]</code> for <b>Auto-Increment Number</b> (e.g. 001, 002). <br>
                                        Other placeholders: <code>[Event]</code>, <code>[Date]</code>, <code>[Year]</code>. <br>
                                        Example input: <code>[No]/SP/SWIMMING/[Year]</code> &rarr; Result: <code>001/SP/SWIMMING/2026</code>
                                    </div>
                                </div>

                                
                                <div class="mb-3">
                                    <label for="certificate_bg" class="form-label">Certificate Background Image</label>
                                    <input type="file" class="form-control" id="certificate_bg" name="certificate_bg" accept="image/*" required onchange="previewImage(event)">
                                    <div class="form-text">Upload a clean background image (JPG/PNG).</div>
                                </div>

                                
                                <div id="layoutEditor" style="display: none;" class="mt-4">
                                    <h6 class="fw-bold text-primary mb-2">Layout Editor</h6>
                                    <p class="small text-muted">Drag the elements below to position them on the certificate.</p>
                                    
                                    
                                    <div class="position-relative border shadow-sm mx-auto" id="editorContainer" style="width: 100%; max-width: 1000px; overflow: hidden; background: #eee;">
                                        
                                        <img id="previewImg" src="#" alt="Background Preview" style="width: 100%; display: block;" onload="initDraggables()">
                                        
                                        
                                        <div class="draggable-el" id="el-number" data-key="cert_number" style="top: 20%; left: 10%;">NO. SERTIFIKAT</div>
                                        <div class="draggable-el" id="el-name" data-key="athlete_name" style="top: 40%; left: 50%; transform: translateX(-50%); white-space: nowrap;">NAMA ATLET</div>
                                        <div class="draggable-el" id="el-rank" data-key="role_info" style="top: 50%; left: 50%; transform: translateX(-50%); white-space: nowrap;">JUARA / POSISI</div>
                                        <div class="draggable-el" id="el-event" data-key="event_info" style="top: 60%; left: 50%; transform: translateX(-50%); white-space: nowrap;">NAMA EVENT</div>
                                        <div class="draggable-el" id="el-qr" data-key="qr_code" style="top: 80%; left: 10%; width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,0.8);">QR CODE</div>
                                    </div>
                                </div>

                                
                                <input type="hidden" name="layout" id="layoutData">

                                <button type="submit" class="btn btn-primary mt-4 w-100 fw-bold" onclick="saveLayout()">
                                    <i class="bi bi-cloud-upload me-2"></i> Save Certificate & Layout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="row mt-5">
                <div class="col-12">
                    <h5 class="fw-bold mb-3">Recent Uploads</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle bg-white rounded shadow-sm">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">Event Name</th>
                                    <th>Preview</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $currentCertificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="ps-4 fw-bold"><?php echo e($cert->event_name); ?></td>
                                    <td>
                                        <img src="<?php echo e(asset($cert->image_path)); ?>" alt="Bg" class="rounded shadow-sm" style="height: 50px; object-fit: cover;">
                                    </td>
                                    <td class="small text-muted"><?php echo e($cert->updated_at->format('d M Y')); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3" class="text-center text-muted p-4">No certificates uploaded yet.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .draggable-el {
        position: absolute;
        background: rgba(255, 255, 0, 0.4);
        border: 2px dashed red;
        font-weight: bold;
        color: black;
        padding: 5px 10px;
        cursor: move;
        font-family: Arial, sans-serif;
        font-size: 14px;
        user-select: none;
        z-index: 10;
    }
    .draggable-el:hover {
        background: rgba(255, 255, 0, 0.7);
        border-color: blue;
    }
</style>

<script>
    let draggedEl = null;
    let container = null;

    function previewImage(event) {
        const reader = new FileReader();
        const file = event.target.files[0];
        
        reader.onload = function(){
            const output = document.getElementById('previewImg');
            output.src = reader.result;
            document.getElementById('layoutEditor').style.display = 'block';
        };
        
        if (file) {
            reader.readAsDataURL(file);
        }
    }

    function initDraggables() {
        container = document.getElementById('editorContainer');
        const draggables = document.querySelectorAll('.draggable-el');
        
        draggables.forEach(el => {
            el.onmousedown = dragMouseDown;
        });
    }

    function dragMouseDown(e) {
        e = e || window.event;
        e.preventDefault();
        draggedEl = e.target;
        
        // Get mouse position at startup
        document.onmouseup = closeDragElement;
        document.onmousemove = elementDrag;
    }

    function elementDrag(e) {
        e = e || window.event;
        e.preventDefault();
        
        if (!draggedEl || !container) return;

        // Calculate new position relative to container
        const rect = container.getBoundingClientRect();
        let x = e.clientX - rect.left - (draggedEl.offsetWidth / 2);
        let y = e.clientY - rect.top - (draggedEl.offsetHeight / 2);

        // Use percentages for responsiveness
        let leftPercent = (x / rect.width) * 100;
        let topPercent = (y / rect.height) * 100;

        draggedEl.style.left = leftPercent + "%";
        draggedEl.style.top = topPercent + "%";
        draggedEl.style.transform = "none"; // Remove initial centering transform once moved
    }

    function closeDragElement() {
        document.onmouseup = null;
        document.onmousemove = null;
        draggedEl = null;
    }

    function saveLayout() {
        const layout = {};
        const draggables = document.querySelectorAll('.draggable-el');
        
        draggables.forEach(el => {
            layout[el.dataset.key] = {
                top: el.style.top,
                left: el.style.left,
            };
        });
        
        document.getElementById('layoutData').value = JSON.stringify(layout);
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\.gemini\antigravity\scratch\BDT-K1-Swiming-System\resources\views/dashboard/operator/certificate/upload.blade.php ENDPATH**/ ?>