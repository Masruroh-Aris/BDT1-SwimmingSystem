

<?php $__env->startSection('title', 'Manage Registrations'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .page-title {
            color: #C32A25;
            font-weight: 700;
        }

        .table-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
            padding: 20px;
            border: none;
        }

        .table thead th {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6c757d;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 15px;
        }

        .table tbody td {
            vertical-align: middle;
            font-size: 0.85rem;
            padding: 15px 10px;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-verified, .status-paid {
            background-color: #d4edda;
            color: #155724;
        }

        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }

        .btn-action {
            border-radius: 8px;
            padding: 5px 12px;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-verify {
            background-color: #28a745;
            color: white;
            border: none;
        }

        .btn-verify:hover {
            background-color: #218838;
            color: white;
        }

        .btn-reject {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        .btn-reject:hover {
            background-color: #c82333;
            color: white;
        }

        .table-responsive-scroll {
            max-height: 65vh;
            overflow-y: auto;
            border-radius: 15px;
        }

        .table-responsive-scroll thead th {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 10;
            box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.1);
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid p-0">
        <div class="row g-0" style="min-height: calc(100vh - 70px);">

            
            <div class="col-md-2 bg-white border-end py-4 d-flex flex-column align-items-center position-fixed h-100"
                style="top: 70px; z-index: 100;">

                
                <div class="text-center mb-5 mt-3">
                    <i class="bi bi-person-circle display-1"></i>
                    <h4 class="fw-bold mt-3">Superadmin</h4>
                    <a href="<?php echo e(route('superadmin.profile.edit')); ?>" class="text-info text-decoration-none small">Edit Profile</a>
                </div>

                
                <div class="w-100 px-3">
                    <nav class="nav flex-column gap-1">
                        <a href="<?php echo e(route('superadmin.dashboard')); ?>" class="nav-link text-dark fs-6">Meet</a>
                        <a href="<?php echo e(route('superadmin.manage-meet')); ?>" class="nav-link text-dark fs-6">Manage Meet</a>
                        <a href="<?php echo e(route('superadmin.manage-event')); ?>" class="nav-link text-dark fs-6">Manage Event</a>
                        <a href="<?php echo e(route('superadmin.manage.regist')); ?>" class="nav-link text-dark fs-6 fw-bold">Manage Registration</a>
                        <a href="#" class="nav-link text-dark fs-6 mt-4" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </nav>
                </div>
            </div>

            
            <div class="col-md-10 offset-md-2 p-5" style="background: linear-gradient(180deg, #C32A25 0%, #ffffff 100%);">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-white fw-bold m-0">Manage Registrations</h3>

                    <!-- Compact Search Bar -->
                    <form action="<?php echo e(route('superadmin.manage.regist')); ?>" method="GET" class="bg-white rounded-pill p-1 ps-3 d-flex align-items-center shadow-sm" style="width: 300px;">
                        <i class="bi bi-search text-muted"></i>
                        <input type="text" name="search" class="form-control border-0 bg-transparent shadow-none" placeholder="Search..."
                            style="font-size: 0.95rem;" value="<?php echo e(request('search')); ?>">
                    </form>
                </div>

                
                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="card table-card border-0 mb-4" style="overflow: hidden;">
                    <div class="table-responsive table-responsive-scroll">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Athlete</th>
                                    <th scope="col">Event</th>
                                    <th scope="col">Meet</th>
                                    <th scope="col">Proof</th>
                                    <th scope="col">Fee</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" style="min-width: 200px;">Note (Reject)</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $registrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="fw-bold text-secondary">#<?php echo e($reg->id); ?></td>
                                        <td>
                                            <div class="fw-semibold"><?php echo e($reg->athlete_name); ?></div>
                                            <small class="text-muted">By: <?php echo e($reg->input_by ?? 'Unknown'); ?></small>
                                        </td>
                                        <td><?php echo e($reg->event_name); ?></td>
                                        <td><?php echo e($reg->meet_name); ?></td>
                                        <td>
                                            <?php if($reg->proof_image): ?>
                                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                                    data-bs-toggle="modal" data-bs-target="#proofModal"
                                                    onclick="showProof('<?php echo e(asset('storage/' . $reg->proof_image)); ?>', '<?php echo e($reg->athlete_name); ?>')">
                                                    <i class="bi bi-eye-fill"></i> 
                                                    <?php echo e(str_contains($reg->payment_method, 'Bank') ? 'Proof of Transfer' : 'Proof of Payment'); ?>

                                                </button>
                                            <?php else: ?>
                                                <span class="text-muted small">No Proof</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="fw-bold">Rp <?php echo e(number_format($reg->fee, 0, ',', '.')); ?></td>
                                        <td>
                                            <span class="status-badge status-<?php echo e(strtolower($reg->status)); ?>">
                                                <?php echo e($reg->status === 'Pending' ? 'Waiting Validation' : $reg->status); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <?php if($reg->status === 'Rejected'): ?>
                                                <span class="text-danger small"><i class="bi bi-exclamation-circle me-1"></i>
                                                    <?php echo e($reg->reject_note); ?></span>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if($reg->status !== 'Paid' && $reg->status !== 'Rejected'): ?>
                                                <div class="d-flex justify-content-center gap-2">
                                                    
                                                    <form action="<?php echo e(route('superadmin.manage.regist.status')); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="id" value="<?php echo e($reg->id); ?>">
                                                        <input type="hidden" name="status" value="Paid">
                                                        <button type="submit" class="btn btn-action btn-verify" title="Verify">
                                                            Verify
                                                        </button>
                                                    </form>

                                                    
                                                    <button type="button" class="btn btn-action btn-reject" 
                                                        data-bs-toggle="modal" data-bs-target="#rejectModal<?php echo e($reg->id); ?>" title="Reject">
                                                        Reject
                                                    </button>
                                                </div>

                                                
                                                <div class="modal fade" id="rejectModal<?php echo e($reg->id); ?>" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Reject Registration #<?php echo e($reg->id); ?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="<?php echo e(route('superadmin.manage.regist.status')); ?>" method="POST">
                                                                <?php echo csrf_field(); ?>
                                                                <div class="modal-body text-start">
                                                                    <input type="hidden" name="id" value="<?php echo e($reg->id); ?>">
                                                                    <input type="hidden" name="status" value="Rejected">
                                                                    <div class="mb-3">
                                                                        <label for="note" class="form-label">Reason for Rejection (Optional)</label>
                                                                        <textarea class="form-control" name="reject_note" rows="3" placeholder="e.g. Invalid proof of payment"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-danger">Confirm Reject</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <span class="text-muted small fst-italic">Completed</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="9" class="text-center py-5 text-muted">No registrations found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Proof Modal -->
    <div class="modal fade" id="proofModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Proof of Payment - <span id="proofAthleteName"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-0">
                    <img id="proofImage" src="" alt="Proof of Payment" class="img-fluid w-100">
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script>
            function showProof(imageUrl, athleteName) {
                document.getElementById('proofImage').src = imageUrl;
                document.getElementById('proofAthleteName').textContent = athleteName;
            }
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\.gemini\antigravity\scratch\BDT-K1-Swiming-System\resources\views/dashboard/superadmin/actions/manage-regist.blade.php ENDPATH**/ ?>