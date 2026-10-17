@extends('layouts.app')

@section('title', 'Struk ' . $rental->rental_code)

@section('content')

@php
    $instruction = match ($rental->payment_method) {
        'Tunai'         => 'Bayar langsung di tempat saat pengambilan sepeda.',
        'Transfer Bank' => 'Transfer ke rekening BCA 000-000-0000 a.n. GOWES Rental Sepeda, lalu tunjukkan bukti transfer saat pengambilan.',
        'QRIS'          => 'Scan kode QRIS di kasir saat pengambilan sepeda.',
        default         => 'Kirim pembayaran ' . $rental->payment_method . ' ke 0812-0000-0000 a.n. GOWES Rental Sepeda.',
    };
@endphp

<header class="gw-pagehead gw-noprint">
    <div class="container">
        <p class="gw-mono text-orange mb-3">// Pemesanan</p>
        <h1 class="gw-display gw-pagehead-title mb-0">Struk sewa</h1>
    </div>
</header>

<section class="gw-section pt-5">
    <div class="container">

        <div class="gw-receipt">
            <div class="gw-receipt-head">
                <div>
                    <p class="gw-mono mb-2 gw-receipt-sub">Struk sewa &middot; GOWES Rental Sepeda</p>
                    <div class="gw-receipt-code">{{ $rental->rental_code }}</div>
                </div>
                <span class="gw-badge is-{{ $rental->status }}">{{ $rental->status }}</span>
            </div>

            <div class="gw-receipt-body">
                @if ($rental->bike)
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <img src="{{ $rental->bike->image_url }}" alt="{{ $rental->bike->brand }}" class="gw-receipt-thumb">
                        <div>
                            <p class="gw-tag mb-1">{{ $rental->bike->type }}</p>
                            <div class="gw-display gw-receipt-bike">{{ $rental->bike->brand }}</div>
                        </div>
                    </div>
                @endif

                <table class="table gw-table">
                    <tbody>
                        <tr><th>Kode sewa</th><td>{{ $rental->rental_code }}</td></tr>
                        <tr><th>Nama penyewa</th><td>{{ $rental->renter_name }}</td></tr>
                        <tr><th>No. HP</th><td>{{ $rental->renter_phone }}</td></tr>
                        <tr><th>Mulai sewa</th><td>{{ $rental->start_label }}</td></tr>
                        <tr><th>Kembali</th><td>{{ $rental->end_label }}</td></tr>
                        <tr><th>Lama sewa</th><td>{{ $rental->days }} hari</td></tr>
                        @if ($rental->bike)
                            <tr><th>Tarif / hari</th><td>{{ $rental->bike->price_label }}</td></tr>
                        @endif
                        <tr><th>Pembayaran</th><td>{{ $rental->payment_method }}</td></tr>
                    </tbody>
                </table>

                <div class="gw-receipt-total">
                    <span class="gw-mono">Total bayar</span>
                    <strong>{{ $rental->total_label }}</strong>
                </div>

                <div class="gw-note">
                    <span class="gw-mono d-block mb-1">Cara bayar (simulasi)</span>
                    {{ $instruction }}
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap justify-content-center gap-3 mt-5 gw-noprint">
            <button type="button" class="btn gw-btn gw-btn-orange" onclick="window.print()">Cetak struk</button>
            <a href="{{ route('rentals.index') }}" class="btn gw-btn gw-btn-dark">Riwayat sewa</a>
            <a href="{{ route('bikes.index') }}" class="btn gw-btn gw-btn-line">Sewa sepeda lain</a>
        </div>
    </div>
</section>

@endsection