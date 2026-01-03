@extends('layouts.app')

@section('title', 'Operator Dashboard')

@section('content')
<style>
    .animation-fade-in {
        animation: fadeIn 0.8s ease-out forwards;
        opacity: 0;
        transform: translateY(20px);
    }

    @keyframes fadeIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hover-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
</style>

<div class="container-fluid p-0">
    <div class="row g-0" style="min-height: calc(100vh - 70px);">
        {{-- Sidebar --}}
        <div class="col-md-2 bg-white border-end py-4 d-flex flex-column align-items-center">
            
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
        <div class="col-md-10 p-5" style="background: linear-gradient(180deg, #EBC0C0 0%, #E6D2D2 100%); min-height: calc(100vh - 70px);">
            

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
            <div class="mb-5 animation-fade-in">
                <h2 class="fw-bold display-6" style="color: #A93333;">{{ $greeting }}, {{ Auth::user()->name }} 👋</h2>
                <p class="fs-5" style="color: #8B1A1A;">Welcome back to your dashboard overview.</p>
            </div>

            {{-- Header: Button + Search --}}
            <div class="d-flex justify-content-between align-items-center mb-5">
                <a href="{{ route('operator.input-result') }}" class="btn text-white fw-bold px-4 py-2 rounded-3 shadow-sm" style="background: linear-gradient(180deg, #A93333 0%, #8B1A1A 100%);">
                    <i class="bi bi-plus-lg me-2"></i>Input Result
                </a>

                <form action="{{ route('operator.dashboard') }}" method="GET" class="bg-white rounded-pill px-4 py-2 d-flex align-items-center shadow-sm" style="width: 400px;">
                    <i class="bi bi-search me-2 text-dark"></i>
                    <input type="text" name="search" class="form-control border-0 shadow-none" placeholder="Search Result" value="{{ request('search') }}">
                </form>
            </div>

            {{-- Cards Grid --}}
            <div class="row g-4">
                {{-- Real Data Loop --}}
                @forelse($results as $res)
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3 hover-card animation-fade-in" onclick="window.location='{{ route('operator.result.show', $res->id) }}'">
                        <div class="card-body">
                            <h5 class="fw-bold text-center mb-4">{{ $res->athlete_name }}</h5>
                            
                            <div class="row mb-2">
                                <div class="col-4 text-secondary small">Event</div>
                                <div class="col-1 text-center">:</div>
                                <div class="col-7 small">{{ $res->event_name }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4 text-secondary small">Rank / Medal</div>
                                <div class="col-1 text-center">:</div>
                                <div class="col-7 small">
                                    #{{ $res->rank ?? '-' }} 
                                    @if($res->medal == 'Gold') 🥇
                                    @elseif($res->medal == 'Silver') 🥈
                                    @elseif($res->medal == 'Bronze') 🥉
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4 text-secondary small">Time Result</div>
                                <div class="col-1 text-center">:</div>
                                <div class="col-7 small">{{ $res->time_result }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4 text-secondary small">Meet Program</div>
                                <div class="col-1 text-center">:</div>
                                <div class="col-7 small">{{ $res->meet_name }}</div>
                            </div>
                           
                            
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <h5 class="text-secondary">No results found</h5>
                </div>
                @endforelse

            </div>
        </div>
    </div>
</div>
@endsection
