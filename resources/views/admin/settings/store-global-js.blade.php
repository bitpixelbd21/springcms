@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')
<link rel="stylesheet" href="/river/admin/codemirror-5.65.2/lib/codemirror.css" />
<link rel="stylesheet" href="/river/admin/codemirror-5.65.2/addon/scroll/simplescrollbars.css" />
<link rel="stylesheet" href="/river/admin/codemirror-5.65.2/addon/fold/foldgutter.css" />

<style>
    .CodeMirror {
        height: 600px;
        overflow-y: scroll;
    }
</style>
@endsection

@section('page-header')
<x:river::header>
    <x-slot:title>
        Global JS
        </x-slot>

        <x-slot:breads>
            <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Global JS</a></li>
        </x-slot:breads>

        <x-slot:buttons>
            <!-- <a class="btn btn-primary d-none d-sm-inline-block" id="btn-add-new">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Add new
            </a> -->
        </x-slot:buttons>

</x:river::header>
@stop

@section('content')
<div class="container-xl">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title mb-4">Global jS </h4> -->
                    <form class="custom-validation" action="{{route('river.store-settings')}}" method="POST">
                        @csrf

                        {{-- <div class="form-group content"  id="content-{{\BitPixel\SpringCms\Models\RiverPage::CONTENT_TYPE_HTML}}">
                        <textarea name="global_js" id="content_type">{{ river_settings('global_js') }}</textarea>
                </div> --}}


                <div class="form-group">
                    <textarea name="global_js" id="code" cols="30" rows="50" class="form-control">{{ river_settings('global_js') }}</textarea>
                    {{-- <div id="editor" style="height: 500px;"></div>--}}
                </div>



                <div class="form-group row mb-0 float-right">
                    <div class="col-md-8 mt-4">
                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </form>





    </div>
</div>
@stop

@push('scripts')

<script src="/river/admin/codemirror-5.65.2/lib/codemirror.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/htmlmixed/htmlmixed.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/xml/xml.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/javascript/javascript.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/css/css.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/clike/clike.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/php/php.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/php/php.js"></script>
<script src="/river/admin/codemirror-5.65.2/addon/fold/foldcode.js"></script>
<script src="/river/admin/codemirror-5.65.2/addon/fold/xml-fold.js"></script>
<script src="/river/admin/codemirror-5.65.2/addon/fold/foldgutter.js"></script>
{{-- <script src="/river/admin/codemirror-5.65.2/addon/fold/brace-fold.js"></script>--}}
<script src="/river/admin/codemirror-5.65.2/addon/edit/matchbrackets.js"></script>
<script src="/river/admin/codemirror-5.65.2/addon/edit/matchtags.js"></script>
<script src="/river/admin/codemirror-5.65.2/addon/scroll/simplescrollbars.js"></script>

<script>
    var codeMirror = CodeMirror.fromTextArea(document.getElementById("code"), {
        lineNumbers: true,
        mode: "php",
        // theme: 'monokai',
        foldGutter: true,
        matchTags: {
            bothTags: true
        },
        gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"],
        extraKeys: {
            "Ctrl-Q": function(cm) {
                cm.foldCode(cm.getCursor());
            }
        },
    });
</script>



{{-- <script src="/river/admin/codemirror-5.65.2/lib/codemirror.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/htmlmixed/htmlmixed.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/xml/xml.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/javascript/javascript.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/css/css.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/clike/clike.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/php/php.js"></script>
<script>
    var code = CodeMirror.fromTextArea(document.getElementById("content_type"), {
            lineNumbers: true,
            mode: "php",
            theme: 'monokai'
        });
        $(document).ready(function() {
            $('#content_type').summernote();
        });
        // $(function() {
        //     $('#contentType').change(function(){
        //         $('.content').hide();
        //         $('#content-' + $(this).val()).show();
        //     });
        // });
</script> --}}

<script>
    function generateSlug() {
        // Get the value from the title input
        const title = document.getElementById('title').value.trim().toLowerCase();

        // Replace spaces with dashes and remove special characters
        const slug = title.replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');

        // Update the slug input field
        document.getElementById('slug').value = slug;
    }
</script>







<script>
    $(document).ready(function() {
        $('.dropify').dropify();
    });

    $('.btn-copy').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        var url = $this.data('url');
        navigator.clipboard.writeText(url);
    });
</script>
@endpush