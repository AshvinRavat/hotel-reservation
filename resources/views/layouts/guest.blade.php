<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    </head>
    <body>
    <div class="login-page d-flex align-items-center h-100 py-4">
        <div class="container pt-5">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-md-6 col-12 mx-auto">
                    <div class="login-page-inner">
                          {{ $slot ?? '' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>
