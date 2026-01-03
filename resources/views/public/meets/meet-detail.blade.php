@extends('layouts.app')

@section('title', 'Meet Detail')

@section('content')
  @php
    // Determine status class
    $statusClass = match (strtolower($meet->status ?? 'upcoming')) {
      'ongoing' => 'status-live',
      'completed' => 'status-finished',
      default => 'status-upcoming',
    };
  @endphp

  <section class="container my-5 meet-detail">
    <div class="row align-items-start justify-content-between">

      {{-- Kolom kiri --}}
      <div class="col-md-6">

        <div class="d-flex align-items-center mb-2">
          <h1 class="meet-detail-title gudea-regular mb-0 me-3">{{ $meet->name }}</h1>
        </div>

        <div class="meet-meta-info mb-4">
          <div class="meta-item">
            <i class="bi bi-geo-alt-fill text-danger me-2"></i>
            <div>
              <span class="meta-value fw-bold">{{ $meet->venue }}</span>
            </div>
          </div>

          <div class="meta-item">
            <i class="bi bi-person-badge-fill text-danger me-2"></i>
            <div>
              <span class="meta-value fw-bold">{{ $meet->created_by ?? 'Committee' }}</span>
            </div>
          </div>

          <div class="meta-item">
            <i class="bi bi-calendar-event-fill text-danger me-2"></i>
            <div>
              <span class="meta-value fw-bold">
                  {{ $meet->start_date ? $meet->start_date->format('d M Y') : 'TBA' }} - 
                  {{ $meet->end_date ? $meet->end_date->format('d M Y') : 'TBA' }}
              </span>
            </div>
          </div>

          <div class="mb-2">
            <span class="badge status-badge {{ $statusClass }} py-2 px-3">{{ $meet->status }}</span>
          </div>
        </div>

        <a href="{{route('login')}}" class="btn btn-primary gudea-bold mt-2 mb-4">
          <span class="btn-text">REGISTER NOW</span>
        </a>


      </div>

      {{-- Kolom kanan --}}
      <div class="col-md-5 text-md-start text-center">
        <div class="event-link-container">
          <ul class="list-unstyled event-link gudea-regular mb-0">
            <li>
              <h4 class="mb-0"><a href="{{ route('meet.events', $meet->id) }}">› Event</a></h4>
            </li>
            <li>
              <h4 class="mb-0"><a href="{{ route('meet.schedule', $meet->id) }}">› Schedule</a></h4>
            </li>
            <li>
              <h4 class="mb-0"><a href="{{ route('meet.result', $meet->id) }}">› Result</a></h4>
            </li>
            <li>
              <h4 class="mb-0"><a href="{{ route('meet.best-swimmer', $meet->id) }}">› Best Swimmer</a></h4>
            </li>
            <li>
              <h4 class="mb-0"><a href="{{ route('meet.medal-tally', $meet->id) }}">› Medal Tally</a></h4>
            </li>
            <li>
              <h4 class="mb-0"><a href="{{ route('meet.full-result', $meet->id) }}">› Full Result</a></h4>
            </li>
          </ul>
        </div>
      </div>

    </div>
  </section>
@endsection