<nav class="navbar navbar-expand-lg navbar-dark gw-nav sticky-top">
    <div class="container">
        <a class="gw-brand" href="{{ route('home') }}">
            <span class="gw-brand-mark"></span>GOWES<small>Rental Sepeda</small>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#gwMenu" aria-controls="gwMenu" aria-expanded="false" aria-label="Buka menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="gwMenu">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('bikes.*') ? 'active' : '' }}" href="{{ route('bikes.index') }}">Daftar Sepeda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#cara-sewa">Cara Sewa</a>
                </li>
                <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                    <a class="btn gw-btn gw-btn-orange btn-sm" href="{{ route('bikes.index') }}">Sewa Sekarang</a>
                </li>       
            </ul>
        </div>
    </div>
</nav>
