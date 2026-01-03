@extends('layouts.app')

@section('title', 'Manage Athletes')

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
                    <a href="{{ route('operator.dashboard') }}" class="nav-link text-dark fs-5">Result</a>
                    <a href="{{ route('operator.athletes.index') }}" class="nav-link text-dark fs-5 fw-bold border-bottom border-dark pb-1">Athletes</a>
                    <a href="{{ route('operator.certificate.index') }}" class="nav-link text-dark fs-5">Certificate</a>
                    <a href="#" onclick="event.preventDefault(); try { document.getElementById('logout-form').submit(); } catch(e) { console.error('Logout error:', e); window.location.href='{{ route('logout') }}'; }" class="nav-link text-dark fs-5 mt-4">Logout</a>
                </nav>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="col-md-10 p-5" style="background: linear-gradient(180deg, #EBC0C0 0%, #E6D2D2 100%); min-height: calc(100vh - 70px);">
            
            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Header: Button + Search --}}
            <div class="d-flex justify-content-between align-items-center mb-5">
                <a href="{{ route('operator.athletes.create') }}" class="btn text-white fw-bold px-4 py-2 rounded-3 shadow-sm" style="background: linear-gradient(180deg, #A93333 0%, #8B1A1A 100%);">
                    <i class="bi bi-plus-lg me-2"></i>Add Athlete
                </a>

                <form action="{{ route('operator.athletes.index') }}" method="GET" class="bg-white rounded-pill px-4 py-2 d-flex align-items-center shadow-sm" style="width: 400px;">
                    <i class="bi bi-search me-2 text-dark"></i>
                    <input type="text" name="search" class="form-control border-0 shadow-none" placeholder="Search Athlete" value="{{ request('search') }}">
                </form>
            </div>

            {{-- Cards Grid --}}
            <div class="row g-4">
                @forelse($athletes as $athlete)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3 hover-card animation-fade-in">
                        <div class="card-body">
                            <h5 class="fw-bold text-center mb-3">{{ $athlete->name }}</h5>
                            
                            <div class="row mb-2">
                                <div class="col-5 text-secondary small">Organization</div>
                                <div class="col-1 text-center">:</div>
                                <div class="col-6 small">
                                    @if($athlete->club)
                                        {{ $athlete->club->name }} (Club)
                                    @elseif($athlete->institution)
                                        {{ $athlete->institution->name }} ({{ ucfirst($athlete->institution->sub_role) }})
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-5 text-secondary small">Gender</div>
                                <div class="col-1 text-center">:</div>
                                <div class="col-6 small">{{ $athlete->gender }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-5 text-secondary small">Birth Date</div>
                                <div class="col-1 text-center">:</div>
                                <div class="col-6 small">{{ \Carbon\Carbon::parse($athlete->birth_date)->format('d M Y') }}</div>
                            </div>

                            <div class="d-flex justify-content-center gap-2 mt-4">
                                <a href="{{ route('operator.athletes.edit', $athlete->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="bi bi-pencil me-1"></i> Edit
                                </a>
                                <form action="{{ route('operator.athletes.destroy', $athlete->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this athlete?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                        <i class="bi bi-trash me-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <h5 class="text-secondary">No athletes found</h5>
                </div>
                @endforelse
            </div>
            
            <div class="mt-4">
                {{ $athletes->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
