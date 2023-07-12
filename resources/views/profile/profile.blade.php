@extends('layouts.app')
@section('content')
    <div class="center-main mt-5">
        <div class="menu">
            <div class="container">
                <form action="{{route('profile.update')}}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="borrower-cnt business-cnt">
                        <div class="d-flex justify-content-between">
                            <h4 class="text-primary">My Profile</h4>
                            <div>
                                <a href="{{route('profile.delete_index')}}" class="btn btn-danger mb-0">
                                    Delete my account
                                </a>
                            </div>
                        </div>
                        @include('layouts.alert')
                        <fieldset>
                            <div class="business-detail pt-4" id="prefill_address">
                                <div class=" mb-4">
                                    <div class="row">
                                        <div class="col-sm-6 mb-sm-0 mb-4">
                                            <label for="first-name" class="form-label">
                                                First Name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                   class="form-control @error('first_name') is-invalid @enderror"
                                                   id="first-name"
                                                   name="first_name"
                                                   value="{{old('first_name',$user->first_name)}}">
                                            @error('first_name')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="last-name" class="form-label">
                                                Last Name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                   class="form-control @error('last_name') is-invalid @enderror"
                                                   id="last-name"
                                                   name="last_name"
                                                   value="{{old('last_name',$user->last_name)}}">
                                            @error('last_name')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="row">
                                        <div class="col-sm-6 mb-sm-0 mb-4">
                                            <label for="email" class="form-label">
                                                Email Address
                                            </label>
                                            <input type="text"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   id="email"
                                                   name="email"
                                                   value="{{old('email',$user->email)}}">
                                            @error('email')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                            <span class="text-muted">
                                                <strong>Note:</strong>
                                                If you change email, you will need to verify it and your account will be locked until email is verified.</span>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="profile-picture" class="form-label">Profile Picture</label>
                                            <input type="file"
                                                   class="form-control @error('profile') is-invalid @enderror"
                                                   id="profile-picture"
                                                   name="profile_picture">
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