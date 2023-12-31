@extends('layouts.owner-app')
@section('title')
Hotel
@endsection
@section('content')
    <div class="center-main mt-5">
        <div class="menu">
            <div class="container">
                <form action="{{route('owner.hotel_update', ['hotel' => $hotel->id])}}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="borrower-cnt business-cnt">
                        <div class="d-flex justify-content-between">
                            <h4 class="text-primary">Hotel Management</h4>
                        </div>
                        <fieldset>
                            <div class="business-detail pt-4" id="prefill_address">
                                <div class="mb-4">
                                    <div class="row">
                                        <div class="col-sm-6 mb-sm-0 mb-4">
                                            <label for="name" class="form-label">
                                                Name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   id="name"
                                                   name="name"
                                                   value="{{old('name', $hotel->name)}}">
                                            @error('name')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6 mb-sm-0 mb-4">
                                                <label for="description" class="form-label">
                                                    Description
                                                </label>
                                                <textarea id="description"
                                                    class="form-control @error('description') is-invalid @enderror"
                                                    name="description"
                                                       >{{old('description', $hotel->description)}}
                                                </textarea>
                                                @error('description')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        <div class="row pb-3 pt-2">
                                            <div class="form-group col-6">
                                            <label for="address_input">Address Line 1</label>
                                            <input type="text"
                                                id="address-input"
                                                name="address_line_1"
                                                class="form-control map-input
                                                @error('address_line_1') is-invalid @enderror"
                                                value="{{ old('address_line_1', $hotel->address_line_1) }}">
                                            <input type="hidden"
                                                name="address_latitude"
                                                id="address-latitude"
                                                value="{{ old('address_latitude', $hotel->address_latitude)}} "/>
                                            <input type="hidden"
                                                name="address_longitude"
                                                id="address-longitude"
                                                value="{{ old('address_latitude', $hotel->address_longitude)}}" />
                                            @error('address_line_1')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                            <div class="col-sm-6 mb-sm-0 mb-4">
                                                <label for="address-line-2" class="form-label">
                                                    Address Line 2
                                                </label>
                                                <input
                                                    class="form-control @error('address_line_2') is-invalid @enderror"
                                                    id="address-line-2"
                                                    name="address_line_2"
                                                    value="{{old('address_line_2', $hotel->address_line_2)}}">

                                                @error('address_line_2')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 mb-sm-0 mb-4">
                                                <label for="city" class="form-label">
                                                    City <span class="text-danger">*</span>
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('city') is-invalid @enderror"
                                                    id="city"
                                                    name="city"
                                                    value="{{old('city', $hotel->city)}}" >
                                                @error('city')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6 mb-sm-0 mb-4">
                                                <label for="post-code" class="form-label">
                                                    Postal Code
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text"
                                                       class="form-control @error('post_code') is-invalid @enderror"
                                                       id="post-code"
                                                       name="post_code"
                                                       value="{{old('post_code', $hotel->post_code)}}">
                                                @error('post_code')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="image" class="form-label">Image</label>
                                                <input type="file"
                                                    class="form-control @error('image') is-invalid @enderror"
                                                    id="image"
                                                    name="image">
                                                <span class="f-size-12 text-primary">
                                                    (Image allow up to 2 MB)
                                                </span>
                                                @error('image')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6 mt-2 mb-3">
                                                 <img src="{{ asset('storage/hotel/images/' .
                                                    $hotel->image) }}"
                                                 height="100px">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('owner.hotel_index') }}" class="btn btn-white">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="address-map-container " style="width:100%;height:400px;">
        <div style="width: 100%; height: 100%" id="address-map" class="d-none"></div>
    </div>
@endsection
