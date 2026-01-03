@extends('layouts.app')

@section('title', 'Personal Time')

@section('content')
    @php
        // Mock Data for Personal Time
        $personal_times = [
            (object) [
                'meet' => 'BALIOPENWATER2024',
                'location' => 'BALI',
                'event' => '100 M BACKSTROKE MEN, LCM',
                'time' => '02:09.01'
            ],
            (object) [
                'meet' => 'BALIOPENWATER2024',
                'location' => 'BALI',
                'event' => '100 M FREESTYLE MEN, LCM',
                'time' => '01:36.74'
            ],
            (object) [
                'meet' => 'BALIOPENWATER2024',
                'location' => 'BALI',
                'event' => '50 M BACKSTROKE MEN, LCM',
                'time' => '00:58.33'
            ],
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
                    Personal Time
                </h4>
                <div style="height: 3px; width: 60%; background: linear-gradient(90deg, #C32A25, transparent); margin-top: 2px; border-radius: 2px;"></div>
            </div>
        </div>

        <div class="row">
            @foreach($personal_times as $item)
                <div class="col-12 mb-3">
                    <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                        <div class="card-body p-3">

                            {{-- Header: Meet & Location --}}
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-calendar-check me-2" style="color: #C32A25;"></i>
                                    <span class="fw-bold" style="color: #555; font-size: 0.95rem;">{{ $item->meet }}</span>
                                </div>
                                <span class="fw-bold" style="color: #C32A25; font-size: 0.85rem;">{{ $item->location }}</span>
                            </div>

                            {{-- Event Description --}}
                            <div class="d-flex align-items-start mb-2">
                                <i class="bi bi-water me-2" style="color: #C32A25; font-size: 0.9rem;"></i>
                                <span style="font-size: 0.9rem; color: #555;">{{ $item->event }}</span>
                            </div>

                            {{-- Time --}}
                            <div class="d-flex align-items-center">
                                <i class="bi bi-stopwatch-fill me-2" style="color: #C32A25;"></i>
                                <span class="fw-bold" style="color: #C32A25; font-size: 0.95rem;">
                                    {{ $item->time }}
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection