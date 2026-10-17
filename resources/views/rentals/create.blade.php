@extends('layouts.app')

@section('title', 'Sewa ' . $bike->brand)

@section('content')

<header class="gw-pagehead">
    <div class="container">
        <p class="gw-mono text-orange mb-3">// Form penyewaan</p>
        <h1 class="gw-display gw-pagehead-title mb-0">Sewa {{ $bike->brand }}</h1>
    </div>
</header>

<section class="gw-section pt-5">
    <div class="container">
        <div class="row g-5">

            <div class="col-lg-5">
                <div class="gw-frame mb-4">
                    <img src="{{ $bike->image_url }}" alt="{{ $bike->brand }} {{ $bike->type }}">
                </div>

                <table class="table gw-table">
                    <tbody>
                        <tr><th>Merek</th><td>{{ $bike->brand }}</td></tr>
                        <tr><th>Tipe</th><td>{{ $bike->type }}</td></tr>
                        <tr><th>Jumlah gigi</th><td>{{ $bike->gear_count }} speed</td></tr>
                        <tr><th>Tarif sewa</th><td>{{ $bike->price_label }} / hari</td></tr>
                    </tbody>
                </table>

                <a href="{{ route('bikes.show', $bike) }}" class="btn gw-btn gw-btn-line mt-4">&larr; Kembali ke detail</a>
            </div>

            <div class="col-lg-7">
                @if ($errors->any())
                    <div class="gw-formalert mb-4" role="alert">
                        Ada isian yang perlu diperbaiki. Periksa kolom bertanda merah.
                    </div>
                @endif

                <form action="{{ route('rentals.store', $bike) }}" method="POST" id="rentalForm" novalidate>
                    @csrf

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="gw-label" for="rental_code">Kode sewa</label>
                            <input type="text" id="rental_code" class="form-control gw-field" value="Otomatis setelah pesan" readonly tabindex="-1">
                        </div>

                        <div class="col-md-6">
                            <label class="gw-label" for="start_date">Tanggal mulai sewa</label>
                            <input type="date" id="start_date" name="start_date"
                                   value="{{ old('start_date', now()->toDateString()) }}" min="{{ now()->toDateString() }}"
                                   class="form-control gw-field @error('start_date') is-invalid @enderror" required>
                            @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="gw-label" for="renter_name">Nama penyewa</label>
                            <input type="text" id="renter_name" name="renter_name" value="{{ old('renter_name') }}"
                                   class="form-control gw-field @error('renter_name') is-invalid @enderror"
                                   placeholder="Nama lengkap" maxlength="100" required>
                            @error('renter_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="gw-label" for="renter_phone">No. HP</label>
                            <input type="tel" id="renter_phone" name="renter_phone" value="{{ old('renter_phone') }}"
                                   class="form-control gw-field @error('renter_phone') is-invalid @enderror"
                                   placeholder="0812xxxxxxxx" maxlength="16" required>
                            @error('renter_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="gw-label" for="days">Jumlah hari sewa</label>
                            <div class="input-group gw-stepper">
                                <button type="button" class="btn gw-btn gw-btn-dark" data-step="-1" aria-label="Kurangi hari">&minus;</button>
                                <input type="number" id="days" name="days" value="{{ old('days', 1) }}" min="1" max="30"
                                       class="form-control gw-field text-center @error('days') is-invalid @enderror" required>
                                <button type="button" class="btn gw-btn gw-btn-dark" data-step="1" aria-label="Tambah hari">&plus;</button>
                            </div>
                            @error('days') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="gw-label" for="rate">Tarif per hari</label>
                            <input type="text" id="rate" class="form-control gw-field" value="{{ $bike->price_label }}" readonly tabindex="-1">
                        </div>

                        <div class="col-12">
                            <span class="gw-label">Metode pembayaran</span>
                            <div class="row g-3">
                                @foreach ($methods as $method => $note)
                                    <div class="col-6 col-md-4">
                                        <input type="radio" class="gw-pay-input" name="payment_method"
                                               id="pay{{ $loop->index }}" value="{{ $method }}"
                                               {{ old('payment_method', 'Tunai') === $method ? 'checked' : '' }}>
                                        <label for="pay{{ $loop->index }}" class="gw-pay">
                                            <strong>{{ $method }}</strong>
                                            <span>{{ $note }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('payment_method') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <div class="gw-total">
                                <p class="gw-mono">Total bayar</p>
                                <div class="gw-total-amount" id="totalAmount">{{ $bike->price_label }}</div>
                                <p class="gw-total-calc" id="totalCalc">{{ $bike->price_label }} &times; 1 hari</p>
                            </div>
                        </div>

                        <div class="col-12 d-flex flex-wrap gap-3">
                            <button type="submit" class="btn gw-btn gw-btn-orange btn-lg">Konfirmasi sewa</button>
                            <a href="{{ route('bikes.show', $bike) }}" class="btn gw-btn gw-btn-line btn-lg">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var price    = {{ (int) $bike->rent_price }};
    var daysEl   = document.getElementById('days');
    var amountEl = document.getElementById('totalAmount');
    var calcEl   = document.getElementById('totalCalc');

    function rupiah(n) { return 'Rp ' + n.toLocaleString('id-ID'); }

    function clampDays() {
        var d = parseInt(daysEl.value, 10);
        if (isNaN(d) || d < 1) d = 1;
        if (d > 30) d = 30;
        return d;
    }

    function update() {
        var d = clampDays();
        amountEl.textContent = rupiah(price * d);
        calcEl.textContent   = rupiah(price) + ' × ' + d + ' hari';
    }

    document.querySelectorAll('[data-step]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            daysEl.value = Math.min(30, Math.max(1, clampDays() + parseInt(btn.dataset.step, 10)));
            update();
        });
    });

    daysEl.addEventListener('input', update);
    daysEl.addEventListener('blur', function () { daysEl.value = clampDays(); update(); });

    update();
});
</script>
@endpush