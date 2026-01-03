@extends('layouts.app')

@section('title', 'Event History')

@section('content')
    @php
        // Mock Data for Event History
        $events = [
            (object) [
                'meet' => 'BALIOPENWATER2024',
                'tag' => 'BALI',
                'event_no' => 'Event 103',
                'desc' => '50 M FREESTYLE MEN, LCM - GROUP 1+',
                'club' => 'SAMUDRA AQUATIC CLUB',
                'time' => '00:29.05',
                'rank' => 'RANK 6'
            ],
            (object) [
                'meet' => 'BALIOPENWATER2024',
                'tag' => 'BALI',
                'event_no' => 'Event 107',
                'desc' => '50 M BREASTSTROKE MEN, LCM - GROUP 1+',
                'club' => 'SAMUDRA AQUATIC CLUB',
                'time' => '00:38.62',
                'rank' => 'RANK 7'
            ],
            (object) [
                'meet' => 'BALIOPENWATER2024',
                'tag' => 'BALI',
                'event_no' => 'Event 207',
                'desc' => '100 M FREESTYLE MEN, LCM - GROUP 1+',
                'club' => 'SAMUDRA AQUATIC CLUB',
                'time' => '01:06.24',
                'rank' => 'RANK 6'
            ],
            (object) [
                'meet' => 'BALIOPENWATER2024',
                'tag' => 'BALI',
                'event_no' => 'Event 307',
                'desc' => '50 M BUTTERFLY MEN, LCM - GROUP 1+',
                'club' => 'SAMUDRA AQUATIC CLUB',
                'time' => '00:32.92',
                'rank' => 'RANK 11'
            ],
            (object) [
                'meet' => 'FAI2022',
                'tag' => 'BALI',
                'event_no' => 'Event 101',
                'desc' => '100 M FREESTYLE MEN, LCM - GROUP 2',
                'club' => 'SAMUDRA AQUATIC CLUB',
                'time' => '01:15.93',
                'rank' => 'RANK 48'
            ]
        ];
    @endphp

    <div class="container my-5">
        <div class="d-flex align-items-center mb-4">
            <a href="#" class="text-decoration-none text-dark me-3" onclick="history.back()">
                <i class="bi bi-arrow-left fs-4"></i>
            </a>
            <div style="position: relative; display: inline-block;">
                <h4 class="gudea-bold mb-0"
                    style="background: linear-gradient(45deg, #C32A25, #8E1B17); -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-block;">
                    Event History
                </h4>
                <div style="height: 3px; width: 60%; background: linear-gradient(90deg, #C32A25, transparent); margin-top: 2px; border-radius: 2px;"></div>
            </div>
        </div>

        <div class="row">
            @foreach($events as $event)
                <div class="col-12 mb-3">
                    <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                        <div class="card-body p-3">

                            {{-- Header: Meet & Tag --}}
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-calendar-event me-2" style="color: #C32A25;"></i>
                                    <span class="fw-bold" style="color: #C32A25; font-size: 0.95rem;">{{ $event->meet }}</span>
                                </div>
                                <span class="fw-bold" style="color: #C32A25; font-size: 0.85rem;">{{ $event->tag }}</span>
                            </div>

                            {{-- Event No --}}
                            <div class="d-flex align-items-center mb-1">
                                <i class="bi bi-list-ol me-2" style="color: #C32A25;"></i>
                                <span class="text-muted" style="font-size: 0.9rem;">{{ $event->event_no }}</span>
                            </div>

                            {{-- Description --}}
                            <div class="d-flex align-items-start mb-1">
                                <i class="bi bi-water me-2" style="color: #C32A25; font-size: 0.9rem;"></i>
                                <span style="font-size: 0.9rem; color: #555;">{{ $event->desc }}</span>
                            </div>

                            {{-- Club --}}
                            <div class="d-flex align-items-center mb-1">
                                <i class="bi bi-building me-2" style="color: #C32A25; font-size: 0.9rem;"></i>
                                <span style="font-size: 0.9rem; color:  #C32A25;">{{ $event->club }}</span>
                            </div>

                            {{-- Time & Rank --}}
                            <div class="d-flex align-items-center mt-2">
                                <i class="bi bi-stopwatch-fill me-2" style="color: #C32A25;"></i>
                                <span class="fw-bold" style="color: #0E4D5F; font-size: 0.95rem;">
                                    {{ $event->time }} - <span class="">{{ $event->rank }}</span>
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection