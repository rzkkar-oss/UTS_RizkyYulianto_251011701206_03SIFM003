@extends('layouts.app')

@section('title', 'Riwayat Sewa')

@section('content')

<header class="gw-pagehead">
    <div class="container">
        <p class="gw-mono text-orange mb-3">// Transaksi</p>
        <h1 class="gw-display gw-pagehead-title mb-0">Riwayat sewa</h1>
    </div>
</header>

<section class="gw-section pt-5">
    <div class="container">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <p class="gw-mono text-secondary mb-0">
                {{ $rentals->count() }} transaksi &middot; {{ $rentals->where('status', 'aktif')->count() }} aktif
            </p>
            <a href="{{ route('bikes.index') }}" class="btn gw-btn gw-btn-dark btn-sm">+ Sewa sepeda</a>
        </div>

        @if ($rentals->isEmpty())
            <div class="gw-empty">
                <p class="gw-display mb-2">Belum ada sewa</p>
                <p class="mb-3">Pilih sepeda lalu isi form penyewaan, transaksinya akan tampil di sini.</p>
                <a href="{{ route('bikes.index') }}" class="btn gw-btn gw-btn-dark btn-sm">Lihat sepeda</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover gw-list align-middle">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Penyewa</th>
                            <th>Sepeda</th>
                            <th>Mulai</th>
                            <th class="text-end">Hari</th>
                            <th class="text-end">Total</th>
                            <th>Bayar</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rentals as $rental)
                            <tr>
                                <td class="gw-code">{{ $rental->rental_code }}</td>
                                <td>
                                    <strong>{{ $rental->renter_name }}</strong><br>
                                    <small class="text-secondary">{{ $rental->renter_phone }}</small>
                                </td>
                                <td>{{ $rental->bike?->brand ?? '-' }}<br><small class="text-secondary">{{ $rental->bike?->type }}</small></td>
                                <td class="text-nowrap">{{ $rental->start_label }}</td>
                                <td class="text-end">{{ $rental->days }}</td>
                                <td class="text-end text-nowrap"><strong>{{ $rental->total_label }}</strong></td>
                                <td>{{ $rental->payment_method }}</td>
                                <td><span class="gw-badge is-{{ $rental->status }}">{{ $rental->status }}</span></td>
                                <td class="text-end text-nowrap">
                                    <a href="{{ route('rentals.show', $rental) }}" class="btn gw-btn gw-btn-line btn-sm">Struk</a>
                                    @if ($rental->status === 'aktif')
                                        <form action="{{ route('rentals.finish', $rental) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Tandai sewa {{ $rental->rental_code }} sebagai selesai?')">
                                            @csrf
                                            <button type="submit" class="btn gw-btn gw-btn-dark btn-sm">Selesai</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</section>

@endsection