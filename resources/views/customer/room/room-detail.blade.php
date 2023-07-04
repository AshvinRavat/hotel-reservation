@extends('layouts.app')
@section('content')
  <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/owner/hotel/room/'. $room->image) }}" alt="Room Image" class="room-image">
            </div>
            <div class="col-md-6 text-primary">
                <h1>Room Details</h1>
                <p>Room Category: {{ $room->category }}</p>
                <p>Max Occupancy: {{ $room->max_occupancy }}</p>
                <p>Amenities: Wi-Fi, TV, Air Conditioning, Mini-Fridge</p>
                <p>Price : {{ $room->price }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col mb-5">
                <div class="booking-details">
                    <h2>Booking Details</h2>
                <form>
                    <div class="form-group">
                    <label for="check-in">Check-in Date:</label>
                    <input type="date" class="form-control" id="check-in" required>
                    </div>
                    <div class="form-group">
                    <label for="check-out">Check-out Date:</label>
                    <input type="date" class="form-control" id="check-out" required>
                    </div>
                    <div class="form-group">
                    <label for="guests">Number of Guests:</label>
                    <input type="number" class="form-control" id="guests" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Book Now</button>
                </form>
            </div>
        </div>
    </div>
  </div>
@endsection