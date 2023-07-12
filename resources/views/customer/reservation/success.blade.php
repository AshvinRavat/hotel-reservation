@extends('layouts.app')
@section('title')
Success
@endsection
@section('content')
    <div class="mt-5 text-center">
    <h1 class="text-primary text-center">Congratulations</h1>
    <h6 class="text-center text-primary mt-4">You made Reservation Request successfully,</h6>
    <h6 class="text-center text-primary mb-4">Please wait for official confirmation from the owner</h6>
    <a class="btn btn-primary" href="{{ route('customer.reservations_index') }}">View Reservation</a>
</div>
@endsection