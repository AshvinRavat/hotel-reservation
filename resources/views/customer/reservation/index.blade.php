@extends('layouts.app')
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
                            @if ($roomReservation->status == "Approved")
                                <h5 class="text-success">Reservation is approved</h5>
                            @elseif ($roomReservation->status == "Rejected")
                             <h5 class="text-danger">Reservation is Rejected</h5>
                             @else
                                <h5 class="text-info">Reservation is Pending</h5>
                            @endif
                            <a class="btn btn-primary"
                                href="{{ route('customer.reservations_detail', ['reservation' => $roomReservation->id]) }}">
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