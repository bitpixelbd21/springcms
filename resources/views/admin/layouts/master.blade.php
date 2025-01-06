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
    <link href="/springcms/admin/assets/css/tabler.min.css" rel="stylesheet"/>
    <link href="/springcms/admin/assets/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="/springcms/admin/assets/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="/springcms/admin/assets/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="/springcms/admin/assets/css/toastr.min.css">
    <link href="/springcms/admin/summernote-0.8.18-dist/summernote-bs5.min.css" rel="stylesheet">
    <link href="/springcms/admin/assets/css/demo.min.css" rel="stylesheet"/>
    <link href="/springcms/admin/assets/css/toastr.min.css" rel="stylesheet"/>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    {{--for laravel-file-manager--}}
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">--}}
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">--}}
{{--    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">--}}

    @routes

    @yield('css')

</head>
<body class="layout-fluid">
<div class="page">

    @include('river::admin.layouts.sidebar')

    @include('river::admin.layouts.navbar')

    <div class="page-wrapper">
        <div class="container-xl">
            @yield('page-header')
        </div>
        <div class="page-body">
            @yield('content')
        </div>
        @include('river::admin.layouts.footer')
    </div>
    <input type="hidden" name="current_route_name" value="{{\Request::route()->getName()}}">
</div>

<!-- Libs JS -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
<script src="/springcms/admin/assets/js/toastr.min.js"></script>
<script src="/springcms/admin/summernote-0.8.18-dist/summernote-bs5.min.js"></script>
<script src="/springcms/admin/dynamic-form.js" defer></script>
<script src="https://cdn.tiny.cloud/1/49zw3h254k19bwnkh8tl02reg0pb5t75ndy9nm01w6afbql3/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Tabler Core -->
<script src="/springcms/admin/assets/js/tabler.min.js" defer></script>
<script src="/springcms/admin/assets/js/demo.min.js" defer></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/ckeditor.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/adapters/jquery.js"></script>
{{--<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>--}}

<script>
    //single image preview
    function readURL(input, imgControlName) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(imgControlName).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function singleImagePreview(e, preview) {
        $('#' + preview).closest('.pip').removeClass('d-none');
        var imgControlName = "#" + preview;
        readURL(e.target, imgControlName);
    }
    function removeSingleImage(ImgPreview,image) {
        $("#" + image).val("");
        $("#" + ImgPreview).attr("src", "");
        $('#' + ImgPreview).closest('.pip').addClass('d-none');
    }

    // article-editor
    $('.ckeditor').ckeditor({
        height: 400,
        filebrowserImageBrowseUrl: window.hp_route_prefix + '?type=Images',
        filebrowserImageUploadUrl: window.hp_route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
        filebrowserBrowseUrl: window.hp_route_prefix + '?type=Files',
        filebrowserUploadUrl: window.hp_route_prefix + '/upload?type=Files&_token={{csrf_token()}}',
    });

    // select2
    $(document).ready(function() {
        $('.select2').select2();
    });

</script>
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": 300,
        "hideDuration": 300,
        "timeOut": 1000,
        "extendedTimeOut": 1000,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>


@if (Session::has('warning'))
    <script>
        toastr.warning("{{ Session::get('warning') }}", 'Warning');
    </script>
@endif

@if (Session::has('message'))
    <script>
        toastr.info("{{ Session::get('message') }}", 'Info');
    </script>
@endif

@if (Session::has('success'))
    <script>
        toastr.success("{{ Session::get('success') }}", 'Success');
    </script>
@endif

@if (Session::has('error'))
    <script>
        toastr.error("{{ Session::get('error') }}", 'Error');
    </script>
@endif

<script>
    // add csrf token to ajax request
    $.ajaxSetup({
        headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

</script>

<script src="/vendor/laravel-filemanager/js/filemanager.min.js"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    window.hp_route_prefix = "/laravel-filemanager";
{{--    {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}--}}
</script>
<script>
    @if($errors->any())
    @foreach($errors->all() as $error)
    toastr.error('{{$error}}', 'Error', {
        closeButton:true,
        progressBar:true,
    });
    @endforeach
    @endif
</script>

<script>
    $(document).ready(function () {
       $('.generate-slug').on('input', function (e) {
           var $this = $(this);
           var title = $this.val();
           var slug = String(title)
               .normalize('NFKD') // split accented characters into their base characters and diacritical marks
               .replace(/[\u0300-\u036f]/g, '') // remove all the accents, which happen to be all in the \u03xx UNICODE block.
               .trim() // trim leading or trailing whitespace
               .toLowerCase() // convert to lowercase
               .replace(/[^a-z0-9 -]/g, '') // remove non-alphanumeric characters
               .replace(/\s+/g, '-') // replace spaces with hyphens
               .replace(/-+/g, '-'); // remove consecutive hyphens
           var name_slug = $this.data('slug-field');
           $('input[name="'+name_slug+'"]').val(slug)
       });
       
       $('.lfm-picker').filemanager('image', {prefix: window.hp_route_prefix});
    });
</script>

@stack('scripts')
</body>
</html>
