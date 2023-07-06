<div class="modal fade"
    id="exampleModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Price Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mt-0 pt-0">

                <section class="h-100" style="background-color: #eee;">
                    <div class="container h-100 py-5 mt-0">
                        <div class="row d-flex justify-content-center align-items-center">
                            @foreach ($roomsDetails as $roomsDetail)
                                <div class="col-10">
                                    <div class="card rounded-3 mb-4">
                                        <div class="card-body p-4">
                                            <div class="row">
                                                <div class="col-md-2 col-lg-2 ">
                                                    <img
                                                    width="80"
                                                    src="{{ asset('storage/owner/hotel/room/' . $roomsDetail->image) }}">
                                                </div>
                                                <div class="col-md-3 col-lg-3 col-xl-2 ">
                                            </div>
                                            <div class="col-md-3 col-lg-4">
                                                <h4 class="text-primary">{{ $roomsDetail->hotel }}</h4>
                                                <p class="mb-0">
                                                    {{ $roomsDetail->price }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
