<!DOCTYPE html>
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

            @vite(['resources/scss/app.scss', 'resources/js/app.js'])

</head>
<body>
<!-- Start of kuui1214 Zendesk Widget script -->
<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=471b801b-edb6-4d98-9b5f-04cedb2da141"> </script>
<!-- End of kuui1214 Zendesk Widget script -->
<a id="top"></a>
<div class="main">

    @include('layouts.header')
    {{ $slot ?? '' }}
    @include('layouts.footer')
    <!-- Modal -->
    <div class="modal fade" id="idNotification" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Verify Your Id</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    You have got New Booking, It is in pending sate. Please verify your ID before the booking is confirmed. Go to the profile and verify your id.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
