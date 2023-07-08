@extends('layouts.app')
@section('content')
  <div class="container">
     @include('layouts.alert')
     <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/owner/hotel/room/'. $roomDetail->image) }}" alt="Room Image" class="room-image">
        </div>
        <div class="col-md-6 text-primary">
            <h1>Room Details</h1>
            <h5>{{ $roomDetail->hotel->name }}</h5>
            <p> Location <i class="fa fa-map-marker marker"></i>
                : {{ $roomDetail->hotel->address_line_1 }}, {{$roomDetail->hotel->city}}</p>
            <p class="pt-2">Room Category: {{ $roomDetail->category->name }}</p>
            <p>Max Occupancy: {{ $roomDetail->max_occupancy }}</p>
            <p>Total Rooms: {{ $roomDetail->total_rooms }}</p>
            <p>Price : {{ $roomDetail->price }}</p>
            <p>About : {{ $roomDetail->description }}</p>
        </div>
    </div>
        <div class="row">
            <div class="col mb-5">
                <div class="booking-details">
                    <h2>Booking Details</h2>
                    <form action="{{ route('customer.reservation') }}" method="post">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $roomDetail->id }}">
                        <input type="hidden" name="price" value="{{ $roomDetail->price }}">
                        <input type="hidden" name="max_occupancy" value="{{ $roomDetail->max_occupancy }}">
                        <input type="hidden" name="category_id" value="{{ $roomDetail->category_id }}">
                        <div class="form-group">
                        <label for="check-in">Check-in Date:</label>
                        <input type="date"
                            class="form-control
                            @error('start_date')
                                is-invalid
                            @enderror"
                            id="check-in"
                            name="start_date"
                            value="{{ old('start_date') }}"
                            >
                            @error('start_date')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                        <label for="check-out">Check-out Date:</label>
                        <input type="date"
                            class="form-control
                            @error('end_date')
                                is-invalid
                            @enderror"
                            id="check-out"
                            name="end_date"
                            value="{{ old('end_date') }}"
                            >
                            @error('end_date')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                        <label for="guests">Number of Guests:</label>
                        <input type="number"
                        class="form-control
                        @error('total_persons')
                            is-invalid
                        @enderror"
                        id="guests"
                        name="total_persons"
                        value="{{ old('total_persons') }}"
                        >
                        @error('total_persons')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Book Now</button>
                    </form>
            </div>
        </div>
    </div>
  </div>
@endsection