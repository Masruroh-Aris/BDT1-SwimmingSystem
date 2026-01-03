@extends('layouts.app')

@section('title', 'Add Athlete')

@section('content')
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
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-dark">Add New Athlete</h2>
                <a href="{{ route('operator.athletes.index') }}" class="btn btn-outline-dark rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Back
                </a>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4">
                <div class="card-body">
                    <form action="{{ route('operator.athletes.store') }}" method="POST">
                        @csrf
                        
                        <div class="row g-3">
                            {{-- Name --}}
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-bold">Athlete Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Gender --}}
                            <div class="col-md-6">
                                <label for="gender" class="form-label fw-bold">Gender</label>
                                <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Birth Date --}}
                            <div class="col-md-6">
                                <label for="birth_date" class="form-label fw-bold">Birth Date</label>
                                <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" required>
                                @error('birth_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Place of Birth --}}
                            <div class="col-md-6">
                                <label for="place_of_birth" class="form-label fw-bold">Place of Birth</label>
                                <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror" id="place_of_birth" name="place_of_birth" value="{{ old('place_of_birth') }}">
                                @error('place_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Organization (Admin - Club/School/University) --}}
                            <div class="col-md-12">
                                <label for="organization_id" class="form-label fw-bold">Organization (Admin - Club/School/University)</label>
                                <select class="form-select @error('organization_id') is-invalid @enderror" id="organization_id" name="organization_id" required>
                                    <option value="">Select Organization</option>
                                    @foreach($organizations as $org)
                                        <option value="{{ $org->id }}" {{ old('organization_id') == $org->id ? 'selected' : '' }}>
                                            {{ $org->name }} ({{ ucfirst($org->sub_role ?? 'Admin') }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-text mt-2 small text-muted">The system will automatically assign this to Club or Institution based on the organization type.</div>
                                @error('organization_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mt-4 text-end">
                                <button type="submit" class="btn text-white fw-bold px-5 py-2 rounded-3 shadow-sm" style="background: linear-gradient(180deg, #A93333 0%, #8B1A1A 100%);">
                                    Save Athlete
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
