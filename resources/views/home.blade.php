@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- HERO --}}
<header class="gw-hero">
    <div class="container">
        <div class="row align-items-center g-5 pb-5">
            <div class="col-lg-7">
                <p class="gw-mono text-orange mb-4">// Rental sepeda harian</p>
                <h1 class="gw-display gw-hero-title">
                    Sewa<br>sepeda.<br><span class="text-orange">Tanpa ribet.</span>
                </h1>
                <p class="gw-hero-lead">
                    Pilih unit, cek tarif per hari, lalu gowes. Dari mountain bike sampai sepeda listrik —
                    semua terawat dan siap jalan.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('bikes.index') }}" class="btn gw-btn gw-btn-orange">Lihat semua sepeda</a>
                    <a href="#cara-sewa" class="btn gw-btn gw-btn-line-light">Cara sewa</a>
                </div>
            </div>

            <div class="col-lg-5">
    @if ($slides->isNotEmpty())
        <div class="gw-hero-slider">
            <div class="gw-hero-frame">
                <div id="heroSlider" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4500">
                    <div class="carousel-inner">
                        @foreach ($slides as $bike)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <a href="{{ route('bikes.show', $bike) }}" class="gw-slide-link" draggable="false">
                                    <img src="{{ $bike->image_url }}" alt="{{ $bike->brand }} {{ $bike->type }}" draggable="false">
                                    <div class="gw-hero-caption">
                                        <span>{{ $bike->brand }} / {{ $bike->type }}</span>
                                        <strong>{{ $bike->price_label }}</strong>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="gw-hero-ctrls">
                <button type="button" class="gw-ctrl" data-bs-target="#heroSlider" data-bs-slide="prev" aria-label="Sebelumnya">&larr;</button>
                <span class="gw-ctrl-count"><b id="heroCur">01</b> / {{ str_pad($slides->count(), 2, '0', STR_PAD_LEFT) }}</span>
                <button type="button" class="gw-ctrl" data-bs-target="#heroSlider" data-bs-slide="next" aria-label="Berikutnya">&rarr;</button>
            </div>
        </div>
    @endif
</div>
        </div>
    </div>

    <div class="gw-strip">
        <div class="container">
            <div class="row g-0">
                <div class="col-6 col-md-3 gw-strip-item">
                    <strong>{{ $stats['total'] }}</strong><span>Unit sepeda</span>
                </div>
                <div class="col-6 col-md-3 gw-strip-item">
                    <strong>{{ $stats['available'] }}</strong><span>Siap disewa</span>
                </div>
                <div class="col-6 col-md-3 gw-strip-item">
                    <strong>{{ $stats['types'] }}</strong><span>Tipe sepeda</span>
                </div>
                <div class="col-6 col-md-3 gw-strip-item">
                    <strong>{{ $stats['min_price'] ? 'Rp ' . number_format($stats['min_price'] / 1000, 0, ',', '.') . 'rb' : '-' }}</strong>
                    <span>Mulai dari / hari</span>
                </div>
            </div>
        </div>
    </div>
</header>

{{-- KOLEKSI --}}
<section class="gw-section">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-5">
            <div>
                <p class="gw-eyebrow">01 — Koleksi</p>
                <h2 class="gw-display gw-h2 mb-0">Pilihan<br>minggu ini</h2>
            </div>
            <a href="{{ route('bikes.index') }}" class="btn gw-btn gw-btn-line">Semua sepeda &rarr;</a>
        </div>

        @if ($featured->isEmpty())
            <div class="gw-empty">
                <p class="gw-display mb-2">Data masih kosong</p>
                <p class="mb-0">Jalankan <code>php artisan db:seed</code> untuk mengisi data sepeda.</p>
            </div>
        @else
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
                @foreach ($featured as $bike)
                    <div class="col gw-up" style="animation-delay: {{ $loop->index * 80 }}ms">
                        @include('partials.bike-card', ['bike' => $bike])
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- CARA SEWA --}}
<section class="gw-section gw-section-white" id="cara-sewa">
    <div class="container">
        <p class="gw-eyebrow">02 — Cara sewa</p>
        <h2 class="gw-display gw-h2 mb-5">Tiga langkah,<br>langsung jalan</h2>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="gw-step">
                    <div class="gw-step-num">01</div>
                    <h3 class="gw-step-title">Pilih sepeda</h3>
                    <p>Telusuri daftar sepeda, filter berdasarkan tipe, dan lihat status ketersediaannya.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="gw-step">
                    <div class="gw-step-num">02</div>
                    <h3 class="gw-step-title">Cek detail &amp; tarif</h3>
                    <p>Buka halaman detail untuk melihat jumlah gigi dan tarif sewa per hari.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="gw-step">
                    <div class="gw-step-num">03</div>
                    <h3 class="gw-step-title">Hubungi &amp; gowes</h3>
                    <p>Konfirmasi lewat kontak kami, ambil unitnya, dan mulai perjalananmu.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="gw-cta">
    <div class="container d-flex flex-wrap justify-content-between align-items-center gap-4">
        <h2 class="gw-display gw-cta-title mb-0">Siap gowes<br>hari ini?</h2>
        <a href="{{ route('bikes.index') }}" class="btn gw-btn gw-btn-dark btn-lg">Pilih sepeda &rarr;</a>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var el = document.getElementById('heroSlider');
    if (!el) return;

    var carousel = bootstrap.Carousel.getOrCreateInstance(el);
    var cur = document.getElementById('heroCur');

    // update nomor "01 / 08"
    el.addEventListener('slid.bs.carousel', function (e) {
        cur.textContent = String(e.to + 1).padStart(2, '0');
    });

    // geser dengan drag mouse (di HP, swipe sudah ditangani Bootstrap)
    var startX = null, moved = false;

    el.addEventListener('pointerdown', function (e) {
        if (e.pointerType !== 'mouse') return;
        startX = e.clientX;
        moved = false;
    });
    el.addEventListener('pointerup', function (e) {
        if (startX === null) return;
        var dx = e.clientX - startX;
        if (Math.abs(dx) > 40) {
            moved = true;
            dx < 0 ? carousel.next() : carousel.prev();
        }
        startX = null;
    });
    el.addEventListener('pointercancel', function () { startX = null; });

    // jangan buka halaman detail kalau yang terjadi adalah drag
    el.addEventListener('click', function (e) {
        if (moved) { e.preventDefault(); moved = false; }
    }, true);
});
</script>
@endpush