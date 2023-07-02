@extends('layouts.owner-app')
@section('title')
Hotel
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
                        <h4 class="text-primary">Hotel Management</h4>
                    </div>
                    @include('layouts.alert')
                    <table id="myTable" class="display">
                        <thead>
                            <tr>
                                <th>Column 1</th>
                                <th>Column 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 2</td>
                            </tr>
                            <tr>
                                <td>Row 2 Data 1</td>
                                <td>Row 2 Data 2</td>
                            </tr>
                        </tbody>
                    </table>        <tr>
                    
@include('layouts.alert')
@endsection

