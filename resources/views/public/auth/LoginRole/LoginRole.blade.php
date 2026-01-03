@extends('layouts.app')

@section('title', 'Login | Swim Event')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')
<section class="login-role">
    {{-- Kolom kiri --}}
    <div class="login-left">
        <div class="login-content text-center">
            <h1 class="gudea-bold">Swim Event</h1>
            <h4 class="gudea-regular">Swimming Competition</h4>

            <h3 class="gudea-bold">Selamat Datang!</h3>
            <h5 class="gudea-regular">Pilih jenis akun untuk melanjutkan</h5>

            {{-- Tombol Role --}}
            <div class="d-grid gap-3 w-100">


                <a href="{{ route('login.login-subrole', ['role' => 'admin']) }}" class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                    <i class="ri-shield-user-fill role-icon"></i>
                    <span class="role-text">Admin</span>
                </a>

                <a href="{{ route('login.login-subrole', ['role' => 'superadmin']) }}" class="btn btn-role d-flex align-items-center justify-content-center gap-2">
                    <i class="ri-vip-crown-fill role-icon"></i>
                    <span class="role-text">Superadmin</span>
                </a>


            </div>


        </div>
    </div>

    {{-- Kolom kanan --}}
    <div class="login-right">
        <img src="{{ asset('images/ex.jpg') }}" 
             alt="Swim Event Illustration" 
             class="img-fluid rounded shadow">
    </div>
</section>
@endsection
