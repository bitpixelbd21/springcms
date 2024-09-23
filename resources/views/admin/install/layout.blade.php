<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>@if(isset($title)){{ $title }} - @endif {{river_settings('name')}}</title>

    <link rel="icon" type="image/png" href="{{river_settings('favicon')}}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons@latest/iconfont/tabler-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <link href="/river/admin/assets/css/tabler.min.css" rel="stylesheet"/>
    <link href="/river/admin/assets/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="/river/admin/assets/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="/river/admin/assets/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="/river/admin/assets/css/toastr.min.css">
    <link href="/river/admin/summernote-0.8.18-dist/summernote-bs5.min.css" rel="stylesheet">
    <link href="/river/admin/assets/css/demo.min.css" rel="stylesheet"/>
    <link href="/river/admin/assets/css/toastr.min.css" rel="stylesheet"/>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    {{--for laravel-file-manager--}}
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">--}}
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">--}}
{{--    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">--}}

    @routes

    @yield('css')

</head>
<body class="layout-fluid">
<div class="page page-center">
      @yield('content')
</div>

<!-- Libs JS -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
<script src="/river/admin/assets/js/toastr.min.js"></script>
<script src="/river/admin/summernote-0.8.18-dist/summernote-bs5.min.js"></script>
<script src="/river/admin/dynamic-form.js" defer></script>
<script src="https://cdn.tiny.cloud/1/49zw3h254k19bwnkh8tl02reg0pb5t75ndy9nm01w6afbql3/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Tabler Core -->
<script src="/river/admin/assets/js/tabler.min.js" defer></script>
<script src="/river/admin/assets/js/demo.min.js" defer></script>


@stack('scripts')
</body>
</html>
