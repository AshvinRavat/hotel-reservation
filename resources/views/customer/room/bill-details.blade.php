@extends('layouts.app')
@section('content')
  <div class="container col-4">
    <div class="row">
      <div class="col">
        <div class="reservation-container">
          <h3 class="reservation-label text-primary">Reservation Details</h3>
          <hr>
          <div class="reservation-value">
            <strong class="text-primary">Start Date:</strong> {{ $billDetails['start_date'] }}
          </div>
          <div class="reservation-value">
            <strong class="text-primary">End Date:</strong> {{ $billDetails['end_date'] }}
          </div>

          <div class="reservation-value">
            <strong class="text-primary">Total Days:</strong> {{ $billDetails['total_days'] }}
          </div>

          <div class="reservation-value">
            <strong class="text-primary">Total Persons:</strong> {{ $billDetails['total_persons'] }}
          </div>

          <div class="reservation-value">
            <strong class="text-primary">Rooms:</strong> {{ $billDetails['total_rooms'] }}
          </div>

          @if ($billDetails['total_rooms']  == 1)
            <div class="reservation-value">
              <strong class="text-primary">Price:</strong> {{ $billDetails['price'] }}
            </div>
          @endif

          @if ($billDetails['total_rooms'] > 1)
            <div class="reservation-value">
              <strong class="text-primary">Total Days : {{ $billDetails['total_days']}}
                  @php
                  $totalAmount = $billDetails['total_amount']
                @endphp
                 * Total Room Prices :</strong>
              {{ $billDetails['total_amount_by_rooms'] }}
              <p>(Total amount is count base on total rooms multiply with days)</p>
            </div>
             <a href="#"  data-bs-toggle="modal" data-bs-target="#exampleModal">View Room & Price Details</a>
          @endif
          <hr>
            <div class="reservation-value">
              <h5 class="text-primary">Total Amount:
                @if ($billDetails['total_rooms'] > 1)
                {{ $totalAmount }}
                @else
                {{ $billDetails['total_amount'] }}
                @endif
              </h5>
            </div>
           <div>
                @csrf
                <a href="{{ route('customer.confirm_reservation')}}" class="btn btn-primary mb-0"
               >
                    Confirm & Reserve
                </a>
                <a href="{{route('index')}}" class="btn btn-danger mb-0">
                    Cancel
                </a>
            </div>
        </div>
      </div>
    </div>
  </div>

  @if ($billDetails['total_rooms'] > 1)
    @include('customer.room.price-detail', ['$roomsDetails', $billDetails['total_rooms'], $totalAmount ])
  @endif
@endsection
