<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Admin\IndexController;
use App\Http\Controllers\Dashboard\Admin\RegisterController;
use App\Http\Controllers\Dashboard\Admin\HistoryController;
use App\Http\Controllers\Dashboard\Admin\PaymentController;
use App\Http\Controllers\Dashboard\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Dashboard\SuperAdmin\IndexController as SuperAdminIndexController;
use App\Http\Controllers\Dashboard\SuperAdmin\ManageMeetController;
use App\Http\Controllers\Dashboard\SuperAdmin\ManageEventController;
use App\Http\Controllers\Dashboard\SuperAdmin\ProfileController;
use App\Http\Controllers\Dashboard\SuperAdmin\ManageRegistrationController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\Operator\IndexController as OperatorIndexController;
use App\Http\Controllers\Dashboard\Operator\ProfileController as OperatorProfileController;
use App\Http\Controllers\Dashboard\Operator\CertificateController as OperatorCertificateController;
use App\Http\Controllers\Dashboard\Operator\ResultController as OperatorResultController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\PublicController;

// ===============================
// HALAMAN PUBLIC
// ===============================
Route::get('/', [PublicController::class, 'meets'])->name('meets.index');
Route::get('/athletes', [PublicController::class, 'athletes'])->name('athletes.index');

// Halaman Meet Detail
Route::get('/meet-detail/{id}', [PublicController::class, 'showMeet'])->name('meet.detail');
Route::view('/medal-tally', 'public.meets.medal-tally')->name('medal.tally');
Route::view('/best-swimmer', 'public.meets.best-swimmer')->name('best.swimmer');

Route::get('/meet-detail/{id}/events', [PublicController::class, 'meetEvents'])->name('meet.events');
    Route::view('/order-of-event', 'public.meets.event.order-of-event')->name('order.of.event');

Route::get('/meet-detail/{id}/best-swimmer', [PublicController::class, 'meetBestSwimmer'])->name('meet.best-swimmer');
Route::get('/meet-detail/{id}/schedule', [PublicController::class, 'meetSchedule'])->name('meet.schedule');
Route::get('/meet-detail/{id}/result', [PublicController::class, 'meetResults'])->name('meet.result');
Route::get('/meet-detail/{id}/full-result', [PublicController::class, 'meetFullResult'])->name('meet.full-result');
Route::get('/meet-detail/{id}/medal-tally', [PublicController::class, 'meetMedalTally'])->name('meet.medal-tally');

// Halaman Athlete Detail
Route::view('/athlete-detail', 'public.athletes.athlete-detail')->name('athlete.detail');
Route::view('/athletes/event-history', 'public.athletes.event-history-athlete')->name('athletes.event.history');
Route::view('/athletes/personal-time', 'public.athletes.personal-time')->name('athletes.personal.time');

// Halaman Scan Sertifikat
Route::view('/scan-certif', 'public.sertif.scan-sertif')->name('scan.certif');


// ===============================
// LOGIN (STEP PER STEP)
// ===============================

// Step 1: Pilih Role Utama
Route::view('/login', 'public.auth.LoginRole.LoginRole')->name('login');

// Step 2: Pilih Sub-Role (Admin/Superadmin)
Route::get('/login-login-subrole', function () {
    $role = request('role');
    return view('public.auth.LoginRole.login-subrole', compact('role'));
})->name('login.login-subrole');

// Step 3: Operator langsung ke form login
// Step 3: Operator login dedicated page
Route::get('/login-operator', function () {
    return view('public.auth.login-operator');
})->name('login.operator');

// Step 4: Form Email & Password
Route::view('/login-form-email', 'public.auth.login-form-email')->name('login.form.email');
Route::view('/login-form-email', 'public.auth.login-form-email')->name('login.form.email');
Route::view('/login-form-password', 'public.auth.login-form-password')->name('login.form.password');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/forgot-password', function () {
    return view('public.auth.forgot-pw', ['token' => 'dummy-token']);
})->name('password.request');
Route::post('/forgot-password', function () {
    // Redirect to login or handle if needed
    return redirect()->route('login');
})->name('password.email');

// Google OAuth Routes
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');
Route::get('/auth/google/register', [GoogleController::class, 'redirectToGoogleRegister'])->name('google.register');
Route::get('/auth/google/register/callback', [GoogleController::class, 'handleGoogleRegisterCallback'])->name('google.register.callback');


// ===============================
// REGISTER / DAFTAR AKUN
// ===============================

// Step 1: Pilih Role
Route::view('/register-role', 'public.auth.register-role')->name('register.role');

// Step 2: Pilih Subrole (tergantung role)
Route::get('/register-subrole', function () {
    $role = request('role');
    return view('public.auth.register-subrole', compact('role'));
})->name('register.subrole');

// Step 3: Untuk Operator langsung ke form
Route::get('/register-operator', function () {
    $role = 'operator';
    return view('public.auth.register-form', compact('role'));
})->name('register.operator');

