@extends('layouts.app')
@section('content')
    <div class="center-main">
        <div class="menu">
            <div class="container mt-5">
                @include('layouts.alert')
                <form action="{{ 'password-update' }}" method="POST">
                    @csrf
                    <div class="borrower-cnt business-cnt">
                        <h4 class="pb-3 text-primary">Change Password</h4>
                        <fieldset>
                            <div class="business-detail" id="prefill_address">
                                <div class=" mb-4">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label for="old_password" class="form-label"> Old Password <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="password"
                                                       class="form-control @error('old_password') is-invalid @enderror"
                                                       id="old_password" placeholder=""
                                                       name="old_password">

                                                @error('password')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="password" class="form-label"> New Password <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       id="new_password" placeholder=""
                                                       name="password">

                                                @error('password')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="password_confirmation" class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="password"
                                                       class="form-control @error('password_confirmation') is-invalid @enderror"
                                                       id="new_password_confirmation" placeholder=""
                                                       name="password_confirmation">

                                                @error('password_confirmation')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection