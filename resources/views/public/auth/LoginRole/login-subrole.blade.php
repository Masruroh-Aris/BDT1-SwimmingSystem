@extends('layouts.app')

@section('title', 'Login | Swim Event')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')
@php
$role = request('role');
@endphp

<section class="login-role">
    {{-- KOLOM KIRI --}}
    <div class="login-left">
        <div class="login-content text-center">
            <h5 class="gudea-regular">Pilih Sub-Role untuk {{ ucfirst($role) }}</h5>

            <div class="d-grid gap-3 w-100">
                {{-- Jika ADMIN --}}
                @if($role == 'admin')
                    <a href="{{ route('login.form.email', ['role' => 'admin', 'subrole' => 'club']) }}" 
                       class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                        <i class="ri-medal-fill role-icon"></i>
                        <span class="role-text">Club</span>
                    </a>
                    <a href="{{ route('login.form.email', ['role' => 'admin', 'subrole' => 'school']) }}" 
                       class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                        <i class="ri-building-line role-icon"></i>
                        <span class="role-text">School</span>
                    </a>

                    <a href="{{ route('login.form.email', ['role' => 'admin', 'subrole' => 'university']) }}" 
                       class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                        <i class="ri-bank-line role-icon"></i>
                        <span class="role-text">University</span>
                    </a>

                {{-- Jika SUPERADMIN --}}
                @elseif($role == 'superadmin')
                    <a href="{{ route('login.form.email', ['role' => 'superadmin', 'subrole' => 'nation']) }}" 
                       class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                        <i class="ri-earth-line role-icon"></i>
                        <span class="role-text">Nation</span>
                    </a>

                    <a href="{{ route('login.form.email', ['role' => 'superadmin', 'subrole' => 'province']) }}" 
                       class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                        <i class="ri-map-pin-2-line role-icon"></i>
                        <span class="role-text">Province</span>
                    </a>

                    <a href="{{ route('login.form.email', ['role' => 'superadmin', 'subrole' => 'city']) }}" 
                       class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                        <i class="ri-building-4-line role-icon"></i>
                        <span class="role-text">City</span>
                    </a>
                @endif
            </div>
        </div>
    </div>

    {{-- KOLOM KANAN --}}
    <div class="login-right">
        <img src="{{ asset('images/ex.jpg') }}" 
             alt="Swim Event Illustration" 
             class="img-fluid">
    </div>
</section>
@endsection
