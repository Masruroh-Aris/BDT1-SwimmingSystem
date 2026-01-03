@extends('layouts.app')

@section('title', 'Admin Dashboard')

@push('styles')
<style>
    .hover-card {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    .hover-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 10px 20px rgba(0,0,0,0.12) !important;
    }
    .animate-fade-in {
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
        transform: translateY(20px);
    }
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-0">
    <div class="row g-0" style="min-height: calc(100vh - 70px);">
        {{-- Sidebar --}}
        <div class="col-md-2 bg-white border-end py-4 d-flex flex-column align-items-center">

            {{-- Profile Section --}}
            <div class="text-center mb-5">
                <i class="bi bi-person-circle display-1"></i>
                <h4 class="fw-bold mt-2">Admin</h4>
                <a href="{{ route('admin.profile.edit') }}" class="text-info text-decoration-none small">Edit Profile</a>
            </div>

            {{-- Menu Items --}}
            <div class="w-100 px-3">
                <nav class="nav flex-column gap-3">
                    <a href="{{ route('admin.register') }}" class="nav-link text-dark border-bottom fw-bold fs-5">Registration</a>
                    <a href="#" onclick="event.preventDefault(); try { document.getElementById('logout-form').submit(); } catch(e) { console.error('Logout error:', e); window.location.href='{{ route('logout') }}'; }" class="nav-link text-dark fs-5 mt-3">Logout</a>
                </nav>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="col-md-10 p-5" style="background: linear-gradient(180deg, #C32A25 0%, #ffffff 100%);">
            
            {{-- Dynamic Greeting --}}
            @php
                use Carbon\Carbon;
                $currentDate = Carbon::now('Asia/Jakarta');
                $hour = $currentDate->hour;
                
                if ($hour < 12) {
                    $greeting = 'Good Morning';
                } elseif ($hour < 18) {
                    $greeting = 'Good Afternoon';
                } else {
                    $greeting = 'Good Evening';
                }
            @endphp
            <div class="mb-5 animate-fade-in">
                <h2 class="text-white fw-bold display-6">{{ $greeting }}, {{ Auth::user()->name }} 👋</h2>
                <p class="text-white-50 fs-5">Welcome back to your dashboard overview.</p>
            </div>

            {{-- Error Message --}}
            @if(isset($error))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error:</strong> {{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            {{-- Search Bar & New Registration --}}
            <div class="d-flex justify-content-between mb-4 animate-fade-in">
                @if(Route::has('admin.register'))
                <a href="{{ route('admin.register') }}" class="btn rounded-pill px-4 shadow-sm fw-bold d-flex align-items-center text-white" style="background: #C32A25;">
                    <i class="bi bi-plus-lg me-2"></i> New Registration
                </a>
                @else
                <button class="btn rounded-pill px-4 shadow-sm fw-bold d-flex align-items-center text-white" style="background: #C32A25;" disabled>
                    <i class="bi bi-plus-lg me-2"></i> New Registration (Not Available)
                </button>
                @endif
                <form action="{{ route('admin.dashboard') }}" method="GET" class="bg-white rounded-pill px-3 py-2 d-flex align-items-center shadow-sm" style="width: 400px;">
                    <i class="bi bi-search me-2"></i>
                    <input type="text" name="search" class="form-control border-0 shadow-none" placeholder="Search Registration" value="{{ request('search') }}">
                </form>
            </div>

            <div class="row g-4">
                @forelse ($registrations ?? collect() as $index => $reg)
                <div class="col-md-6 animate-fade-in" style="animation-delay: {{ $index * 0.1 }}s">
                    {{-- Card clicks to History Page --}}
                    <div class="card border-0 shadow-sm rounded-4 h-100 hover-card" style="min-height: 250px; cursor: pointer;" onclick="@if(Route::has('admin.history')) window.location.href='{{ route('admin.history', $reg->id ?? 0) }}'; @else alert('History page not available'); @endif">
                        <div class="card-body p-4 position-relative d-flex flex-column">
                            <h5 class="card-title text-center fw-bold mb-4">Registration #{{ $reg->id ?? 'N/A' }}</h5>

                            <div class="d-flex flex-column gap-2 mb-4">
                                <span class="text-secondary fw-bold text-dark">{{ $reg->athlete_name ?? 'N/A' }}</span>
                                <span class="text-secondary">Meet: {{ $reg->meet_name ?? 'N/A' }}</span>
                                <span class="text-secondary">Event: {{ $reg->event_name ?? 'N/A' }}</span>
                                <span class="text-secondary small">Status:
                                    @php
                                        $statusClass = match($reg->status ?? '') {
                                            'Paid' => 'bg-success',
                                            'Rejected' => 'bg-danger',
                                            default => 'bg-warning'
                                        };
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ $reg->status ?? 'N/A' }}</span>
                                </span>
                            </div>

                                <div class="mt-auto text-center d-flex justify-content-center gap-2">
                                    @php
                                        $combinedName = ($reg->meet_name ?? '') . ' ' . ($reg->event_name ?? '');
                                        $hasCert = isset($validEvents) ? (in_array($reg->event_name ?? '', $validEvents) || in_array($combinedName, $validEvents)) : false;
                                    @endphp

                                    @if(($reg->status ?? '') === 'Paid')
                                        {{-- Paid/Verified: Show Certificate Options --}}
                                        @if($hasCert)
                                            <button class="btn text-white fw-bold px-4 py-2 rounded-3 shadow-sm w-100" style="background: linear-gradient(180deg, #A93333 0%, #8B1A1A 100%);" onclick="event.stopPropagation(); @if(Route::has('certificate.show.registration')) window.open('{{ route('certificate.show.registration', $reg->id ?? 0) }}', '_blank'); @else alert('Certificate view not available'); @endif">
                                                <i class="bi bi-file-earmark-text me-2"></i> View Certificate
                                            </button>
                                        @else
                                            <button class="btn btn-light text-muted fw-bold px-4 py-2 rounded-3 shadow-sm w-100" disabled>
                                                <i class="bi bi-clock me-2"></i> No Certificate
                                            </button>
                                        @endif
                                    @elseif(($reg->status ?? '') === 'Rejected')
                                        {{-- Rejected: Show Error --}}
                                        <button class="btn btn-light text-danger fw-bold px-4 py-2 rounded-3 shadow-sm w-100" disabled style="background-color: #f8d7da; border: 1px solid #f5c6cb;">
                                            <i class="bi bi-x-circle me-2"></i> Rejected
                                        </button>
                                    @else
                                        {{-- Pending/Waiting: Show Status --}}
                                        <button class="btn btn-light text-warning fw-bold px-4 py-2 rounded-3 shadow-sm w-100" disabled style="background-color: #fff3cd; border: 1px solid #ffeeba;">
                                            <i class="bi bi-hourglass-split me-2"></i> Waiting Validation
                                        </button>
                                    @endif
                                </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <p class="text-white fs-5">No registrations found.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
