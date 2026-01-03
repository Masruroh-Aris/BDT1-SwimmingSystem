<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Swim Event')</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">


    {{-- Font Global --}}
    <link href="https://fonts.googleapis.com/css2?family=Gudea:ital,wght@0,400;0,700;1,400&family=Rufina:wght@400;700&display=swap" rel="stylesheet">

    {{-- CSS Global --}}
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/public.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    {{-- Script (Bootstrap + html5-qrcode) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://unpkg.com/html5-qrcode" defer></script>

    <style>
      body {
        overflow-x: hidden;
        padding-top: 80px; /* Adjust for fixed navbar */
      }

      main {
        min-height: 100vh;
      }
    </style>
    @stack('styles')
</head>
<body>

    {{-- Navbar --}}
    @include('layouts.navbar')

    {{-- Isi Halaman --}}
    <main class="container-fluid p-0">
        @yield('content')
    </main>

    {{-- Global Logout Form --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    @stack('scripts')
</body>
</html>