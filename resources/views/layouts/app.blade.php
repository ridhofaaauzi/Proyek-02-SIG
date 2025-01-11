<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Peta Tingkat Kelahiran Kota Depok')</title>

    <meta name="description" content="@yield('description', 'Visualisasi tingkat kelahiran berdasarkan wilayah Kota Depok dengan peta interaktif, data populasi, area, dan statistik kelahiran.')">
    <meta name="keywords"
        content="Peta Depok, tingkat kelahiran, Kota Depok, statistik kelahiran, peta interaktif, data kelahiran">
    <meta name="author" content="Irsal Fathi Farhat & Teams">

    <meta property="og:title" content="@yield('og:title', 'Peta Tingkat Kelahiran Kota Depok')">
    <meta property="og:description" content="@yield('og:description', 'Telusuri peta tingkat kelahiran Kota Depok dengan visualisasi data statistik interaktif.')">
    <meta property="og:image" content="@yield('og:image', asset('images/og-peta-depok-square.png'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="@yield('og:type', 'website')">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter:title', 'Peta Tingkat Kelahiran Kota Depok')">
    <meta name="twitter:description" content="@yield('twitter:description', 'Telusuri peta tingkat kelahiran Kota Depok dengan visualisasi data statistik interaktif.')">
    <meta name="twitter:image" content="@yield('twitter:image', asset('images/og-peta-depok-square.png'))">

    @include('includes.styles')
    @stack('custom.styles')
</head>


<body class="relative bg-gray-100 min-h-screen">
    <div
        class="absolute inset-0 z-[-2] h-full w-screen bg-blue-200 bg-[radial-gradient(#ffffff33_1px,#eff6ff_1px)] bg-[size:20px_20px] bg-center">
    </div>
    @include('layouts.header')
    @yield('content')
    @include('layouts.footer')
    @include('includes.scripts')
    @stack('custom-scripts')
</body>

</html>
