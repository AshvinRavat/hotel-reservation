<div class="alert-group my-2">
    @if (session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('status') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

    @endif
    @if (session('error'))
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <i class="fas fa-ban me-2"></i>
            <div>
                {{ session('error') }}
            </div>
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
