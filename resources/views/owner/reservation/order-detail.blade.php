@extends('layouts.app')
@section('content')
  <div class="container col-4 mt-5">
    <div class="row">
      <div class="col">
        <div class="reservation-container">
        @foreach ($reservationDetails as $reservationDetail)
            <h3 class="reservation-label text-primary">Reservation Details</h3>
            <hr>
            <div class="reservation-value">
                <strong class="text-primary">Start Date:
                    {{ $reservationDetail->roomReservationItems[0]->start_date }}
                </strong>
            </div>
            <div class="reservation-value">
                <strong class="text-primary">End Date:
                     {{ $reservationDetail->roomReservationItems[0]->end_date }}
                </strong>
            </div>

            <div class="reservation-value">
                <strong class="text-primary">Total Persons:
                    {{ $reservationDetail->roomReservationItems[0]->total_persons }}
                </strong>
            </div>

            <div class="reservation-value">
                <strong class="text-primary">Total Rooms:
                    {{ $reservationDetail->roomReservationItems[0]->total_rooms }}
                </strong>
            </div>


            <div class="reservation-value">
                <strong class="text-primary">Status:
                    {{ $reservationDetail->status }}
                </strong>
            </div>

            <div class="mt-2">
                <h5>Customer Details</h5>
                <div class="reservation-value">
                    <strong class="text-primary">Name:
                        {{ $reservationDetail->roomReservationItems[0]->users->name }}
                    </strong>
                </div>
                <div class="reservation-value">
                    <strong class="text-primary">Email:
                        {{ $reservationDetail->roomReservationItems[0]->users->email }}
                    </strong>
                </div>
                <div class="reservation-value">
                    <strong class="text-primary">Address:
                        {{ $reservationDetail->roomReservationItems[0]->users->address_line_1 }}
                    </strong>
                </div>
            </div>
          <hr>
            <div class="reservation-value">
              <h5 class="text-primary">Total Amount:
                {{ $reservationDetails[0]->total_amount }}
              </h5>
            </div>
           <div>
                @csrf
                <a href="#" class="btn btn-primary mb-0"
               data-bs-toggle="modal" data-bs-target="#exampleModal">
                    View Room Details
                </a>

            </div>
            <div class="modal fade"
    id="exampleModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Room Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mt-0 pt-0">

                <section class="h-100" style="background-color: #eee;">
                    <div class="container h-100 py-5 mt-0">
                        <div class="row d-flex justify-content-center align-items-center">
                               @foreach ($reservationDetail->roomReservationItems as $roomReservationItem)

                                <div class="col-10">
                                    <div class="card rounded-3 mb-4">
                                        <div class="card-body p-4">
                                            <div class="row">
                                                <div class="col-md-2 col-lg-2 ">
                                                    <img
                                                    width="80"
                                                    src="{{ asset('storage/owner/hotel/room/' . $roomReservationItem->rooms->image) }}">
                                                </div>
                                                <div class="col-md-3 col-lg-3 col-xl-2 ">
                                            </div>
                                            <div class="col-md-3 col-lg-4">
                                                <h4 class="text-primary">
                                                    {{ $roomReservationItem->rooms->hotel->name}}
                                                </h4>
                                                <p class="mb-0">
                                                    {{ $roomReservationItem->rooms->price}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                            @endforeach

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

        </div>
      </div>
    </div>
  </div>
@endsection
