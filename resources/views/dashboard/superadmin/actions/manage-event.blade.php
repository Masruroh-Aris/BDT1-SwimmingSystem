@extends('layouts.app')

@section('title', 'Manage Event')

@section('content')
    <style>
        .animation-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hover-card {
            transition: all 0.3s ease;
            position: relative; /* Create basis for z-index */
            z-index: 1;
            overflow: visible; /* Ensure dropdowns can spill out */
        }

        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
            z-index: 1050; /* Higher than siblings to allow dropdown overlay */
        }

        .btn-create {
            transition: all 0.3s ease;
        }

        .btn-create:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(169, 51, 51, 0.4) !important;
        }
    </style>


    <div class="container-fluid p-0">
        <div class="row g-0" style="min-height: calc(100vh - 70px);">
            {{-- Sidebar --}}
            <div class="col-md-2 bg-white border-end py-4 d-flex flex-column align-items-center position-fixed h-100"
                style="top: 70px; z-index: 100;">

                {{-- Profile Section --}}
                <div class="text-center mb-5 mt-3">
                    <i class="bi bi-person-circle display-1"></i>
                    <h4 class="fw-bold mt-3">Superadmin</h4>
                    <a href="{{ route('superadmin.profile.edit') }}" class="text-info text-decoration-none small">Edit
                        Profile</a>
                </div>

                {{-- Menu Items --}}
                <div class="w-100 px-3">
                    <nav class="nav flex-column gap-1">
                        <a href="{{ route('superadmin.dashboard') }}" class="nav-link text-dark fs-6">Meet</a>
                        <a href="{{ route('superadmin.manage-meet') }}" class="nav-link text-dark fs-6">Manage Meet</a>
                        <a href="{{ route('superadmin.manage-event') }}" class="nav-link text-dark fs-6">Manage Event</a>
                        <a href="{{ route('superadmin.manage.regist') }}" class="nav-link text-dark fs-6">Manage
                            Registration</a>
                        <a href="#" class="nav-link text-dark fs-6 mt-4" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </nav>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="col-md-10 offset-md-2 p-5"
                style="background: linear-gradient(180deg, #EBC0C0 0%, #E6D2D2 100%); min-height: calc(100vh - 70px);">

                {{-- Header: Create Button and Search --}}
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <a href="{{ route('superadmin.manage-event.create') }}"
                        class="btn text-white fw-bold px-4 py-2 rounded-3 shadow-sm d-flex align-items-center gap-2 btn-create"
                        style="background-color: #A93333; border: none; text-decoration: none;">
                        <i class="bi bi-plus-lg"></i> Create Event
                    </a>

                    <form action="{{ route('superadmin.manage-event') }}" method="GET" class="bg-white rounded-pill px-4 py-2 d-flex align-items-center shadow-sm" style="width: 400px;">
                        <i class="bi bi-search me-2 text-dark"></i>
                        <input type="text" name="search" class="form-control border-0 shadow-none" placeholder="Search Event" value="{{ request('search') }}">
                    </form>
                </div>

                {{-- Cards Grid --}}
                <div class="row g-4">
                    @foreach ($events as $event)
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm rounded-4 h-100 p-3 hover-card animation-fade-in"
                                onclick="window.location='{{ route('superadmin.manage-event.show', $event->id) }}'"
                                style="cursor: pointer;">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-4">
                                        <h5 class="fw-bold m-0 text-truncate" style="max-width: 70%;">{{ $event->name }}</h5>
                                        @php
                                            $badgeClass = match ($event->status) {
                                                'Upcoming' => 'bg-success',
                                                'Ongoing' => 'bg-primary',
                                                'Completed' => 'bg-secondary',
                                                default => 'bg-secondary'
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }} rounded-pill px-3">{{ $event->status }}</span>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-4 text-secondary small">Event Code</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-7 small fw-bold">{{ $event->code }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-4 text-secondary small">Start Time</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-7 small">{{ $event->start_time }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-4 text-secondary small">Fees</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-7 small">Rp {{ number_format($event->fee, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-4 text-secondary small">Gender</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-7 small">{{ $event->gender }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-4 text-secondary small">Age Group</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-7 small">{{ $event->age_group }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-4 text-secondary small">Heat</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-7 small">{{ $event->heat }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-4 text-secondary small">Relay</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-7 small {{ $event->relay ? 'text-success fw-bold' : 'text-muted' }}">
                                            {{ $event->relay ? 'Yes' : 'No' }}
                                        </div>
                                    </div>

                                    <div class="position-absolute bottom-0 end-0 p-3 dropup">
                                        <i class="bi bi-three-dots fs-4 cursor-pointer" data-bs-toggle="dropdown"
                                            aria-expanded="false" onclick="event.stopPropagation()"></i>
                                        <ul class="dropdown-menu p-2 border-0 shadow-lg rounded-3" style="min-width: 150px;">
                                            <li><a href="{{ route('superadmin.manage-event.edit', $event->id) }}"
                                                    class="btn btn-sm w-100 text-white fw-bold mb-2 rounded-pill"
                                                    style="background-color: #C32A25;">Edit</a></li>
                                            <li>
                                                <form action="{{ route('superadmin.manage-event.destroy', $event->id) }}" method="POST" class="d-inline" id="delete-form-{{ $event->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm w-100 text-white fw-bold rounded-pill"
                                                        style="background-color: #8B1A1A;" onclick="confirmDelete({{ $event->id }})">Delete</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#C32A25', // Brand Red
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endpush
