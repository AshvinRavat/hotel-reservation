@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{ route('index') }}" method="GET">
            @csrf
            <div class="row">
                <div class="col-6 mb-2">
                    <div class="form-group">
                        <label for="address_address">Location</label>
                        <input type="text"
                            id="address-input"
                            name="location"
                            value="{{ $location }}"
                            class="form-control map-input">
                        <input type="hidden" name="address_latitude" id="address-latitude" value="0" />
                        <input type="hidden" name="address_longitude" id="address-longitude" value="0" />
                    </div>
                </div>
                <div class="col-6 mb-2">
                    <div class="form-group">
                        <label for="number-of-guest">Number of Guest</label>
                        <input type="number"
                            id="number-of-guest"
                            name="number_of_guest"
                            class="form-control map-input">
                        <input type="hidden" name="address_latitude" id="address-latitude" />
                        <input type="hidden" name="address_longitude" id="address-longitude"/>
                    </div>
                </div>
            </div>
            <div class="row d-flex mb-4 mt-2">
                <div class="col-3">
                    <select class="form-select" name="category_id">
                        <option value="0" >Select Room Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(($category_id) == $category->id) >
                                    {{  $category->name }}
                                </option>
                            @endforeach
                    </select>
                </div>
                <div class="col-8">
                    <input type="text" id="datepicker" class="ms-2"  name="check_in"  value="{{ $check_in }}">
                     @error('check_in')
                         {{ $message }}
                     @enderror
                    <input type="text" id="datepicker1"  value="{{ $check_out }}"  name="check_out" >
                    <input type="submit" class="btn btn-primary ms-2" value="Search">
                    <a href="{{ route('index') }}" class="btn btn-dark ms-2">
                        Clear
                    </a>
                </div>
            </div>
        </form>
        <div id="address-map-container" style="width:100%;height:400px; ">
            <div style="width: 100%; height: 100%" id="address-map"></div>
        </div>
    </div>
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
        
    </div>
@endsection