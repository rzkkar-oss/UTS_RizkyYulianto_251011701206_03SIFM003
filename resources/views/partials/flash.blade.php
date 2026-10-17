@if (session('success'))
    <div class="gw-flash is-success gw-noprint" role="status">
        <div class="container">{{ session('success') }}</div>
    </div>
@endif

@if (session('error'))
    <div class="gw-flash is-error gw-noprint" role="alert">
        <div class="container">{{ session('error') }}</div>
    </div>
@endif