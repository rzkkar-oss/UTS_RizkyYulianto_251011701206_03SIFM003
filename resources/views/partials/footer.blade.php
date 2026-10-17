@php
    $ticker = \App\Models\Bike::orderBy('id')->get();
@endphp

@if ($ticker->isNotEmpty())
<div class="gw-ticker" aria-label="Daftar sepeda">
    <div class="gw-ticker-track">
        @for ($i = 0; $i < 2; $i++)
            <div class="gw-ticker-group" @if ($i === 1) aria-hidden="true" @endif>
                @foreach ($ticker as $bike)
                    <a href="{{ route('bikes.show', $bike) }}" class="gw-ticker-item">
                        <strong>{{ $bike->brand }}</strong>
                        <span>{{ $bike->type }}</span>
                        <em>{{ $bike->price_label }}/hari</em>
                        <i class="gw-ticker-sep"></i>
                    </a>
                @endforeach
            </div>
        @endfor
    </div>
</div>
@endif

<footer class="gw-footer">
    <div class="container">
        <div class="row g-4 align-items-end">
            <div class="col-lg-6">
                <div class="gw-brand mb-3"><span class="gw-brand-mark"></span>GOWES</div>
                <p class="gw-footer-text mb-0">
                    Rental sepeda harian — dari MTB sampai sepeda listrik.
                    Proyek UTS Rekayasa Web, dibuat dengan Laravel, Blade, dan Bootstrap.
                </p>
            </div>
            <div class="col-lg-6">
                <ul class="gw-id list-unstyled mb-0">
                    <li><span>Nama</span>Rizky Yulianto</li>
                    <li><span>NIM</span>251011701206</li>
                    <li><span>Kelas</span>SIFM003</li>
                    <li><span>Kampus</span>Universitas Pamulang — Sistem Informasi S-1</li>
                </ul>
            </div>
        </div>
        <div class="gw-footer-bottom">
            <span>&copy; {{ now()->year }} GOWES Rental Sepeda</span>
            <span>UTS Rekayasa Web</span>
        </div>
    </div>
</footer>
