<div class="card text-center">
    @if($title ?? null)
        <h5 class="card-header">{{ $title }}</h5>
    @endif
    <div class="card-body main-card">
        {{ $slot }}
    </div>
</div>
