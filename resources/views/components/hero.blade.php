<section class="hero-section position-relative">
    <img 
    src="{{ asset($image) }}" 
    srcset="{{ asset($image) }} 1x, {{ asset(preg_replace('/(\.\w+)$/', '@2x$1', $image)) }} 2x"
    alt="Hero Banner" 
    class="hero-bg">

    <div class="hero-overlay"></div>

    <div class="hero-content text-white">
        <div class="hero-title">
            <h1 class="fw-bold first-line">{{ $line1 }}</h1>
            <h1 class="fw-bold second-line">{{ $line2 }}</h1>
        </div>

        @if(isset($searchPlaceholder))
        <div class="search-box">
            <form action="{{ $searchAction }}" method="GET" class="search-form">
                <i class="bi bi-search"></i>
                <input type="text" name="search" placeholder="{{ $searchPlaceholder }}">
            </form>
        </div>
        @endif
    </div>
</section>