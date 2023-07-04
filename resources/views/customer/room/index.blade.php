@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{ route('customer.hotel_rooms', ['hotel' => $hotel_id]) }}">
            <div class="row">
                <div class="d-flex align-items-center justify-content-start my-3">
                    <div>
                        <div class="bg-light shadow-sm">
                            <select name="category_id">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @selected( $category->id == $flirtedCategory)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('category_id')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
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
                        <input type="submit" class="btn btn-primary" value="Search Room">
                          <a href="{{route('customer.hotel_rooms', ['hotel' => $hotel_id]) }} " class="btn btn-dark">
                             Clear Search
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="container">
        <div class="row">
            @forelse ($rooms as $room)
            <div class="col">
                <div class="card" style="width: 18rem;">
                      <img src="{{ asset('storage/owner/hotel/room/' . $room->image) }}"
                        class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title text-primary">
                            {{ $room->hotel }}
                        </h5>
                         <p class="card-text">
                            Price: {{ 'INR '. $room->price }}
                        </p>
                        <p class="card-text">
                            Category: {{  $room->category }}
                        </p>
                        <a href="{{ route('customer.hotel_room_detail', ['room' => $room->id]) }}"
                              class="btn btn-primary">
                                View Details
                            </a>
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
