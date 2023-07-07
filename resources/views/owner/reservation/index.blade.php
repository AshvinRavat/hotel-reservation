@extends('layouts.owner-app')
@section('content')
    <div class="container">
        <div class="row">
            @forelse ($roomReservations  as $key => $roomReservation)
                <div class="col-3">
                    <div class="card" style="width: 18rem;">
                        @foreach ($roomReservation->roomReservationItems as $roomReservationItem)
                            <img src="{{ asset('storage/hotel/images/' . $roomReservationItem->rooms->hotel->image) }}"
                            class="card-img-top">
                        @break
                        @endforeach
                        <div class="card-body">
                            <h5 class="card-title text-primary">
                                @foreach ($roomReservation->roomReservationItems as $roomReservationItem)
                                    {{ $roomReservationItem->rooms->hotel->name }}
                                @break
                                @endforeach
                            </h5>
                            <div class="my-2">
                                @foreach ($roomReservation->roomReservationItems as $roomReservationItem)
                                    <div class="my-2">
                                        <p>Check in: {{ $roomReservationItem->start_date }}</p>
                                        <p>Check out: {{ $roomReservationItem->end_date }}</p>
                                    </div>
                                @break
                                @endforeach
                            </div>
                            </p>
                            <p>Status : {{ $roomReservation->status }}</p>
                            <p>Total Amount : {{ $roomReservation->total_amount }}</p>
                            <div class="mb-2 d-flex">
                                @if ($roomReservation->status == "Pending")
                                    <form action="{{ route('owner.reservations_update_reservation_status') }}
                                    " method="post">
                                        @csrf
                                        <input type="hidden"
                                            name="reservation_id"
                                            value="{{ $roomReservation->id }}">
                                        <button
                                            type="submit"
                                            name="status"
                                            value="Approved"
                                        class="btn btn-success me-3">
                                        Accept
                                    </button>
                                    </form>
                                    <form action="{{ route('owner.reservations_update_reservation_status') }}
                                    " method="post">
                                        @csrf
                                        <input type="hidden"
                                            name="reservation_id"
                                            value="{{ $roomReservation->id }}">
                                        <button type="submit"
                                            name="status"
                                            value="Rejected"
                                            class="btn btn-danger">
                                            Reject
                                        </button>
                                    </form>
                                @elseif ($roomReservation->status == "Approved")
                                    <h6 class="text-success">
                                        {{ $roomReservation->status}} On
                                        {{ $roomReservation->updated_at }}
                                    </h6>
                                @else
                                    <h6 class="text-danger">{{ $roomReservation->status}} On
                                        {{ $roomReservation->updated_at }}
                                    </h6>
                                @endif
                            </div>
                            <a class="btn btn-primary"
                                href="{{ route('owner.reservations_order_detail', ['reservation' => $roomReservation->id]) }}">
                                View More Details
                            </a>

                        </div>
                    </div>
                </div>
            @empty
                 <h3 class="text-center text-primary">No Reservations Found!!</h3>
            @endforelse
        </div>
    </div>
@endsection