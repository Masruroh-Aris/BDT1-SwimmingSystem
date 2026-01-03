@extends('layouts.app')

@section('title', 'Athlete List')

@section('content')

    {{-- Hero Section --}}
    <section class="meet-section position-relative">
        <x-hero image="images/AthletePage.jpg" line1="The Champion" line2="Swim Event" searchPlaceholder="Search Athlete"
            searchAction="{{ route('athletes.index') }}" />
    </section>

    {{-- Athlete List Section --}}
    <section class="container my-5">
        <div class="athlete-list">
            @forelse($athletes as $athlete)
                {{-- Card Athlete --}}
                {{-- Note: Update route to use show function if available, currently pointing to view --}}
                <a href="{{ route('athlete.detail', ['id' => $athlete->id]) }}" class="card-link-wrapper">
                    <div class="card athlete-card mb-4 border-0 shadow-sm">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="athlete-photo me-3 overflow-hidden">
                                    {{-- Assuming 'photo' column might be added later, currently fallback --}}
                                    @if(isset($athlete->photo) && $athlete->photo)
                                        <img src="{{ $athlete->photo }}" alt="{{ $athlete->name }}"
                                            class="w-100 h-100 object-fit-cover rounded-circle">
                                    @else
                                        <div class="bg-secondary-subtle rounded-circle d-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
                                            <i class="bi bi-person-fill fs-3 text-secondary"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-text">
                                    <h4 class="fw-bold mb-1 gudea-bold text-dark">{{ $athlete->name }}</h4>
                                    <div class="card-text2">
                                        {{-- Display Organization Name --}}
                                        <h5 class="mb-0 gudea-regular text-muted">
                                            {{ $athlete->club->name ?? ($athlete->institution->name ?? '-') }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <i class="bi {{ strtolower($athlete->gender) == 'male' ? 'bi-gender-male text-primary' : 'bi-gender-female text-danger' }} fs-4"></i>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="text-center py-5">
                    <p class="text-muted">No athletes found.</p>
                </div>
            @endforelse

            {{-- Pagination Links --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $athletes->withQueryString()->links() }}
            </div>

        </div>
    </section>

@endsection