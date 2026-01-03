<nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm fixed-top">
    <div class="container">

        {{-- Logo kiri --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ route('meets.index') }}">
            <img src="{{ asset('images/prsi-logo.png') }}" alt="Logo PRSI" height="45" class="me-2">
                <div class="brand-text rufina-bold">
                    <span class="brand-swim">Swim</span>
                    <span class="brand-event">Event</span>
                </div>
        </a>

        {{-- Tombol toggle untuk HP --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Menu kanan --}}
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('meets.index') ? 'active text-danger border-bottom border-danger' : '' }}"
                       href="{{ route('meets.index') }}">Meet Program</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('athletes.index') ? 'active text-danger border-bottom border-danger' : '' }}"
                       href="{{ route('athletes.index') }}">Athlete</a>
                </li>
                <li class="nav-item">
                    @auth
                        @php
                            $dashboardRoute = '#';
                            $rawRole = Auth::user()->role ?? '';
                            $role = strtolower(trim($rawRole));
                            
                            if($role === 'operator') $dashboardRoute = route('operator.dashboard');
                            elseif($role === 'admin') $dashboardRoute = route('admin.dashboard');
                            elseif($role === 'super_admin' || $role === 'superadmin') $dashboardRoute = route('superadmin.dashboard');
                        @endphp
                        <a href="{{ $dashboardRoute }}"
                            class="nav-link {{ request()->routeIs('*.dashboard')? 'active text-danger border-bottom border-danger' : '' }}">Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="nav-link {{ request()->routeIs('login', 'login.*', 'password.*')? 'active text-danger border-bottom border-danger' : '' }}">Login
                        </a>
                    @endauth
                </li>

            </ul>
        </div>
    </div>
</nav>