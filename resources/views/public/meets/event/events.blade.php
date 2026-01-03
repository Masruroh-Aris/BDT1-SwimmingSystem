@extends('layouts.app')

@section('title', 'Event List - ' . $meet->name)

@section('content')

    {{-- Meet List Section --}}
    <section class="container my-5">
        <div class="d-flex justify-content-end align-items-center mb-4 gap-3">
            <a href="{{ route('order.of.event') }}" class="btn-order border-0 text-decoration-none">
                <i class="bi bi-list-ol"></i> Order of Event
            </a>

            <div class="search-box" style="margin: 0;">
                <form action="{{ route('meet.events', $meet->id) }}" method="GET" class="search-form">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Search..." name="search" value="{{ request('search') }}"
                        class="form-control border-0 shadow-none bg-transparent">
                </form>
            </div>
        </div>

        <div class="meet-list" id="event-list-container">
            @forelse($events as $event)
                <div class="card meet-card mb-4 border-0 shadow-lg" style="background: linear-gradient(135deg, #DA291C 0%, #B91C1C 100%); color: white;">
                    <div class="card-body d-flex justify-content-between align-items-center text-white">
                        <div class="card-text">
                            <h4 class="fw-bold mb-0 gudea-bold">{{ $event->name }}</h4>
                        </div>
                        <div class="card-text2 gudea-regular text-end">
                            <h5 class="mb-0 fw-bold">
                                {{ $meet->start_date ? $meet->start_date->format('d M Y') : 'TBA' }}
                                @if($event->start_time)
                                    <span class="text-white-50">| {{ $event->start_time }}</span>
                                @endif
                            </h5>
                            <h5 class="mb-0">{{ $meet->venue }}</h5> 
                            <h5 class="mb-0" style="font-style: italic;">{{ $event->status ?? 'Upcoming' }}</h5>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-light text-center" style="border: 2px solid #DA291C; color: #DA291C;">
                    <i class="fas fa-info-circle me-2"></i> No events found for this meet.
                </div>
            @endforelse
        </div>
    </section>

@endsection