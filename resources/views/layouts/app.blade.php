<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Idris Farm')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        a,
        span,
        div,
        input,
        button,
        label,
        textarea,
        select {
            font-family: 'Poppins', sans-serif !important;
        }
    </style>

    {{-- Styles --}}
    @include('layouts.styles')
    @stack('styles')
</head>

<body>
    {{-- Preloader --}}
    @include('layouts.preloader')

    {{-- Header --}}
    @include('layouts.header')

    {{-- Main Content --}}
    {{-- <main> --}}
    @yield('content')
    {{-- </main> --}}

    {{-- Footer --}}
    @include('layouts.footer')

    {{-- Scripts --}}
    @include('layouts.scripts')
    @stack('scripts')
</body>

</html>
