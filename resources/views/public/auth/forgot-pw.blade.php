@extends('layouts.app')

@section('title', 'Reset Password | Swim Event')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')

<section class="login-page">

    {{-- KIRI --}}
    <div class="login-left">
        <div class="login-card">

            {{-- Icon --}}
            <div class="login-icon">
                <i class="ri-lock-line"></i>
            </div>

            {{-- Judul --}}
            <h5 class="login-title gudea-bold">Reset Password</h5>

            {{-- Step 1: Enter Email --}}
            <div id="step-email" class="step">
                <p class="text-center gudea-regular mb-4">Masukkan alamat email Anda untuk menerima kode OTP.</p>

                <form id="email-form">
                    @csrf
                    <div class="form-input-group">
                        <label class="form-label">Alamat Email</label>
                        <i class="ri-mail-line input-icon"></i>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email..." required>
                    </div>

                    <button type="submit" class="btn btn-login w-100 gudea-bold">Kirim OTP</button>
                </form>
            </div>

            {{-- Step 2: Enter OTP and New Password --}}
            <div id="step-otp" class="step d-none">
                <p class="text-center gudea-regular mb-4">Masukkan kode OTP yang dikirim ke email Anda dan password baru.</p>

                <form id="otp-form">
                    @csrf
                    <input type="hidden" name="email" id="otp-email">

                    <div class="form-input-group">
                        <label class="form-label">Kode OTP</label>
                        <i class="ri-key-line input-icon"></i>
                        <input type="text" name="otp" id="otp" class="form-control" placeholder="Masukkan OTP..." required maxlength="6">
                    </div>

                    <div class="form-input-group">
                        <label class="form-label">Password Baru</label>
                        <i class="ri-lock-line input-icon"></i>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password baru..." required>
                    </div>

                    <div class="form-input-group">
                        <label class="form-label">Konfirmasi Password</label>
                        <i class="ri-lock-line input-icon"></i>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Konfirmasi password..." required>
                    </div>

                    <button type="submit" class="btn btn-login w-100 gudea-bold">Reset Password</button>
                </form>

                <p class="text-center mt-3">
                    <a href="#" id="back-to-email" class="gudea-bold">Kembali</a>
                </p>
            </div>

            <p class="signup-text text-center gudea-regular mt-3">
                <a href="{{ route('login') }}" class="gudea-bold">Kembali ke Login</a>
            </p>

        </div>
    </div>

    {{-- KANAN --}}
    <div class="login-right">
        <img src="{{ asset('images/ex.jpg') }}"
             class="login-image" alt="Swim Event Illustration">
    </div>

</section>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const emailForm = document.getElementById('email-form');
    const otpForm = document.getElementById('otp-form');
    const stepEmail = document.getElementById('step-email');
    const stepOtp = document.getElementById('step-otp');
    const backToEmail = document.getElementById('back-to-email');

    // Handle email form submission
    emailForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const email = document.getElementById('email').value;

        fetch('/api/auth/forgot-password/send-otp', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ email: email })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'OTP Sent',
                    text: data.message,
                });
                document.getElementById('otp-email').value = email;
                stepEmail.classList.add('d-none');
                stepOtp.classList.remove('d-none');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message,
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Something went wrong. Please try again.',
            });
        });
    });

    // Handle OTP form submission
    otpForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const email = document.getElementById('otp-email').value;
        const otp = document.getElementById('otp').value;
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;

        fetch('/api/auth/forgot-password/verify-otp', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                email: email,
                otp: otp,
                password: password,
                password_confirmation: passwordConfirmation
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: data.message,
                }).then(() => {
                    window.location.href = '{{ route("login") }}';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message,
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Something went wrong. Please try again.',
            });
        });
    });

    // Back to email step
    backToEmail.addEventListener('click', function(e) {
        e.preventDefault();
        stepOtp.classList.add('d-none');
        stepEmail.classList.remove('d-none');
    });
});
</script>
@endpush
