{{-- Kartu sepeda yang dipakai di beranda, daftar, dan "sepeda lainnya" --}}
<article class="gw-card h-100">
    <a href="{{ route('bikes.show', $bike) }}" class="gw-card-media" aria-label="Detail {{ $bike->brand }}">
        <img src="{{ $bike->image_url }}" alt="{{ $bike->brand }} {{ $bike->type }}" loading="lazy">
        <span class="gw-status {{ $bike->available ? 'is-on' : 'is-off' }}">
            {{ $bike->available ? 'Tersedia' : 'Disewa' }}
        </span>
    </a>

    <div class="gw-card-body">
        <p class="gw-tag">{{ $bike->type }}</p>
        <h3 class="gw-card-title">{{ $bike->brand }}</h3>

        <ul class="gw-specs">
            <li><span>Gigi</span>{{ $bike->gear_count }} speed</li>
            <li><span>Unit</span>{{ $bike->code }}</li>
        </ul>

        <div class="gw-card-foot">
            <div class="gw-price">{{ $bike->price_label }}<small>/hari</small></div>
            <a href="{{ route('bikes.show', $bike) }}" class="btn gw-btn gw-btn-dark btn-sm">Detail &rarr;</a>
        </div>
    </div>
</article>
