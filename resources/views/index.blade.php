@extends('layouts.app')
@section('content')
<div class="container d-flex justify-content-center">
    <div class="row">
        @foreach ($hotels as $hotel)
            
        <div class="col-md-4">
            <div class="card">
                <div> <img src="{{ asset('storage/hotel/images/' . 
                $hotel->image) }}" class="img-responsive image"> </div>
                <p class="rating">9.2</p>
                <div class="card-body">
                    <h5 class="card-title">
                        {{ $hotel->name }}
                    </h5>
                    <p class="card-text"><i class="fa fa-map-marker marker"></i>
                         {{ $hotel->address_line_1 }}</p>
                    <p class="card-text"><i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i></p>
                    <p class="card-text">$ 1,399</p>
                    <a class="btn btn-primary">View Hotel</a>
                </div>
            </div>
        </div>
        @endforeach

        
    </div>
</div>
@endsection