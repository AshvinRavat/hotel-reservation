@extends('layouts.owner-app')
@section('title')
Room
@endsection
@section('content')
    <div class="center-main mt-5">
        <div class="menu">
            <div class="container">
                <form action="{{route('owner.hotel_store')}}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="borrower-cnt business-cnt">
                        <div class="d-flex justify-content-between">
                            <h4 class="text-primary">Room Management</h4>
                        </div>
                        <fieldset>
                            <div class="business-detail pt-4" id="prefill_address">
                                <div class="mb-4">
                                    <div class="row">
                                        <div class="col-sm-6 mb-sm-0 mb-4">
                                            <label for="hotel-id" class="form-label">
                                                Select Hotel
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select
                                                class="form-control @error('hotel_id') is-invalid @enderror"
                                                id="hotel-id"
                                                name="hotel_id">
                                                <option>Select Hotel</option>
                                                @foreach ($hotels as $hotel)
                                                    <option value="{{ $hotel->id }}">
                                                        {{$hotel->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('hotel_id')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                            <div class="col-sm-6 mb-sm-0 mb-4">
                                                <label for="room_number" class="form-label">
                                                    Room Number
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input
                                                    class="form-control @error('room_number') is-invalid @enderror"
                                                    id="room_number"
                                                    hotel_id="room_number"
                                                    value="{{old('room_number')}}">
                                                @error('room_number')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-sm-6 mb-sm-0 mb-4">
                                                <label for="price" class="form-label">
                                                   Price<span class="text-danger">*</span>
                                                </label>
                                                <input type="number"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    id="price"
                                                    hotel_id="price"
                                                    value="{{old('price')}}">
                                                @error('price')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6 mb-sm-0 mb-4">
                                                <label for="max-occupancy" class="form-label">
                                                    Maximum Occupancy:(Persons per room)<span class="text-danger">*</span>
                                                </label>
                                                <select
                                                class="form-control @error('max_occupancy') is-invalid @enderror"
                                                    id="max-occupancy"
                                                    hotel_id="max_occupancy">
                                                    <option>Select Occupancy</option>
                                                    <option>2</option>
                                                    <option>4</option>
                                                </select>
                                                @error('max_occupancy')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>

                                            <div class="col-sm-12 mb-sm-0 mb-4">
                                                <label for="description" class="form-label">
                                                    Description
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <textarea type="text"
                                                       class="form-control @error('description') is-invalid @enderror"
                                                       id="description"
                                                       hotel_id="description"
                                                       >
                                                       {{old('description')}}
                                                </textarea>
                                                @error('description')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                                 <div class="col-sm-12">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file"
                                                   class="form-control @error('image') is-invalid @enderror"
                                                   id="image"
                                                   hotel_id="image">
                                            <span class="f-size-12 text-primary">
                                                (Image allow up to 2 MB)
                                            </span>
                                            @error('profile')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
