@extends('layouts.app')

@section('title', 'Meet Program')

@section('content')

    {{-- Meet Section --}}
    <section class="meet-section position-relative">
        <x-hero image="images/meet.jpg" line1="Welcome to" line2="Swim Event" searchPlaceholder="Search Meet Program"
            searchAction="{{ route('meets.index') }}" />
    </section>

    <section class="container my-5">
        <div class="meet-list">
            <!-- Container for Dynamic Meets -->
            <div id="meet-list-container">
                @forelse($meets as $meet)
                    <a href="{{ route('meet.detail', $meet->id) }}" 
                       class="card-link-wrapper meet-item" 
                       style="text-decoration: none; animation: fadeInUp 0.8s ease-out {{ $loop->index * 0.2 }}s backwards;">
                        <div class="card meet-card mb-4 border-0 shadow-lg" style="background-color: #DA291C; color: white;"> 
                            <div class="card-body d-flex justify-content-between align-items-center text-white">
                                <div class="card-text">
                                    <h4 class="fw-bold mb-1 gudea-bold">{{ $meet->name }}</h4> 
                                    
                                    {{-- Display Linked Events --}}
                                    <h4 class="mb-0 gudea-regular" style="opacity: 0.9; font-size: 1rem;">
                                        @if($meet->events->isNotEmpty())
                                            {{ $meet->events->pluck('name')->unique()->take(3)->implode(', ') }}
                                            @if($meet->events->unique('name')->count() > 3)
                                                ...
                                            @endif
                                        @else
                                            No Events Listed
                                        @endif
                                    </h4> 
                                </div>
                                <div class="card-text2 gudea-regular text-end">
                                    <h5 class="mb-0 fw-bold">{{ $meet->start_date ? $meet->start_date->format('d M Y') : 'Date TBA' }}</h5>
                                    <h5 class="mb-0">{{ $meet->venue }}</h5>
                                    <h5 class="mb-0" style="font-style: italic;">Status: {{ $meet->status }}</h5> 
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="alert alert-light text-center" style="border: 2px solid #DA291C; color: #DA291C;">
                        <i class="fas fa-info-circle me-2"></i> Tidak ada acara renang yang ditemukan.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    {{-- Scripts removed as we use Server Side Rendering (Blade) --}}
@endpush