<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>
        @if (isset($title))
            {{ $title }} -
        @endif {{ river_settings('name') }}
    </title>
    <meta content="@isset($meta_desc){{ $meta_desc }}@endisset" name="description">
    <meta content="@isset($meta_keywords){{ $meta_keywords }}@endisset" name="keywords">

    <link href="{{ river_settings('favicon') }}" rel="icon">
    <link href="{{ river_settings('favicon') }}" rel="apple-touch-icon">
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>

    @include('_cache.header')


    @yield('content')


    @include('_cache.footer')

</body>

</html>
