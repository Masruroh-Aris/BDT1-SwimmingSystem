@extends('layouts.app')

@section('title', 'Create Event')

@section('content')
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
                style="background: linear-gradient(180deg, #EBC0C0 0%, #cc4e4a 100%); min-height: calc(100vh - 70px);">

                <div class="bg-white rounded-4 p-5 shadow-sm mx-auto" style="max-width: 900px;">
                    <h3 class="fw-bold text-center mb-5">Edit Event</h3>

                    <form action="{{ route('superadmin.manage-event.update', $event->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-4">
                            {{-- Left Column --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">Select Meet</label>
                                    <select name="meet_id" class="form-select fst-italic text-secondary"
                                        style="border: 1px solid #dee2e6; border-radius: 10px; padding: 10px;" required>
                                        <option value="" disabled>Select a Meet</option>
                                        @foreach($meets as $meet)
                                            <option value="{{ $meet->id }}" {{ old('meet_id', $event->meet_id) == $meet->id ? 'selected' : '' }}>
                                                {{ $meet->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">Event Name</label>
                                    <input type="text" name="name" class="form-control fst-italic text-secondary"
                                        placeholder="Enter event name" value="{{ old('name', $event->name) }}"
                                        style="border: 1px solid #dee2e6; border-radius: 10px; padding: 10px;">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">Event Code</label>
                                    <input type="text" name="code" class="form-control fst-italic text-secondary"
                                        placeholder="Enter event code" value="{{ old('code', $event->code) }}"
                                        style="border: 1px solid #dee2e6; border-radius: 10px; padding: 10px;">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">Start Time</label>
                                    <input type="time" name="start_time" class="form-control fst-italic text-secondary"
                                        value="{{ old('start_time', $event->start_time) }}"
                                        style="border: 1px solid #dee2e6; border-radius: 10px; padding: 10px;">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">Registration Fees</label>
                                    <input type="number" name="fee" class="form-control fst-italic text-secondary"
                                        placeholder="Enter fee amount" value="{{ old('fee', $event->fee) }}"
                                        style="border: 1px solid #dee2e6; border-radius: 10px; padding: 10px;">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">Event Status</label>
                                    <select name="status" class="form-select fst-italic text-secondary"
                                        style="border: 1px solid #dee2e6; border-radius: 10px; padding: 10px;">
                                        <option disabled>Select status</option>
                                        <option value="Upcoming" {{ old('status', $event->status) == 'Upcoming' ? 'selected' : '' }}>Upcoming</option>
                                        <option value="Ongoing" {{ old('status', $event->status) == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                                        <option value="Completed" {{ old('status', $event->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Right Column --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">Gender</label>
                                    <select name="gender" class="form-select fst-italic text-secondary"
                                        style="border: 1px solid #dee2e6; border-radius: 10px; padding: 10px;">
                                        <option disabled>Select gender</option>
                                        <option value="Male" {{ old('gender', $event->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender', $event->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Mixed" {{ old('gender', $event->gender) == 'Mixed' ? 'selected' : '' }}>Mixed</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">Age Group</label>
                                    <input type="text" name="age_group" class="form-control fst-italic text-secondary"
                                        placeholder="e.g. 15-17" value="{{ old('age_group', $event->age_group) }}"
                                        style="border: 1px solid #dee2e6; border-radius: 10px; padding: 10px;">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">Heat</label>
                                    <input type="number" name="heat" class="form-control fst-italic text-secondary"
                                        placeholder="Number of heats" value="{{ old('heat', $event->heat) }}"
                                        style="border: 1px solid #dee2e6; border-radius: 10px; padding: 10px;">
                                </div>

                                <div class="mb-3 pt-4">
                                    <div class="form-check p-3 rounded-3" style="border: 1px solid #dee2e6;">
                                        <input type="checkbox" name="relay" value="1" class="form-check-input" id="relay" {{ old('relay', $event->relay) ? 'checked' : '' }}>
                                        <label class="form-check-label text-secondary fw-bold ms-2" for="relay">Relay
                                            Event</label>
                                        <div class="form-text small text-muted ms-1">Check this if the event is a relay
                                            competition.</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <button type="submit" class="btn text-white fw-bold px-5 py-2 rounded-3"
                                style="background-color: #A93333;">Update Event</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection