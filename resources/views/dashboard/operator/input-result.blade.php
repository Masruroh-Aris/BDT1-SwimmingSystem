@extends('layouts.app')

@section('title', 'Input Result')

@section('content')
<style>
    .nav-link-custom {
        color: #333;
        font-weight: 500;
        text-decoration: none;
        padding-bottom: 5px;
    }
    .nav-link-custom.active {
        color: #C32A25;
        border-bottom: 2px solid #C32A25;
    }
    .form-control {
        border-radius: 10px;
        padding: 10px 15px;
    }
    .btn-create {
        background: linear-gradient(180deg, #A93333 0%, #8B1A1A 100%);
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    }
    
    /* Select2 Styles */
    .select2-container--default .select2-selection--single {
        border-radius: 10px;
        height: 45px;
        padding-top: 8px;
        border: 1px solid #dee2e6;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 45px;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="container-fluid p-0">
    {{-- Top Navbar --}}
    <div class="fixed-top bg-white border-bottom py-3 px-5 d-flex justify-content-between align-items-center" style="height: 70px; z-index: 101;">
        <div class="d-flex align-items-center gap-2">
            <img src="{{ asset('images/logo.png') }}" alt="Swim Event" height="40"> 
        </div>
        
        <div class="d-flex gap-4">
            <a href="#" class="nav-link-custom">Meet Program</a>
            <a href="{{ route('operator.athletes.index') }}" class="nav-link-custom">Athlete</a>
            <a href="#" class="nav-link-custom">Scan</a>
            <a href="{{ route('operator.dashboard') }}" class="nav-link-custom">Dashboard</a>
        </div>
    </div>

    <div class="row g-0" style="margin-top: 70px; min-height: calc(100vh - 70px);">
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
        <div class="col-md-10 offset-md-2 p-5 bg-white">
            
            <h3 class="fw-bold mb-4">Form Result</h3>
            
            <div class="card border border-secondary rounded-4 p-4 shadow-sm">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                     <form action="{{ route('operator.result.store') }}" method="POST">
                         @csrf
                         <div class="mb-3">
                            <label class="form-label text-secondary small">Athlete</label>
                            <input type="text" class="form-control fst-italic" name="athlete" placeholder="Enter Athlete Name">
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label text-secondary small">Event</label>
                                <select class="form-select select2-enable" name="event">
                                    <option></option>
                                    @foreach($events as $event)
                                        <option value="{{ $event->id }}">{{ $event->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-secondary small">Lane</label>
                                <select class="form-select fst-italic" name="lane" style="border-radius: 10px; padding: 10px 15px;">
                                    <option value="" disabled selected>Select Lane</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">Meet Program</label>
                                    <select class="form-select select2-enable" name="meet_program">
                                        <option></option>
                                        @foreach($meets as $meet)
                                            <option value="{{ $meet->id }}">{{ $meet->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">Time Result</label>
                                    <input type="text" class="form-control fst-italic" name="time_result" value="25.55">
                                </div>
                                 <div class="mb-3">
                                    <label class="form-label text-secondary small">Points</label>
                                    <input type="text" class="form-control fst-italic" name="points" value="200">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">Input By</label>
                                    <input type="text" class="form-control fst-italic" name="input_by" value="Joko">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">Note</label>
                                    <textarea class="form-control fst-italic" name="note" rows="5">Juara 1</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">Status</label>
                                    <input type="text" class="form-control fst-italic" name="status" value="Done">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <a href="{{ route('operator.dashboard') }}" class="btn btn-secondary fw-bold px-5 py-2 rounded-3">Back</a>
                            <button type="submit" class="btn text-white fw-bold px-5 py-2 rounded-3 btn-create">Create</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
    {{-- jQuery (Required for Select2) --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2-enable').select2({
                placeholder: 'Select an option',
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endsection
