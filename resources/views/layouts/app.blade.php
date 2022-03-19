<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#000000" />
    <meta
        name="description"
        content="Lorem ipsum"
    />

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    @yield('content')
</div>
</body>
@yield('scripts')
<script src="{{ asset('js/app.js') }}"></script>
</html>
