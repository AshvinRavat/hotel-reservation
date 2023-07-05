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
            <strong class="text-primary">Price:</strong> {{ $billDetails['price'] }}
          </div>
          <div class="reservation-value">
            <strong class="text-primary">Total Rooms:</strong> {{ 1 }}
          </div>
           <div class="reservation-value">
            <strong class="text-primary">Total Persons:</strong> {{ $billDetails['total_persons'] }}
          </div>
           <div class="reservation-value">
            <strong class="text-primary">Total Days:</strong> {{ $billDetails['total_days'] }}
          </div>
          <hr>
          <div class="reservation-value d-flex justify-content-between">
            <h4 class="total-label text-primary">Total Amount: {{ $billDetails['total_amount'] }}</h4>
            <span class="total-value text-primary"></span>
          </div>
           <div>
                @csrf
                <a href="{{route('customer.confirm_reservation')}}" class="btn btn-primary mb-0">
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


@endsection