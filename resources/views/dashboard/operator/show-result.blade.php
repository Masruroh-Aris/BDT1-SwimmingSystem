@extends('layouts.app')

@section('title', 'Result Detail')

@section('content')
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
</style>

<div class="container-fluid p-0">
    <div class="row g-0" style="min-height: calc(100vh - 70px);">
        {{-- Sidebar --}}
        <div class="col-md-2 bg-white border-end py-4 d-flex flex-column align-items-center position-fixed h-100" style="top: 70px; z-index: 100;">
            
            {{-- Profile Section --}}
            <div class="text-center mb-5 mt-3">
                <i class="bi bi-person-circle display-1"></i>
                <h4 class="fw-bold mt-3">Oprator</h4>
                <a href="{{ route('operator.profile.edit') }}" class="text-info text-decoration-none small">Edit Profile</a>
            </div>

            {{-- Menu Items --}}
            <div class="w-100 px-3">
                <nav class="nav flex-column gap-3">
                    <a href="{{ route('operator.dashboard') }}" class="nav-link text-dark fs-5 fw-bold border-bottom border-dark pb-1">Result</a>
                    <a href="{{ route('operator.athletes.index') }}" class="nav-link text-dark fs-5">Athletes</a>
                    <a href="{{ route('operator.certificate.index') }}" class="nav-link text-dark fs-5">Certificate</a>
                    <a href="#" onclick="event.preventDefault(); try { document.getElementById('logout-form').submit(); } catch(e) { console.error('Logout error:', e); window.location.href='{{ route('logout') }}'; }" class="nav-link text-dark fs-5 mt-4">Logout</a>
                </nav>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="col-md-10 offset-md-2 p-5" style="background: linear-gradient(180deg, #EBC0C0 0%, #E6D2D2 100%); min-height: calc(100vh - 70px);">
            
            <div class="bg-white rounded-4 p-5 shadow-sm mx-auto animation-fade-in" style="max-width: 900px;">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h3 class="fw-bold m-0">Result Details</h3>
                    <a href="{{ route('operator.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-2"></i>Back
                    </a>
                </div>

                <div class="text-center mb-5">
                    <h2 class="fw-bold text-dark">{{ $result->athlete_name }}</h2>
                    <span class="badge bg-success px-3 py-2 rounded-pill mt-2">{{ $result->status }}</span>
                    
                    @if($result->medal)
                        <div class="mt-3">
                            <span class="badge {{ $result->medal == 'Gold' ? 'bg-warning text-dark' : ($result->medal == 'Silver' ? 'bg-secondary' : 'bg-warning text-dark') }} px-4 py-2 rounded-pill fs-5">
                                {{ $result->medal }} Medal 
                                @if($result->medal == 'Gold') 🥇
                                @elseif($result->medal == 'Silver') 🥈
                                @elseif($result->medal == 'Bronze') 🥉
                                @endif
                            </span>
                        </div>
                    @endif
                </div>

                <div class="row g-4">
                    {{-- Left Column --}}
                    <div class="col-md-6">
                        <div class="mb-4 border-bottom pb-3">
                            <label class="text-secondary small d-block mb-1">Event</label>
                            <div class="fw-bold fs-5">{{ $result->event_name }}</div>
                        </div>
                        <div class="mb-4 border-bottom pb-3">
                            <label class="text-secondary small d-block mb-1">Lane</label>
                            <div class="fw-bold fs-5">{{ $result->lane ?? '-' }}</div>
                        </div>
                        <div class="mb-4 border-bottom pb-3">
                            <label class="text-secondary small d-block mb-1">Meet Program</label>
                            <div class="fw-bold fs-5">{{ $result->meet_name }}</div>
                        </div>
                        <div class="mb-4 border-bottom pb-3">
                            <label class="text-secondary small d-block mb-1">Time Result</label>
                            <div class="fw-bold fs-5">{{ $result->time_result }}</div>
                        </div>
                         <div class="mb-4 border-bottom pb-3">
                            <label class="text-secondary small d-block mb-1">Points</label>
                            <div class="fw-bold fs-5">{{ $result->points ?? '-' }}</div>
                        </div>
                        <div class="mb-4 border-bottom pb-3">
                            <label class="text-secondary small d-block mb-1">Rank</label>
                            <div class="fw-bold fs-5 text-primary">#{{ $result->rank ?? 'Unranked' }}</div>
                        </div>
                    </div>

                    {{-- Right Column --}}
                    <div class="col-md-6">
                        <div class="mb-4 border-bottom pb-3">
                            <label class="text-secondary small d-block mb-1">Note</label>
                            <div class="fw-bold fs-5 fst-italic text-muted">{{ $result->note ?? '-' }}</div>
                        </div>
                         <div class="mb-4 border-bottom pb-3">
                            <label class="text-secondary small d-block mb-1">Input By</label>
                            <div class="fw-bold fs-5">{{ $result->input_by ?? '-' }}</div>
                        </div>
                        <div class="mb-4 border-bottom pb-3">
                            <label class="text-secondary small d-block mb-1">Last Updated</label>
                            <div class="fw-bold fs-5">{{ $result->updated_at->format('d M Y, H:i') }}</div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
