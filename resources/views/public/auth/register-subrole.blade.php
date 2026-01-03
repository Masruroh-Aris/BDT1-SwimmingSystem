@extends('layouts.app')

@section('title', 'Daftar Akun | Swim Event')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')
@php
$role = request('role');
@endphp
@php
$role = trim(request('role') ?? '');
@endphp


<section class="login-role">
    {{-- KOLOM KIRI --}}
    <div class="login-left">
        <div class="login-content text-center">

            {{-- Google User Info --}}
            @if(session('google_user'))
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
                    <input type="hidden" name="role" value="{{ $role }}">
                    <input type="hidden" name="subrole" id="selected-subrole" value="">
                </form>
            @endif

            {{-- judul utama --}}
            <h5 class="gudea-bold mb-3">Pilih Sub-Role untuk {{ ucfirst($role) }}</h5>

            <div class="d-grid gap-3 w-100">
                {{-- Jika ADMIN --}}
                @if($role == 'admin')
                    @if(session('google_user'))
                        <button type="button" onclick="selectSubrole('club')" class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                            <i class="ri-medal-fill role-icon"></i>
                            <span class="role-text">Club</span>
                        </button>

                        <button type="button" onclick="selectSubrole('school')" class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                            <i class="ri-building-line role-icon"></i>
                            <span class="role-text">School</span>
                        </button>

                        <button type="button" onclick="selectSubrole('university')" class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                            <i class="ri-bank-line role-icon"></i>
                            <span class="role-text">University</span>
                        </button>
                    @else
                        <a href="{{ route('register.form', ['role' => 'admin', 'subrole' => 'club']) }}" 
                           class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                            <i class="ri-medal-fill role-icon"></i>
                            <span class="role-text">Club</span>
                        </a>

                        <a href="{{ route('register.form', ['role' => 'admin', 'subrole' => 'school']) }}" 
                           class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                            <i class="ri-building-line role-icon"></i>
                            <span class="role-text">School</span>
                        </a>

                        <a href="{{ route('register.form', ['role' => 'admin', 'subrole' => 'university']) }}" 
                           class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                            <i class="ri-bank-line role-icon"></i>
                            <span class="role-text">University</span>
                        </a>
                    @endif

                {{-- Jika SUPERADMIN --}}
                @elseif($role == 'superadmin')
                    @if(session('google_user'))
                        <button type="button" onclick="selectSubrole('nation')" class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                            <i class="ri-earth-line role-icon"></i>
                            <span class="role-text">Nation</span>
                        </button>

                        <button type="button" onclick="selectSubrole('province')" class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                            <i class="ri-map-pin-2-line role-icon"></i>
                            <span class="role-text">Province</span>
                        </button>

                        <button type="button" onclick="selectSubrole('city')" class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                            <i class="ri-building-4-line role-icon"></i>
                            <span class="role-text">City</span>
                        </button>
                    @else
                        <a href="{{ route('register.form', ['role' => 'superadmin', 'subrole' => 'nation']) }}" 
                           class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                            <i class="ri-earth-line role-icon"></i>
                            <span class="role-text">Nation</span>
                        </a>

                        <a href="{{ route('register.form', ['role' => 'superadmin', 'subrole' => 'province']) }}" 
                           class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                            <i class="ri-map-pin-2-line role-icon"></i>
                            <span class="role-text">Province</span>
                        </a>

                        <a href="{{ route('register.form', ['role' => 'superadmin', 'subrole' => 'city']) }}" 
                           class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                            <i class="ri-building-4-line role-icon"></i>
                            <span class="role-text">City</span>
                        </a>
                    @endif
                @endif
            </div>
        </div>
    </div>

    {{-- KOLOM KANAN --}}
    <div class="login-right">
        <img src="{{ asset('images/ex.jpg') }}" 
             alt="Swim Event Illustration" 
             class="img-fluid rounded shadow">
    </div>
</section>
@endsection

@push('scripts')
@if(session('google_user'))
<script>
    function selectSubrole(subrole) {
        document.getElementById('selected-subrole').value = subrole;
        document.getElementById('google-register-form').submit();
    }
</script>
@endif
@endpush
