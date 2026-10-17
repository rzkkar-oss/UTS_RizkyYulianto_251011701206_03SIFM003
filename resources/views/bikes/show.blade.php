@extends('layouts.app')

@section('title', $bike->brand . ' ' . $bike->type)

@section('content')

<div class="gw-crumbbar">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb gw-crumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('bikes.index') }}">Daftar Sepeda</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $bike->brand }}</li>
            </ol>
        </nav>
    </div>
</div>

<section class="gw-section pt-5">
    <div class="container">
        <div class="row g-5">

            <div class="col-lg-6">
                <div class="gw-frame">
                    <img src="{{ $bike->image_url }}" alt="{{ $bike->brand }} {{ $bike->type }}">
                </div>
            </div>

            <div class="col-lg-6">
                <p class="gw-tag mb-2">{{ $bike->type }} &middot; {{ $bike->code }}</p>
                <h1 class="gw-display gw-detail-title">{{ $bike->brand }}</h1>

                <div class="d-flex align-items-center flex-wrap gap-3 my-4">
                    <div class="gw-detail-price">{{ $bike->price_label }}<small>/ hari</small></div>
                    <span class="gw-status gw-status-static {{ $bike->available ? 'is-on' : 'is-off' }}">
                        {{ $bike->available ? 'Tersedia' : 'Sedang disewa' }}
                    </span>
                </div>

                <table class="table gw-table">
                    <tbody>
                        <tr><th>Merek</th><td>{{ $bike->brand }}</td></tr>
                        <tr><th>Tipe</th><td>{{ $bike->type }}</td></tr>
                        <tr><th>Jumlah gigi</th><td>{{ $bike->gear_count }} speed</td></tr>
                        <tr><th>Tarif sewa</th><td>{{ $bike->price_label }} / hari</td></tr>
                        <tr><th>Status</th><td>{{ $bike->available ? 'Tersedia' : 'Sedang disewa' }}</td></tr>
                    </tbody>
                </table>

                <div class="d-flex flex-wrap gap-3 mt-4">
                    @if ($bike->available)
                        <a href="{{ route('rentals.create', $bike) }}" class="btn gw-btn gw-btn-orange">Sewa sepeda ini</a>
                    @else
                        <button type="button" class="btn gw-btn gw-btn-dark" disabled>Belum tersedia</button>
                    @endif
                    <a href="{{ route('bikes.index') }}" class="btn gw-btn gw-btn-line">&larr; Kembali</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Sepeda lainnya --}}
@if ($related->isNotEmpty())
<section class="gw-section gw-section-white">
    <div class="container">
        <p class="gw-eyebrow">Lihat juga</p>
        <h2 class="gw-display gw-h2 mb-5">Sepeda lainnya</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
            @foreach ($related as $item)
                <div class="col">
                    @include('partials.bike-card', ['bike' => $item])
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Modal cara memesan (memakai JS Bootstrap) --}}
<div class="modal fade gw-modal" id="modalSewa" tabindex="-1" aria-labelledby="modalSewaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title gw-display" id="modalSewaLabel">Pesan {{ $bike->brand }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <p>Unit <strong>{{ $bike->code }}</strong> — {{ $bike->type }}, {{ $bike->price_label }} / hari.</p>
                <p class="mb-0">Hubungi kami untuk konfirmasi pemesanan:</p>
                <p class="gw-mono mt-2 mb-0">WhatsApp · 0812-0000-0000</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn gw-btn gw-btn-dark btn-sm" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection
