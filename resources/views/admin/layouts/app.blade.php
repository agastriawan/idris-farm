<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Idris Farm</title>
    @include('admin.layouts.styles')
    @stack('styles')
</head>

<body data-menu-color="light" data-sidebar="default"> 
    <div id="app-layout">
        @include('admin.layouts.header')
        @include('admin.layouts.sidebar')

        <div class="content-page">
            <div class="content">
                <div id="overlay" class="overlay" style="display:none;"></div>
                <div id="loader" class="loader" style="display:none;"></div>
                @yield('content')
            </div>
        </div>
    </div>

    @include('admin.layouts.scripts')
    @stack('scripts')
</body>

</html>
