@extends('layouts.app')
@section('content')
    <div class="center-main mt-5">
        <div class="menu">
            <div class="container">
                <form action="{{route('become_owner')}}" method="POST">
                    @csrf
                    <div class="borrower-cnt business-cnt">
                        <div class="d-flex justify-content-between">
                            <h4 class="text-primary">Register as Owner</h4>
                        </div>
                        <span class="text-primary">(To become owner add Business details First)</span>
                        @include('layouts.alert')
                        <fieldset>
                            <div class="business-detail pt-4" id="prefill_address">
                                <div class="mb-4">
                                    <div class="row">
                                        <div class="">
                                            <label for="pan-number" class="form-label">
                                                PAN Number
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                   class="form-control @error('pan_number') is-invalid @enderror"
                                                   id="pan-number"
                                                   name="pan_number"
                                                   value="{{old('pan_number')}}">
                                            @error('pan_number')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row pb-3 pt-2">
                                        <div class="col-sm-6 mb-sm-0 mb-4">
                                            <label for="address-line-1" class="form-label">
                                                Address Line 1
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('address_line_1') is-invalid @enderror"
                                                id="address-line-1"
                                                name="address_line_1"
                                                value="{{old('address_line_1')}}">
                                            @error('address_line_1')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6 mb-sm-0 mb-4">
                                            <label for="address-line-2" class="form-label">
                                                Address Line 2
                                            </label>
                                            <input type="text"
                                                class="form-control @error('address_line_2') is-invalid @enderror"
                                                id="address-line-2"
                                                name="address_line_2"
                                                value="{{old('address_line_2')}}">
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
                                                value="{{old('city')}}" >
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
                                                   value="{{old('post_code')}}">
                                            @error('post_code')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection