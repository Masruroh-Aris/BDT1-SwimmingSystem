@extends('layouts.app')

@section('title', 'Login | Swim Event')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')

@php
$role = request('role') ?? 'operator';
$subrole = request('subrole') ?? null;

$roleNames = [
    'admin' => 'Admin',
    'superadmin' => 'Superadmin',
    'operator' => 'Operator',
];

$subroleNames = [
    'club' => 'Club',
    'school' => 'School',
    'university' => 'University',
    'nation' => 'Nation',
    'province' => 'Province',
    'city' => 'City',
    'default' => '',
];
@endphp

<section class="login-page">

    {{-- KIRI --}}
    <div class="login-left">
        <div class="login-card">

            {{-- Icon --}}
            <div class="login-icon">
                <i class="ri-user-3-fill"></i>
            </div>

            {{-- Judul Login --}}
            <h5 class="login-title gudea-bold">Masuk Sebagai 
                @if($role === 'operator')
                    Operator
                @else
                    {{ $roleNames[$role] }}
                    @if($subrole && isset($subroleNames[$subrole]) && $subroleNames[$subrole] !== '')
                        ({{ $subroleNames[$subrole] }})
                    @endif
                @endif
            </h5>


            {{-- Step Info --}}
            <div class="login-step">
                <div class="step-wrapper">
                    <div class="step-number-icon">2</div>
                    <span class="step-number gudea-bold">Langkah 2 dari 2</span>
                </div>
                <span class="step-desc gudea-regular">Masukkan password untuk masuk</span>
            </div>

            {{-- Form Password --}}
            
            <form action="{{ route('login.perform') }}" method="POST">
                @csrf

                <input type="hidden" name="email" value="{{ request('email') }}">
                <input type="hidden" name="role" value="{{ $role }}">
                @if($subrole)
                    <input type="hidden" name="subrole" value="{{ $subrole }}">
                @endif
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif

                <div class="form-input-group">
                    <label class="form-label gudea-bold">Password</label>
                    <i class="ri-lock-line input-icon"></i>
                    <input type="password" name="password" class="form-control" placeholder="Password..." required>
                </div>

                {{-- Lupa Password --}}
                <div class="form-extra d-flex justify-content-between align-items-center">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember" class="gudea-regular">Ingatkan saya</label>
                    </div>
                    <div class="forgot-password">
                        <a href="{{ route('password.request') }}"  class="gudea-bold">Lupa password?</a> {{--belom aku kasih routenya--}}
                    </div>
                </div>

                <button type="submit" class="btn btn-login w-100 gudea-bold">Masuk ke Dashboard</button>
            </form>

        </div>
    </div>

    {{-- KANAN --}}
    <div class="login-right">
        <img src="{{ asset('images/ex.jpg') }}"
             class="login-image" alt="Swim Event Illustration">
    </div>

</section>

@endsection
