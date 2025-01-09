<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('includes.styles')
    @stack('custom.styles')
</head>

<body class="bg-gray-100">
    @include('layouts.header')
    @include('layouts.nav')
    @yield('content')
    @include('layouts.footer')
    @stack('custom-scripts')
</body>

</html>
