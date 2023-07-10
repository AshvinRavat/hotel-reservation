@extends('layouts.owner-app')
@section('title')
-Room
@endsection
@section('content')
<div class="center-main mt-5">
    <div class="menu">
        <div class="container">
            <form action="{{route('owner.room_store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="borrower-cnt business-cnt">
                    <div class="d-flex justify-content-between">
                        <h4 class="text-primary">Room Management</h4>
                    </div>
                    <div class="business-detail pt-4" id="prefill_address">
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-sm-6 mb-sm-0 mb-4">
                                    <label for="hotel-id" class="form-label">
                                        Select Hotel<span class="text-danger">*</span>
                                    </label>
                                    <select id="hotel-id" class="form-control @error('hotel_id') is-invalid @enderror"
                                        name="hotel_id">
                                        <option value="">Select Hotel</option>
                                        @foreach ($hotels as $hotel)
                                        <option value="{{ $hotel->id }}"
                                            @selected(old('hotel_id')==$hotel->id)>
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
                                    <input class="form-control @error('room_number') is-invalid @enderror"
                                        id="room_number" name="room_number" value="{{old('room_number')}}">
                                    @error('room_number')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col-sm-6 mb-sm-0 mb-4">
                                    <label for="price" class="form-label">
                                        Price<span class="text-danger">*</span>
                                    </label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                                        id="price" name="price" value="{{old('price')}}">
                                    @error('price')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-sm-0 mb-4">
                                    <label for="max-occupancy" class="form-label">
                                        Maximum Occupancy:(Persons per room)
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select id="max-occupancy"
                                        class="form-control @error('max_occupancy') is-invalid @enderror"
                                        name="max_occupancy">
                                        <option value="">Select Occupancy</option>
                                        <option @selected(old('max_occupancy')==2)>
                                            2
                                        </option>
                                        <option @selected(old('max_occupancy')==4)>4</option>
                                    </select>
                                    @error('max_occupancy')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col-sm-6 mb-sm-0 mb-4">
                                    <label for="total-rooms" class="form-label">
                                        Total Rooms:<span class="text-danger">*</span>
                                    </label>
                                    <input type="number" class="form-control @error('total_rooms') is-invalid @enderror"
                                        id="total-rooms" name="total_rooms" value="{{old('total_rooms')}}">
                                    @error('total_rooms')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-sm-0 mb-4">
                                    <label for="category-id" class="form-label">
                                        Room Category
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select id="category-id"
                                        class="form-control @error('category_id') is-invalid @enderror"
                                        name="category_id">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected(old('category_id')==$category->
                                            id)>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 mb-sm-0 pb-3">
                                <label for="description" class="form-label">
                                    Description
                                </label>
                                <textarea type="text" class="form-control @error('description') is-invalid @enderror"
                                    id="description" name="description">
                                            {{old('description')}}
                                    </textarea>
                                @error('description')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-sm-12">
                                <label for="image" class="form-label">Image</label>
                                <span class="text-danger">*</span>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                                    name="image">
                                <span class="f-size-12 text-primary">
                                    (Image allow up to 5 MB)
                                </span>
                                @error('image')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('owner.room_index') }}" class="btn btn-white">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
