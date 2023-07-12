<div class="alert-group my-2">
    @if (session('status') or session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') ?? session('status') ?? session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-ban me-2"></i>
                {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('warning'))
        <div class="alert alert-warning d-flex align-items-center" role="alert">
            <i class="fas fa-check me-2"></i>
            <div>
                {{ session('warning') }}
            </div>
        </div>
    @endif
</div>