// Step 4: Form Pendaftaran
// Step 4: Form Pendaftaran (GET View)
Route::view('/register-form', 'public.auth.register-form')->name('register.form');
// Step 5: Submit Pendaftaran (POST)
Route::post('/register-submit', [LoginController::class, 'register'])->name('register.submit');
Route::post('/register-google-submit', [LoginController::class, 'registerWithGoogle'])->name('register.google.submit');

//OPERATOR DASHBOARD
Route::middleware('auth')->group(function () {
    Route::get('/operator-dashboard', [OperatorIndexController::class, 'index'])->name('operator.dashboard');
    Route::get('/operator/input-result', [OperatorIndexController::class, 'inputResult'])->name('operator.input-result');
    Route::get('/operator/result-detail/{id}', [OperatorIndexController::class, 'show'])->name('operator.result.show');
    Route::get('/operator/profile', [OperatorProfileController::class, 'edit'])->name('operator.profile.edit');
    Route::put('/operator/profile', [OperatorProfileController::class, 'update'])->name('operator.profile.update');
    Route::get('/operator/certificate', [OperatorCertificateController::class, 'index'])->name('operator.certificate.index');
    Route::post('/operator/certificate', [OperatorCertificateController::class, 'store'])->name('operator.certificate.store');
    Route::post('/operator/result/store', [OperatorResultController::class, 'store'])->name('operator.result.store');
    
    // Manage Athletes (CRUD)
    Route::resource('/operator/athletes', \App\Http\Controllers\Dashboard\Operator\AthleteController::class)->names('operator.athletes');
});

// ADMIN DASHBOARD
Route::middleware('auth')->group(function () {
    Route::get('/admin-dashboard', [IndexController::class, 'index'])->name('admin.dashboard');
    Route::get('/register-admin', [RegisterController::class, 'index'])->name('admin.register');
    Route::post('/register-admin', [RegisterController::class, 'store'])->name('admin.register.store');
    Route::post('/admin/registration/status', [RegisterController::class, 'updateStatus'])->name('admin.register.updateStatus');
    Route::get('/admin/edit-profile', [AdminProfileController::class, 'index'])->name('admin.profile.edit');
    Route::get('/history-admin/{id?}', [HistoryController::class, 'index'])->name('admin.history');
    Route::get('/payment-admin', [PaymentController::class, 'index'])->name('admin.payment');
    Route::view('/detail-payment-admin', 'dashboard.admin.actions.detail-payment')->name('admin.payment.detail');
    Route::post('/payment-admin/upload', [PaymentController::class, 'upload'])->name('admin.payment.upload');
});

// SUPERADMIN DASHBOARD
Route::middleware('auth')->group(function () {
    Route::get('/superadmin-dashboard', [SuperAdminIndexController::class, 'index'])->name('superadmin.dashboard');
    Route::get('/meet-details/{id}', [SuperAdminIndexController::class, 'show'])->name('superadmin.meet.show');
    // Manage Meet (CRUD)
    Route::get('/manage-meet', [ManageMeetController::class, 'index'])->name('superadmin.manage-meet');
    Route::get('/create-meet', [ManageMeetController::class, 'create'])->name('superadmin.manage-meet.create');
    Route::post('/manage-meet', [ManageMeetController::class, 'store'])->name('superadmin.manage-meet.store');
    Route::get('/edit-meet/{id}', [ManageMeetController::class, 'edit'])->name('superadmin.manage-meet.edit'); // id param added
    Route::put('/manage-meet/{id}', [ManageMeetController::class, 'update'])->name('superadmin.manage-meet.update');
    Route::delete('/manage-meet/{id}', [ManageMeetController::class, 'destroy'])->name('superadmin.manage-meet.destroy');
    Route::get('/edit-profile', [ProfileController::class, 'index'])->name('superadmin.profile.edit');

    // Manage Event (CRUD)
    Route::get('/manage-event', [ManageEventController::class, 'index'])->name('superadmin.manage-event');
    Route::get('/manage-event/create', [ManageEventController::class, 'create'])->name('superadmin.manage-event.create');
    Route::post('/manage-event', [ManageEventController::class, 'store'])->name('superadmin.manage-event.store');
    Route::get('/manage-event/{id}', [ManageEventController::class, 'show'])->name('superadmin.manage-event.show');
    Route::get('/manage-event/{id}/edit', [ManageEventController::class, 'edit'])->name('superadmin.manage-event.edit');
    Route::put('/manage-event/{id}', [ManageEventController::class, 'update'])->name('superadmin.manage-event.update');
    Route::delete('/manage-event/{id}', [ManageEventController::class, 'destroy'])->name('superadmin.manage-event.destroy');
    Route::get('/manage-regist', [ManageRegistrationController::class, 'index'])->name('superadmin.manage.regist');
    Route::post('/manage-regist/status', [ManageRegistrationController::class, 'updateStatus'])->name('superadmin.manage.regist.status');
});

// Public/Shared Routes
Route::get('/certificate/view/{id}', [CertificateController::class, 'show'])->name('certificate.show');
Route::get('/certificate/registration/{id}', [CertificateController::class, 'showRegistration'])->name('certificate.show.registration');


