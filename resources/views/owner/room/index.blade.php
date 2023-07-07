@extends('layouts.owner-app')
@section('title')
room
@endsection
@section('content')
    <div class="center-main mt-5 mb-5">
        <div class="menu">
            <div class="container">
                @include('layouts.alert')
                <div class="borrower-cnt business-cnt">
                       <div class="d-flex justify-content-between">
                            <h4 class="text-primary">Room Management</h4>
                            <div>
                                <a href="{{route('owner.room_create')}}" class="btn btn-primary mb-0">
                                    Add Rooms
                                </a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <table class="table display" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Hotel</th>
                    <th scope="col">Room Number</th>
                    <th scope="col">Price</th>
                    <th scope="col">Max Occupancy</th>
                    <th scope="col">Total Rooms</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                    <tr>
                        <th>{{ $room->id }}</th>
                        <th>{{ $room->hotel }}</th>
                        <th>{{ $room->room_number }}</th>
                        <th>{{ $room->price }}</th>
                        <th>{{ $room->max_occupancy }}</th>
                        <th>{{ $room->total_rooms }}</th>
                        <th>{{ $room->description }}</th>
                        <th>
                            <a href="{{ route('owner.room_edit', ['room' => $room->id]) }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                               <a class="text-danger"
                                 data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                <i class="fa fa-trash"></i>
                            </a>
                            @include('layouts.confirm-delete', [
                                'title' => 'Room',
                                'routeName' =>  'owner.room_delete',
                                'parmaterName' => 'room',
                                'id' => $room->id,
                            ])
                            </a>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
