@extends('layouts.app')
@section('content')
<div class="center-main">
        <div class="menu">
            <div class="container mt-5">
                    <div class="borrower-cnt business-cnt">
                        <h4 class="pb-3">Delete Account</h4>
                        <fieldset>
                            <form action="{{ route('profile.destroy') }}" method="post">
                                @csrf
                            <div class="business-detail" id="prefill_address">
                                <div class=" mb-4">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label for="delete_text" class="form-label"> Enter Password
                                                <span class="text-danger">*</span></label>
                                            <input type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   id="delete_text"
                                                   name="password">
                                            @error('password')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </fieldset>
                            <div class="text-center">
                                <button type="submit" class="btn btn-danger mb-5" id="delete_confirmation">Delete my Account</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
@endsection