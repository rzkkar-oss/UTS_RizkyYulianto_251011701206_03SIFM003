@extends('layouts.app')

@section('title', 'Daftar Sepeda')

@section('content')

<header class="gw-pagehead">
    <div class="container">
        <p class="gw-mono text-orange mb-3">// Katalog</p>
        <h1 class="gw-display gw-pagehead-title mb-0">Daftar sepeda</h1>
    </div>
</header>

<section class="gw-section pt-5">
    <div class="container">

        {{-- Filter tipe + pencarian --}}
        <div class="row g-3 align-items-center mb-5">
            <div class="col-lg-8">
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('bikes.index', array_filter(['q' => request('q')])) }}"
                       class="gw-pill {{ request('type') ? '' : 'active' }}">Semua</a>
                    @foreach ($types as $type)
                        <a href="{{ route('bikes.index', array_filter(['type' => $type, 'q' => request('q')])) }}"
                           class="gw-pill {{ request('type') === $type ? 'active' : '' }}">{{ $type }}</a>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4">
                <form action="{{ route('bikes.index') }}" method="GET" class="d-flex">
                    @if (request('type'))
                        <input type="hidden" name="type" value="{{ request('type') }}">
                    @endif
                    <input type="search" name="q" value="{{ request('q') }}" class="form-control gw-input"
                           placeholder="Cari merek...">
                    <button class="btn gw-btn gw-btn-dark" type="submit">Cari</button>
                </form>
            </div>
        </div>

        <p class="gw-mono text-secondary mb-4">{{ $bikes->count() }} unit ditemukan</p>

        @if ($bikes->isEmpty())
            <div class="gw-empty">
                <p class="gw-display mb-2">Tidak ada sepeda</p>
                <p class="mb-3">Coba ganti filter atau kata kunci pencarian.</p>
                <a href="{{ route('bikes.index') }}" class="btn gw-btn gw-btn-dark btn-sm">Reset filter</a>
            </div>
        @else
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4">
                @foreach ($bikes as $bike)
                    <div class="col gw-up" style="animation-delay: {{ $loop->index * 60 }}ms">
                        @include('partials.bike-card', ['bike' => $bike])
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

@endsection
