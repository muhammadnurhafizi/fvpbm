<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') | {{ env('APP_NAME', 'Farmasi Veteran') }}</title>

        @include('layouts.styles')

    </head>
    <body class="bg-light">

        @include('layouts.header')

        @include('layouts.main')
            
        @include('layouts.scripts')
    </body>
</html>
