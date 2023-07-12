 <div class="col-xl-6">
    <div class="card-body p-0">
        <div class="modal fade"
            id="staticBackdrop"
            data-bs-backdrop="static"
            data-bs-keyboard="false"
            tabindex="-1"
            aria-labelledby="staticBackdropLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            Delete {{ $title }}
                        </h5>
                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-hidden="true">
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="m-0">
                            Are You Sure to Delete  {{ $title }} ?
                        </p>
                    </div>
                    <div class="modal-footer">
                    <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Close
                    </button>
                    <form action="{{ route($routeName, [$parmaterName => $id]) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            Confirm
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
