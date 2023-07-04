@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{ route('index') }}">
            @csrf
            <div class="row">
                <div class="d-flex align-items-center justify-content-start my-3">
                    <div>
                        <div class="bg-light shadow-sm">
                            <div class="input-group">
                                <input type="search" placeholder="Type Destination..."
                                    aria-describedby="button-addon1"
                                    class="form-control border-0 bg-light"
                                    name="search_item"
                                    value="{{ $searchedValue }}">
                                <div class="input-group-append">
                                    <button id="button-addon1"
                                        disabled
                                        class="btn btn-link text-primary">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div>
                            @error('search_item')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="ms-3 me-2">
                        <label for="start-date">Check In</label>
                    </div>
                    <div>
                        <input type="date"
                            class="form-control border-0 bg-light"
                            id="start-date"
                            name="">
                    </div>
                     <div class="ms-3 me-2">
                        <label for="end-date">Check Out</label>
                    </div>
                    <div>
                        <input type="date"
                        id="end-date"
                        class="form-control border-0 bg-light">
                    </div>
                    <div class="ms-4">
                        <input type="submit" class="btn btn-primary" value="Search Hotel">
                        <a href="{{ route('index') }}" class="btn btn-dark">
                             Clear Search
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="container">
        <div class="row gx-5 gy-5">
            @forelse ($hotels as $hotel )
            <div class="col">
                <div class="card" style="width: 18rem;">
                      <img src="{{ asset('storage/hotel/images/' . $hotel->image) }}"
                        class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $hotel->name }}</h5>
                         <p class="card-text"><i class="fa fa-map-marker marker"></i>
                            {{ $hotel->address_line_1 }},
                            {{ $hotel->city }}
                        </p>
                         <p class="card-text">
                            <i class="fa fa-star star-rating"></i>
                            <i class="fa fa-star star-rating"></i>
                            <i class="fa fa-star star-rating"></i>
                            <i class="fa fa-star star-rating"></i>
                        </p>
                        <a href="{{ route('customer.hotel_rooms', ['hotel' => $hotel->id]) }}"
                            class="btn btn-primary">View Rooms</a>
                    </div>
                </div>
            </div>
            @empty
                 <h3 class="text-center text-primary">No Hotels Found!!</h3>
            @endforelse
        </div>
    </div>
    <div class="container">
        {{ $hotels->links() }}
    </div>
@endsection