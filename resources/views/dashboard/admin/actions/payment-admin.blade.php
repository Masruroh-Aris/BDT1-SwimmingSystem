@extends('layouts.app')

@section('title', 'Payment Admin')

@push('styles')
<style>
    .nav-pills .nav-link {
        background-color: white;
        color: #C32A25;
        border: 1px solid #C32A25;
        transition: all 0.3s ease;
    }
    .nav-pills .nav-link.active {
        background-color: #C32A25 !important;
        color: white !important;
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-0">
    <div class="row g-0" style="height: calc(100vh - 80px); overflow: hidden;">
        
        {{-- Left Side: Image Placeholder --}}
        <div class="col-md-6 bg-light d-flex align-items-center justify-content-center p-0">
             <img src="{{ asset('images/Admin/regis-admin.jpg') }}" alt="Payment Admin" class="img-fluid w-100 h-100" style="object-fit: cover;">
        </div>

        {{-- Right Side: Content --}}
        <div class="col-md-6 d-flex justify-content-center pt-5 pb-5 h-100" style="background: linear-gradient(180deg, #cc4e4a 0%, #ffffff 100%); overflow-y: auto;">
            
            <div class="card border-0 shadow-lg rounded-4 p-4" style="width: 500px; max-width: 90%; height: fit-content;">
                <div class="card-body">
                    <h4 class="card-title text-center fw-bold mb-4">Payment Method</h4>

                    {{-- Method Selection --}}
                    <ul class="nav nav-pills nav-fill mb-4" id="paymentTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active fw-bold border" id="transfer-tab" data-bs-toggle="pill" data-bs-target="#transfer" type="button" role="tab" aria-selected="true">Transfer</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-bold border ms-2" id="qris-tab" data-bs-toggle="pill" data-bs-target="#qris" type="button" role="tab" aria-selected="false">QRIS</button>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="paymentTabContent">
                        {{-- Transfer Content --}}
                        <div class="tab-pane fade show active" id="transfer" role="tabpanel">
                            <div class="mb-3">
                                <label class="form-label text-secondary small">Select Bank</label>
                                <select class="form-select bg-light" id="bankSelect">
                                    <option selected disabled>Choose Bank</option>
                                    <option value="bca">BCA</option>
                                    <option value="bri">BRI</option>
                                    <option value="mandiri">Mandiri</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-secondary small">Account Number</label>
                                <input type="text" class="form-control bg-light" id="accountNumber" placeholder="Account Number will appear here" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-secondary small">Proof of Transfer</label>
                                <input type="file" class="form-control bg-light">
                            </div>
                        </div>

                        {{-- QRIS Content --}}
                        <div class="tab-pane fade" id="qris" role="tabpanel">
                            <div class="text-center mb-3">
                                <img src="{{ asset('images/Admin/qris.jpg') }}" alt="QRIS Code" class="img-fluid" style="max-width: 300px; border-radius: 10px;">
                                <p class="small text-muted mt-2">Scan this QR Code</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-secondary small">Proof of Payment</label>
                                <input type="file" class="form-control bg-light">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mt-4">
                        <a href="{{ route('admin.register') }}" class="btn btn-secondary w-50 fw-bold py-2 rounded-3">Back</a>
                        <button type="button" class="btn text-white w-50 fw-bold py-2 rounded-3" style="background: linear-gradient(to right, #C32A25, #5D1412);">Confirm Payment</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-populate Account Number
        const bankSelect = document.getElementById('bankSelect');
        const accountNumberInput = document.getElementById('accountNumber');
        
        const accountNumbers = {
            'bca': '123',
            'bri': '112',
            'mandiri': '134' 
        };

        if(bankSelect) {
            bankSelect.addEventListener('change', function() {
                const selectedBank = this.value;
                if(accountNumbers[selectedBank]) {
                    accountNumberInput.value = accountNumbers[selectedBank];
                } else {
                    accountNumberInput.value = '';
                }
            });
        }

        // Handle Confirm Payment Click
        const confirmBtn = document.querySelector('button.btn[style*="background: linear-gradient"]');
        if (confirmBtn) {
            confirmBtn.addEventListener('click', function() {
                // Determine Payment Method and File
                let paymentMethod = 'Unknown';
                let fileInput = null;

                const activeTabEl = document.querySelector('#paymentTab .nav-link.active');
                const activeTab = activeTabEl ? activeTabEl.id : '';
                
                if (activeTab === 'transfer-tab') {
                    const bankSelect = document.getElementById('bankSelect');
                    if (bankSelect && bankSelect.selectedIndex > 0) {
                        const selectedBank = bankSelect.options[bankSelect.selectedIndex].text;
                        paymentMethod = 'Bank Transfer (' + selectedBank + ')';
                    } else {
                        paymentMethod = 'Bank Transfer (Unselected)';
                    }
                    // Select file input in transfer tab
                    fileInput = document.querySelector('#transfer input[type="file"]');

                } else if (activeTab === 'qris-tab') {
                    paymentMethod = 'QRIS';
                    // Select file input in qris tab
                    fileInput = document.querySelector('#qris input[type="file"]');
                }

                // Check for file
                if (!fileInput || !fileInput.files[0]) {
                    Swal.fire({
                        title: 'Upload Proof',
                        text: 'Please upload the proof of payment/transfer.',
                        icon: 'warning',
                        confirmButtonColor: '#C32A25'
                    });
                    return;
                }

                // Prepare Upload
                const formData = new FormData();
                formData.append('proof_file', fileInput.files[0]);
                formData.append('_token', '{{ csrf_token() }}');

                // Show Loading
                Swal.fire({
                    title: 'Processing...',
                    text: 'Uploading proof of payment...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // AJAX Upload
                fetch('{{ route("admin.payment.upload") }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Payment Confirmed!',
                            text: 'Proof uploaded and payment recorded.',
                            icon: 'success',
                            confirmButtonColor: '#C32A25',
                            confirmButtonText: 'Back to Registration'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Get current params from URL
                                const currentParams = new URLSearchParams(window.location.search);
                                
                                // Add params
                                currentParams.set('payment_success', '1');
                                currentParams.set('payment_method', paymentMethod);
                                currentParams.set('proof_path', data.path); // Functionality: Pass path back
                                
                                // Build redirect URL
                                const redirectUrl = "{{ route('admin.register') }}" + "?" + currentParams.toString();
                                
                                window.location.href = redirectUrl;
                            }
                        });
                    } else {
                        throw new Error('Upload failed');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Failed to upload proof. Please try again.',
                        icon: 'error',
                        confirmButtonColor: '#C32A25'
                    });
                });
            });
        }
    });
</script>
@endpush
