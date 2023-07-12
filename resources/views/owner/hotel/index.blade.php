@extends('layouts.owner-app')
@section('title')
Hotel
@endsection
@section('content')
    <div class="center-main mt-5 mb-5">
        <div class="menu">
            <div class="container">
                @include('layouts.alert')
                <div class="borrower-cnt business-cnt">
                    <div class="d-flex justify-content-between">
                            <h4 class="text-primary">Hotel Management</h4>
                            <div>
                                <a href="{{route('owner.hotel_create')}}" class="btn btn-primary mb-0">
                                    Add Hotels
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
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">City</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hotels as $hotel)
                    <tr>
                        <th>{{ $hotel->id }}</th>
                        <th>{{ $hotel->name }}</th>
                        <th>{{ $hotel->address_line_1}}</th>
                        <th>{{ $hotel->city }}</th>
                        <th>{{ $hotel->description }}</th>
                        <th>
                            <a href="{{ route('owner.hotel_edit', ['hotel' => $hotel->id]) }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                               <a class="text-danger"
                                 data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                <i class="fa fa-trash"></i>
                            </a>
                            @include('layouts.confirm-delete', [
                                'title' => 'Hotel',
                                'routeName' =>  'owner.hotel_delete',
                                'parmaterName' => 'hotel',
                                'id' => $hotel->id,
                            ])
                            </a>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
