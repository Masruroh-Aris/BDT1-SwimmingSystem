@extends('layouts.app')

@section('title', 'Athlete Detail')

@section('content')
  @php
    // Mock Data for Athlete Detail
    $athlete = (object) [
      'name' => 'I Gede Siman Sudartawa',
      'club' => 'Samudra Aquatic Club',
      'age' => 28,
      'gender' => 'Male',
      'city' => 'Klungkung',
      'province' => 'Bali',
      'category' => 'Senior',
      'best_event' => '200m Butterfly',
      'photo' => 'https://th.bing.com/th/id/OSK.HEROM-hREHClFpAh_swPRpZNnaAMscqIPAWni3kw3DyhZDU?w=384&h=228&c=13&rs=2&o=6&cb=ucfimg1&pid=SANGAM&ucfimg=1' // Example logic
    ];

  @endphp

  <section class="container my-5 meet-detail">
    <div class="row align-items-start justify-content-between">

      {{-- Kolom kiri --}}
      <div class="col-md-6">
        {{-- Card Athlete Info --}}
        <div class="event-link-container" style="text-align: center;">
          <div style="margin-bottom: 30px;">
            <div
              style="width: 150px; height: 150px; margin: 0 auto; border-radius: 50%; background: linear-gradient(135deg, #C32A25 0%, #5D1412 100%); display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 25px rgba(195, 42, 37, 0.3); border: 4px solid #fff; overflow: hidden;">
              @if($athlete->photo)
                <img src="{{ $athlete->photo }}" alt="{{ $athlete->name }}"
                  style="width: 100%; height: 100%; object-fit: cover;">
              @else
                <i class="bi bi-person-fill" style="font-size: 4rem; color: #fff;"></i>
              @endif
            </div>
          </div>

          <div>
            <h1 class="gudea-bold" style="font-size: 2rem; color: #C32A25; margin-bottom: 8px;">{{ $athlete->name }}</h1>
            <p class="gudea-regular" style="font-size: 1.1rem; color: #666; margin-bottom: 30px;">{{ $athlete->club }}</p>

            <div class="gudea-regular"
              style="background: #fff; border-radius: 15px; padding: 25px; box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.05); text-align: left;">
              <div
                style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #f0f0f0;">
                <span style="font-weight: 600; color: #555;">Age:</span>
                <span style="font-weight: 500; color: #C32A25;">{{ $athlete->age }} Years</span>
              </div>
              <div
                style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #f0f0f0;">
                <span style="font-weight: 600; color: #555;">Gender:</span>
                <span style="font-weight: 500; color: #C32A25;">{{ $athlete->gender }}</span>
              </div>
              <div
                style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #f0f0f0;">
                <span style="font-weight: 600; color: #555;">City:</span>
                <span style="font-weight: 500; color: #C32A25;">{{ $athlete->city }}</span>
              </div>
              <div
                style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #f0f0f0;">
                <span style="font-weight: 600; color: #555;">Province:</span>
                <span style="font-weight: 500; color: #C32A25;">{{ $athlete->province }}</span>
              </div>
              <div
                style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #f0f0f0;">
                <span style="font-weight: 600; color: #555;">Category:</span>
                <span style="font-weight: 500; color: #C32A25;">{{ $athlete->category }}</span>
              </div>
              <div style="display: flex; justify-content: space-between; padding: 12px 0;">
                <span style="font-weight: 600; color: #555;">Best Event:</span>
                <span style="font-weight: 500; color: #C32A25;">{{ $athlete->best_event }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- Kolom kanan --}}
      <div class="col-md-5 text-md-start text-center">
        <div class="event-link-container">
          <ul class="list-unstyled event-link gudea-regular mb-0">
            <li>
              <h4 class="mb-0"><a href="{{ route('athletes.event.history') }}">› Event History</a></h4>
            </li>
            <li>
              <h4 class="mb-0"><a href="{{ route('athletes.personal.time') }}">› Personal Time</a></h4>
            </li>
          </ul>
        </div>
      </div>

    </div>
  </section>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
@endsection