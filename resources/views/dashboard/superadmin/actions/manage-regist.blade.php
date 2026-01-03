@extends('layouts.app')

@section('title', 'Manage Registrations')

@push('styles')
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
@endpush

@section('content')
    <div class="container-fluid p-0">
        <div class="row g-0" style="min-height: calc(100vh - 70px);">

            {{-- Sidebar --}}
            <div class="col-md-2 bg-white border-end py-4 d-flex flex-column align-items-center position-fixed h-100"
                style="top: 70px; z-index: 100;">

                {{-- Profile Section --}}
                <div class="text-center mb-5 mt-3">
                    <i class="bi bi-person-circle display-1"></i>
                    <h4 class="fw-bold mt-3">Superadmin</h4>
                    <a href="{{ route('superadmin.profile.edit') }}" class="text-info text-decoration-none small">Edit Profile</a>
                </div>

                {{-- Menu Items --}}
                <div class="w-100 px-3">
                    <nav class="nav flex-column gap-1">
                        <a href="{{ route('superadmin.dashboard') }}" class="nav-link text-dark fs-6">Meet</a>
                        <a href="{{ route('superadmin.manage-meet') }}" class="nav-link text-dark fs-6">Manage Meet</a>
                        <a href="{{ route('superadmin.manage-event') }}" class="nav-link text-dark fs-6">Manage Event</a>
                        <a href="{{ route('superadmin.manage.regist') }}" class="nav-link text-dark fs-6 fw-bold">Manage Registration</a>
                        <a href="#" class="nav-link text-dark fs-6 mt-4" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </nav>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="col-md-10 offset-md-2 p-5" style="background: linear-gradient(180deg, #C32A25 0%, #ffffff 100%);">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-white fw-bold m-0">Manage Registrations</h3>

                    <!-- Compact Search Bar -->
                    <form action="{{ route('superadmin.manage.regist') }}" method="GET" class="bg-white rounded-pill p-1 ps-3 d-flex align-items-center shadow-sm" style="width: 300px;">
                        <i class="bi bi-search text-muted"></i>
                        <input type="text" name="search" class="form-control border-0 bg-transparent shadow-none" placeholder="Search..."
                            style="font-size: 0.95rem;" value="{{ request('search') }}">
                    </form>
                </div>

                {{-- Alert Messages --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

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
                                @forelse ($registrations as $reg)
                                    <tr>
                                        <td class="fw-bold text-secondary">#{{ $reg->id }}</td>
                                        <td>
                                            <div class="fw-semibold">{{ $reg->athlete_name }}</div>
                                            <small class="text-muted">By: {{ $reg->input_by ?? 'Unknown' }}</small>
                                        </td>
                                        <td>{{ $reg->event_name }}</td>
                                        <td>{{ $reg->meet_name }}</td>
                                        <td>
                                            @if($reg->proof_image)
                                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                                    data-bs-toggle="modal" data-bs-target="#proofModal"
                                                    onclick="showProof('{{ asset('storage/' . $reg->proof_image) }}', '{{ $reg->athlete_name }}')">
                                                    <i class="bi bi-eye-fill"></i> 
                                                    {{ str_contains($reg->payment_method, 'Bank') ? 'Proof of Transfer' : 'Proof of Payment' }}
                                                </button>
                                            @else
                                                <span class="text-muted small">No Proof</span>
                                            @endif
                                        </td>
                                        <td class="fw-bold">Rp {{ number_format($reg->fee, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="status-badge status-{{ strtolower($reg->status) }}">
                                                {{ $reg->status === 'Pending' ? 'Waiting Validation' : $reg->status }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($reg->status === 'Rejected')
                                                <span class="text-danger small"><i class="bi bi-exclamation-circle me-1"></i>
                                                    {{ $reg->reject_note }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($reg->status !== 'Paid' && $reg->status !== 'Rejected')
                                                <div class="d-flex justify-content-center gap-2">
                                                    {{-- Verify Form --}}
                                                    <form action="{{ route('superadmin.manage.regist.status') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $reg->id }}">
                                                        <input type="hidden" name="status" value="Paid">
                                                        <button type="submit" class="btn btn-action btn-verify" title="Verify">
                                                            Verify
                                                        </button>
                                                    </form>

                                                    {{-- Reject Button (Trigger Modal) --}}
                                                    <button type="button" class="btn btn-action btn-reject" 
                                                        data-bs-toggle="modal" data-bs-target="#rejectModal{{ $reg->id }}" title="Reject">
                                                        Reject
                                                    </button>
                                                </div>

                                                {{-- Reject Modal for this item --}}
                                                <div class="modal fade" id="rejectModal{{ $reg->id }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Reject Registration #{{ $reg->id }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('superadmin.manage.regist.status') }}" method="POST">
                                                                @csrf
                                                                <div class="modal-body text-start">
                                                                    <input type="hidden" name="id" value="{{ $reg->id }}">
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
                                            @else
                                                <span class="text-muted small fst-italic">Completed</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-5 text-muted">No registrations found.</td>
                                    </tr>
                                @endforelse
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

    @push('scripts')
        <script>
            function showProof(imageUrl, athleteName) {
                document.getElementById('proofImage').src = imageUrl;
                document.getElementById('proofAthleteName').textContent = athleteName;
            }
        </script>
    @endpush
@endsection