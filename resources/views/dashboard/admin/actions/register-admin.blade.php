@extends('layouts.app')

@section('title', 'New Registration')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Custom styling for Select2 to match Bootstrap 5 and the design */
        .select2-container--default .select2-selection--single {
            background-color: #f8f9fa;
            /* bg-light */
            border: 1px solid #dee2e6;
            /* default border */
            border-radius: 0.375rem;
            /* rounded-3 equivalent usually, or form-control radius */
            height: 38px;
            /* Standard Bootstrap input height */
            display: flex;
            align-items: center;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #212529;
            line-height: normal;
            padding-left: 0.75rem;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-left: 0.75rem;
            /* Match Bootstrap padding */
        }

        /* Fee Breakdown Styling */
        .fee-breakdown {
            background-color: #f8f9fa;
            border: 1px dashed #dee2e6;
            border-radius: 0.375rem;
        }

        .fee-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .fee-total-row {
            display: flex;
            justify-content: space-between;
            margin-top: 0.75rem;
            padding-top: 0.75rem;
            border-top: 1px solid #dee2e6;
            font-weight: bold;
            color: #212529;
            font-size: 1rem;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid p-0">
        <div class="row g-0" style="min-height: calc(100vh - 80px);">

            {{-- Left Side: Image Placeholder --}}
            <div class="col-md-6 bg-light d-flex align-items-center justify-content-center p-0"
                style="min-height: calc(100vh - 80px);">
                <img src="{{ asset('images/Admin/regis-admin.jpg') }}" alt="Register Admin" class="img-fluid w-100 h-100"
                    style="object-fit: cover;">
            </div>

            {{-- Right Side: Form --}}
            <div class="col-md-6 d-flex justify-content-center pt-5 pb-5"
                style="background: linear-gradient(180deg, #cc4e4a 0%, #ffffff 100%);">

                <div class="card border-0 shadow-lg rounded-4 p-4"
                    style="width: 500px; max-width: 90%; height: fit-content;">
                    <div class="card-body">
                        <h4 class="card-title text-center fw-bold mb-3">New Registration</h4>

                        <form action="{{ route('admin.register.store') }}" method="POST">
                            @csrf
                            {{-- Hidden Inputs --}}
                            @if(request('payment_success'))
                                <input type="hidden" name="payment_success" value="1">
                            @endif
                            @if(request('payment_method'))
                                <input type="hidden" name="payment_method" value="{{ request('payment_method') }}">
                            @endif
                            @if(request('proof_path'))
                                <input type="hidden" name="proof_image" value="{{ request('proof_path') }}">
                            @endif
                            {{-- Capture payment_success from URL if present --}}
                            
                            @if(request('proof_path'))
                                <div class="alert alert-success py-2 small mb-3">
                                    <i class="bi bi-check-circle-fill me-1"></i> Proof of Payment Attached
                                </div>
                            @endif
                            <div class="mb-2">
                                <label class="form-label text-secondary small">Select Athlete</label>
                                <select class="form-select bg-light select2-enable" name="athlete">
                                    <option></option>
                                    <option value="1">Athlete 1 - AT001</option>
                                    <option value="2">Samsul - AT002</option>
                                </select>
                            </div>

                            <div class="mb-2">
                                <label class="form-label text-secondary small">Select Meet</label>
                                <select class="form-select bg-light select2-enable" name="meet">
                                    <option></option>
                                    @foreach($meets as $meet)
                                        <option value="{{ $meet->id }}">{{ $meet->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-secondary small">Select Event</label>
                                <select class="form-select bg-light select2-enable" id="eventSelect" name="event">
                                    <option></option>
                                    @foreach($events as $event)
                                        <option value="{{ $event->id }}" data-price="{{ $event->fee }}">
                                            {{ $event->name }} (Rp {{ number_format($event->fee, 0, ',', '.') }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Fee Breakdown Section (Hidden by default) --}}
                            <div id="feeSection" class="fee-breakdown p-3 mb-3 d-none">
                                <div class="fee-row">
                                    <span>Event Fee</span>
                                    <span id="eventFee">Rp 0</span>
                                </div>
                                <div class="fee-row">
                                    <span>Registration Fee</span>
                                    <span id="regFee">Rp 20.000</span>
                                </div>
                                <div class="fee-total-row">
                                    <span>Total Payment</span>
                                    <span id="totalFee" class="text-danger">Rp 0</span>
                                </div>
                            </div>
                            
                            <div class="d-flex gap-3 mt-4">
                                @if(request('payment_success'))
                                    {{-- Show Detail Payment instead of Payment --}}
                                    <button type="button" class="btn text-white w-50 fw-bold py-2 rounded-3"
                                        style="background: linear-gradient(to right, #28a745, #218838);"
                                        onclick="goToDetailPayment()">Detail Payment</button>
                                @else
                                    <button type="button" class="btn text-white w-50 fw-bold py-2 rounded-3"
                                        style="background: linear-gradient(to right, #C32A25, #5D1412);"
                                        onclick="goToPayment()">Payment</button>
                                @endif
                                
                                <button type="submit" class="btn text-white w-50 fw-bold py-2 rounded-3"
                                    style="background: linear-gradient(to right, #C32A25, #5D1412);">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- jQuery (Required for Select2) --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    {{-- Select2 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function goToPayment() {
            // Get form values
            const athlete = $('select[name="athlete"]').val();
            const meet = $('select[name="meet"]').val();
            const event = $('select[name="event"]').val();
            
            // Build URL with params
            const url = new URL('{{ route('admin.payment') }}');
            if(athlete) url.searchParams.set('athlete', athlete);
            if(meet) url.searchParams.set('meet', meet);
            if(event) url.searchParams.set('event', event);
            
            window.location.href = url.toString();
        }

        function goToDetailPayment() {
            // Forward all current params to the detail page
            const currentParams = new URLSearchParams(window.location.search);
            const url = new URL('{{ route('admin.payment.detail') }}');
            
            // Append all existing params (athlete, meet, event, payment_method)
            currentParams.forEach((value, key) => {
                url.searchParams.set(key, value);
            });
            
            window.location.href = url.toString();
        }

        $(document).ready(function () {
            // Initialize Select2
            $('.select2-enable').select2({
                placeholder: "Select an option",
                allowClear: true,
                width: '100%'
            });

            // Pre-fill values from URL if available
            const urlParams = new URLSearchParams(window.location.search);
            if(urlParams.has('athlete')) {
                $('select[name="athlete"]').val(urlParams.get('athlete')).trigger('change');
            }
            if(urlParams.has('meet')) {
                $('select[name="meet"]').val(urlParams.get('meet')).trigger('change');
            }
            if(urlParams.has('event')) {
                $('select[name="event"]').val(urlParams.get('event')).trigger('change');
            }

            // Fixed Registration Fee
            const regFee = 20000;

            // Event Selection Logic
            $('#eventSelect').on('change', function () {
                var selectedOption = $(this).find(':selected');
                var price = selectedOption.data('price');

                if (price) {
                    // Parse price
                    price = parseInt(price);
                    var total = price + regFee;

                    // Format Currency
                    var formatter = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    });

                    // Update UI
                    $('#eventFee').text(formatter.format(price).replace('Rp', 'Rp '));
                    $('#totalFee').text(formatter.format(total).replace('Rp', 'Rp '));

                    // Show Section
                    $('#feeSection').removeClass('d-none');
                } else {
                    // Hide Section if cleared
                    $('#feeSection').addClass('d-none');
                }
            });

            // Submit Button Alert
            $('button[type="submit"]').on('click', function (e) {
                e.preventDefault();
                
                // Check if payment has been confirmed (hidden input exists)
                if ($('input[name="payment_success"]').length === 0) {
                    Swal.fire({
                        title: 'Pembayaran Diperlukan',
                        text: "Anda harus menyelesaikan pembayaran sebelum mengirim pendaftaran.",
                        icon: 'warning',
                        confirmButtonColor: '#C32A25',
                        confirmButtonText: 'Ke Halaman Pembayaran'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            goToPayment();
                        }
                    });
                    return;
                }

                Swal.fire({
                    title: 'Konfirmasi Pendaftaran',
                    text: "Apakah Anda yakin data yang dimasukkan sudah benar?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#C32A25',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Kirim!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form
                        $(this).closest('form').submit();
                    }
                });
            });
        });
    </script>
@endpush