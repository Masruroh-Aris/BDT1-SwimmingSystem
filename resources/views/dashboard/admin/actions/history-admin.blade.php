@extends('layouts.app')

@section('title', 'Registration Detail')

@push('styles')
    <style>
        /* Custom styling for compact detail view */
        .detail-card {
            max-width: 500px;
            /* Reduced width */
            width: 100%;
            margin: 0 auto;
        }

        .detail-label {
            color: #6c757d;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0px;
        }

        .detail-value {
            color: #212529;
            font-weight: 600;
            font-size: 0.9rem;
            line-height: 1.2;
        }

        .detail-section-title {
            font-size: 0.8rem;
            font-weight: 700;
            color: #C32A25;
            margin-bottom: 0.2rem;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 0.1rem;
            margin-top: 0.4rem;
            /* Remove margin-top for the first title */
        }

        .detail-section-title:first-child {
            margin-top: 0;
        }
    </style>
@endpush

@php
    // Format Currency Helper (using native number_format to avoid extensions)
    $formattedFee = 'Rp ' . number_format($registration->fee, 0, ',', '.');
@endphp

@section('content')
    <div class="container-fluid p-0">
        <div class="row g-0" style="height: calc(100vh - 80px);">

            {{-- Left Side: Image Placeholder --}}
            <div class="col-md-6 bg-light d-flex align-items-center justify-content-center position-relative overflow-hidden" style="height: 100vh;">
                <img src="{{ asset('images/Admin/regis-admin.jpg') }}" alt="Register Admin" class="img-fluid w-100 h-100" style="object-fit: cover;">
            </div>

            {{-- Right Side: Content --}}
            {{-- Changed justify-content-center to justify-content-start to align top, added pt-5 for spacing --}}
            <div class="col-md-6 d-flex flex-column justify-content-start align-items-center pt-5"
                style="background: linear-gradient(180deg, #cc4e4a 0%, #ffffff 100%); overflow-y: auto;">

                <div class="card border-0 shadow-lg rounded-4 p-3 detail-card mb-3">
                    <div class="card-body p-1">
                        <h5 class="card-title text-center fw-bold mb-3" style="font-size: 1.1rem;">History Registration</h5>

                        <div class="row g-2">
                            {{-- Section 1: Registration Info --}}
                            <div class="col-12 mt-0">
                                <div class="detail-section-title mt-0">Registration Info</div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-label">ID Registration</div>
                                <div class="detail-value">REG-{{ str_pad($registration->id, 5, '0', STR_PAD_LEFT) }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-label">Date</div>
                                <div class="detail-value">{{ $registration->created_at->format('Y-m-d') }}</div>
                            </div>
                            {{-- Merged Athlete and Status into this section to save header space --}}
                            <div class="col-md-6">
                                <div class="detail-label mt-1">Athlete</div>
                                <div class="detail-value text-truncate">{{ $registration->athlete_name }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-label mt-1">Status</div>
                                <div
                                    class="detail-value {{ $registration->status == 'Paid' ? 'text-success' : ($registration->status == 'Rejected' ? 'text-danger' : 'text-warning') }}">
                                    {{ $registration->status }}
                                </div>
                            </div>

                            {{-- Section 2: Event Infos --}}
                            <div class="col-12">
                                <div class="detail-section-title">Event Infos</div>
                            </div>
                            <div class="col-md-12"> {{-- Full width for Meet name usually long --}}
                                <div class="detail-label">Meet</div>
                                <div class="detail-value text-truncate" title="{{ $registration->meet_name }}">
                                    {{ $registration->meet_name }}</div>
                            </div>
                            <div class="col-md-12">
                                <div class="detail-label mt-1">Event</div>
                                <div class="detail-value">{{ $registration->event_name }}</div>
                            </div>

                            {{-- Section 3: Payment --}}
                            <div class="col-12">
                                <div class="detail-section-title">Payment</div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-label">Nominal</div>
                                <div class="detail-value">{{ $formattedFee }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-label">Payment Method</div>
                                <div class="detail-value">{{ $registration->payment_method ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button type="button" class="btn text-white w-50 fw-bold py-1 rounded-3 shadow-sm"
                                style="background: linear-gradient(to right, #C32A25, #5D1412); font-size: 0.9rem;"
                                onclick="history.back()">Back</button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection