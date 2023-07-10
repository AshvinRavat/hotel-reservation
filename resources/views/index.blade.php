@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row gy-5">
            @forelse ($rooms as $room)
                <div class="col-3">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset('storage/owner/hotel/room/' . $room->image) }}"
                            class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $room->hotel->name }}</h5>
                            <p class="card-text"><i class="fa fa-map-marker marker"></i>
                                {{ $room->hotel->address_line_1 }},
                                {{ $room->hotel->city }}
                            </p>
                            <div class="d-flex">
                                <p class="me-2"> Max Persons: {{ $room->max_occupancy }}</p>
                                <p> Total Rooms: {{ $room->total_rooms }}</p>
                            </div>
                            <div class="d-flex">
                                <p class="me-2">Price: {{ $room->price }}</p>
                            </div>
                            <p> Category: {{ $room->category->name }}</p>
                            <p class="card-text">
                                <i class="fa fa-star star-rating"></i>
                                <i class="fa fa-star star-rating"></i>
                                <i class="fa fa-star star-rating"></i>
                                <i class="fa fa-star star-rating"></i>
                            </p>
                            <a href="{{ route('customer_room_detail', ['room' => $room->id]) }}"
                                class="btn btn-primary">View Room Details</a>
                        </div>
                    </div>
                </div>
            @empty
                 <h3 class="text-center text-primary">No Rooms Found!!</h3>
            @endforelse
        </div>
    </div>
    <div class="container">
        {{ $rooms->links() }}
    </div>
@endsection