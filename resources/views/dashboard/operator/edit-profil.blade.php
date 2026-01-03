@extends('layouts.app')

@section('title', 'Edit Profile')

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

    .profile-upload-zone {
        transition: all 0.3s ease;
    }

    .profile-upload-zone:hover {
        transform: scale(1.05);
    }

    .profile-upload-zone:hover .camera-icon-wrapper {
        background-color: #A93333 !important;
        border-color: #A93333 !important;
    }

    .profile-upload-zone:hover .camera-icon-wrapper i {
        color: white !important;
    }

    .form-control {
        transition: all 0.3s ease;
        border: 1px solid #dee2e6;
    }

    .form-control:focus {
        border-color: #A93333;
        box-shadow: 0 0 0 0.25rem rgba(169, 51, 51, 0.25);
        transform: translateY(-2px);
    }

    .btn-save {
        transition: all 0.3s ease;
        background-color: #A93333;
    }

    .btn-save:hover {
        background-color: #8B1A1A; /* Darker red */
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(169, 51, 51, 0.3);
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
                    <a href="{{ route('operator.dashboard') }}" class="nav-link text-dark fs-5">Result</a>
                    <a href="{{ route('operator.athletes.index') }}" class="nav-link text-dark fs-5">Athletes</a>
                    <a href="{{ route('operator.certificate.index') }}" class="nav-link text-dark fs-5">Certificate</a>
                    <a href="#" onclick="event.preventDefault(); try { document.getElementById('logout-form').submit(); } catch(e) { console.error('Logout error:', e); window.location.href='{{ route('logout') }}'; }" class="nav-link text-dark fs-5 mt-4">Logout</a>
                </nav>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="col-md-10 offset-md-2 p-5" style="background: linear-gradient(180deg, #EBC0C0 0%, #E6D2D2 100%); min-height: calc(100vh - 70px);">
            
            <div class="bg-white rounded-4 p-5 shadow-sm mx-auto animation-fade-in" style="max-width: 800px;">
                <h3 class="fw-bold text-center mb-5">Edit Profile</h3>

                <form action="{{ route('operator.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    {{-- Profile Image --}}
                    <div class="d-flex justify-content-center mb-4">
                        <div class="position-relative profile-upload-zone" style="cursor: pointer;">
                            <i class="bi bi-person-circle display-1 text-secondary"></i>
                            <div class="camera-icon-wrapper position-absolute bottom-0 end-0 bg-white rounded-circle p-1 shadow-sm border border-secondary transition-all">
                                <i class="bi bi-camera-fill text-dark"></i>
                            </div>
                            <input type="file" class="position-absolute w-100 h-100 top-0 start-0 opacity-0" name="profile_image" style="cursor: pointer;">
                        </div>
                    </div>

                    <div class="row g-4">
                        {{-- Name --}}
                        <div class="col-md-6">
                            <label class="form-label text-secondary small">Name</label>
                            <input type="text" class="form-control rounded-3 py-2" name="name" value="Oprator" placeholder="Enter name">
                        </div>

                        {{-- Username --}}
                        <div class="col-md-6">
                            <label class="form-label text-secondary small">Username</label>
                            <input type="text" class="form-control rounded-3 py-2" name="username" value="oprator" placeholder="Enter username">
                        </div>

                        {{-- Email (Read Only) --}}
                        <div class="col-12">
                            <label class="form-label text-secondary small">Email</label>
                            <input type="email" class="form-control bg-light rounded-3 py-2" name="email" value="oprator@example.com" readonly style="cursor: not-allowed;">
                            <div class="form-text text-muted small"><i class="bi bi-lock-fill me-1"></i>Email cannot be changed as it is used for login.</div>
                        </div>

                        {{-- Password --}}
                        <div class="col-md-6">
                            <label class="form-label text-secondary small">New Password</label>
                            <input type="password" class="form-control rounded-3 py-2" name="password" placeholder="Leave blank to keep current">
                        </div>

                        {{-- Confirm Password --}}
                        <div class="col-md-6">
                            <label class="form-label text-secondary small">Confirm Password</label>
                            <input type="password" class="form-control rounded-3 py-2" name="password_confirmation" placeholder="Confirm new password">
                        </div>
                    </div>

                    <div class="text-center mt-5">
                        <button type="button" class="btn text-white fw-bold px-5 py-2 rounded-3 btn-save">Save Changes</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
