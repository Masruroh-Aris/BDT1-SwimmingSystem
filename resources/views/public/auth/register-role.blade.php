@extends('layouts.app')

@section('title', 'Daftar Akun | Swim Event')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')
<section class="login-role">
    {{-- Kolom kiri --}}
    <div class="login-left">
        <div class="login-content text-center">

            {{-- judul utama --}}
            <h3 class="gudea-bold">Buat Akun Baru</h3>
            <h5 class="gudea-regular">Pilih jenis akun untuk didaftarkan</h5>

            {{-- Check if coming from Google --}}
            @if(session('google_user'))
                {{-- Google User Info --}}
                <div class="google-user-info mb-4 p-3 bg-white bg-opacity-10 rounded">
                    <div class="d-flex align-items-center justify-content-center gap-3">
                        @if(session('google_user')['avatar'])
                            <img src="{{ session('google_user')['avatar'] }}" alt="Profile" class="rounded-circle" style="width: 50px; height: 50px;">
                        @else
                            <i class="ri-user-fill text-white" style="font-size: 50px;"></i>
                        @endif
                        <div class="text-start">
                            <h6 class="text-white mb-0">{{ session('google_user')['name'] }}</h6>
                            <small class="text-white-50">{{ session('google_user')['email'] }}</small>
                        </div>
                    </div>
                </div>

                {{-- Hidden form for Google registration --}}
                <form id="google-register-form" action="{{ route('register.google.submit') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="google_id" value="{{ session('google_user')['id'] }}">
                    <input type="hidden" name="name" value="{{ session('google_user')['name'] }}">
                    <input type="hidden" name="email" value="{{ session('google_user')['email'] }}">
                    <input type="hidden" name="avatar" value="{{ session('google_user')['avatar'] ?? '' }}">
                    <input type="hidden" name="role" id="selected-role" value="">
                    <input type="hidden" name="subrole" id="selected-subrole" value="">
                </form>
            @endif

            {{-- Tombol Role --}}
            <div class="d-grid gap-3 w-100">
                @if(session('google_user'))
                    {{-- Google registration flow --}}
                    <button type="button" onclick="selectRole('admin')" class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                        <i class="ri-shield-user-fill role-icon"></i>
                        <span class="role-text">Admin</span>
                    </button>

                    <button type="button" onclick="selectRole('superadmin')" class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                        <i class="ri-vip-crown-fill role-icon"></i>
                        <span class="role-text">Superadmin</span>
                    </button>


                @else
                    {{-- Normal registration flow --}}
                    <a href="{{ route('register.subrole', ['role' => 'admin']) }}" class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                        <i class="ri-shield-user-fill role-icon"></i>
                        <span class="role-text">Admin</span>
                    </a>

                    <a href="{{ route('register.subrole', ['role' => 'superadmin']) }}" class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                        <i class="ri-vip-crown-fill role-icon"></i>
                        <span class="role-text">Superadmin</span>
                    </a>


                @endif
            </div>

            {{-- link ke login --}}
            <p class="mt-4 gudea-regular">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-light fw-bold text-decoration-underline">
                    Masuk di sini
                </a>
            </p>
        </div>
    </div>

    {{-- Kolom kanan --}}
    <div class="login-right">
        <img src="{{ asset('images/ex.jpg') }}" 
             alt="Swim Event Illustration" 
             class="img-fluid rounded shadow">
    </div>
</section>

@push('scripts')
@if(session('google_user'))
<script>
function selectRole(role) {
    if (role === 'admin' || role === 'superadmin') {
        // For admin/superadmin, redirect to subrole selection
        window.location.href = '{{ route("register.subrole", ":role") }}'.replace(':role', role);
    } else {
        // For operator, directly submit
        document.getElementById('selected-role').value = role;
        document.getElementById('google-register-form').submit();
    }
}
</script>
@endif
@endpush
@endsection
