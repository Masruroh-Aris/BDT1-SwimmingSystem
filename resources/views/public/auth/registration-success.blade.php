@extends('layouts.app')

@section('title', 'Registration Successful | Swim Event')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<style>
    .success-card {
        background: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        text-align: center;
        max-width: 500px;
        width: 100%;
        margin: 50px auto;
        position: relative;
        overflow: hidden;
    }
    .icon-container {
        width: 80px;
        height: 80px;
        background: #e8f5e9;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }
    .check-icon {
        font-size: 40px;
        color: #2e7d32;
    }
    .btn-action {
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: bold;
        text-decoration: none;
        transition: all 0.3s;
        display: inline-block;
        width: 48%;
    }
    .btn-login {
        background: #C32A25;
        color: white;
        border: 2px solid #C32A25;
    }
    .btn-login:hover {
        background: #A91E1A;
        border-color: #A91E1A;
        color: white;
    }
    .btn-back {
        background: transparent;
        color: #555;
        border: 2px solid #ddd;
    }
    .btn-back:hover {
        border-color: #aaa;
        background: #f9f9f9;
        color: #333;
    }
    .action-group {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
    }
</style>
@endpush

@section('content')
<section class="container d-flex align-items-center" style="min-height: 80vh;">
    <div class="success-card animate-fade-in">
        <div class="icon-container">
            <i class="ri-checkbox-circle-fill check-icon"></i>
        </div>
        
        <h3 class="gudea-bold mb-3">Akun Berhasil Dibuat!</h3>
        <p class="text-muted mb-4 gudea-regular">
            Selamat, pendaftaran akun Anda telah berhasil. Silakan login untuk memulai menggunakan dashboard Swim Event.
        </p>
        
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <i class="ri-information-line me-2 fs-5"></i>
            <div>
                Data Anda telah tersimpan di sistem kami.
            </div>
        </div>

        <div class="action-group">
            <a href="{{ route('meets.index') }}" class="btn-action btn-back">
                <i class="ri-arrow-left-line me-1"></i> Kembali
            </a>
            <a href="{{ route('login') }}" class="btn-action btn-login">
                Login Sekarang <i class="ri-login-box-line ms-1"></i>
            </a>
        </div>
    </div>
</section>
@endsection
