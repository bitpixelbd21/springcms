@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('page-header')
    <x:river::header>
            <x-slot:title>
            Edit Page
            </x-slot>

            <x-slot:breads>
                <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{route('river.template-pages.index')}}">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="">Edit Pages</a></li>
            </x-slot:breads>

            <x-slot:buttons>
                <a href="{{route('river.template-pages.index')}}" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0"/><path d="M5 12l6 6"/><path d="M5 12l6 -6"/></svg>
                    Back
                </a>
            </x-slot:buttons>

    </x:river::header>
@stop

@section('css')
    <link rel="stylesheet" href="/springcms/admin/codemirror-5.65.2/lib/codemirror.css" />
    <link rel="stylesheet" href="/springcms/admin/codemirror-5.65.2/addon/scroll/simplescrollbars.css" />
    <link rel="stylesheet" href="/springcms/admin/codemirror-5.65.2/addon/fold/foldgutter.css" />

    <style>
        .CodeMirror {
            height: 600px;
            overflow-y: scroll;
        }
    </style>
@endsection

@section('content')

    <div class="container-xl">
        <div class="row row-cards">
            @isset($active_version)
            @endisset
            <form action="{{route('river.template-pages.update', $file->id)}}" method="POST" id="form-code">
                <div class="row">

                        {{-- <div class="col-md-3">
                                <div class="input-icon">
                                    <input type="text" class="form-control" name="filename" value="{{$file->filename}}">
                                </div>

                        </div> --}}

                        <div class="col-md-3">
                            <div class="mb-3">
                                <div class="input-group">
                                  <input type="text" class="form-control" name="filename" value="{{$file->filename}}">
                                  {{-- <button type="button" class="btn">Save</button> --}}
                                  <input type="submit" class="btn" name="save_version" value="Save" />
                                  <button data-bs-toggle="dropdown" type="button" class="btn dropdown-toggle dropdown-toggle-split" aria-expanded="false"></button>
                                  <div class="dropdown-menu dropdown-menu-end" style="">
                                    {{-- <a class="dropdown-item" href="#">
                                       Save Without Version
                                    </a> --}}
                                    <input type="submit" class="btn dropdown-item" name="save_version" value="Save Without Version" />

                                  </div>
                                </div>
                              </div>
                        </div>

                        <div class="col-md-3">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        {{-- <button type="submit" class="btn btn-primary">Save</button> --}}
                                        <button type="button" class="btn btn-danger btn-delete">Delete</button>
                                        <button type="button" class="btn btn-secondary btn-preview">Preview</button>
                                        <a class="btn btn-link" href="{{ route('river.template-pages.index') }}"> Cancel</a>
                                    </div>
                                </div>
                        </div>

                        <div class="col-md-6" >
                            <div class="row">
                                <div class="col-md-4 dropdown">
                                    <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Select page</a>
                                    <div class="dropdown-menu">
                                        @foreach($pages as $f)
                                            <a class="dropdown-item @if($file->id == $f->id) active @endif"
                                               href="{{route('river.template-pages.edit', $f->id)}}">{{$f->filename}}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-5 dropdown">
                                    <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Versions</a>
                                    <div class="dropdown-menu">
                                        @php
                                        use Carbon\Carbon;
                                        @endphp
                                        @foreach($versions as $f)
                                          <div class="d-flex">
                                            <a class="dropdown-item"
                                               href="{{route('river.template-pages.edit', $file->id)}}?version={{$f->id}}">
                                               {{Carbon::parse($f->datetime)->format('j M, Y g:ia')}}

                                            </a>

                                          </div>

                                        @endforeach
                                    </div>

                                    {{-- <form action="{{route('river.template-pages-version-delete')}}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn" value="Delete All Versions" >

                                    </form> --}}
                                    @if(count($versions) > 0)
                                        <button type="button" class="btn delete-all-version">Delete All Version</button>
                                    @endif



                                </div>

                                {{-- <div class="col-md-4 dropdown">
                                    <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Delete Versions</a>
                                    <div class="dropdown-menu">

                                        @foreach($versions as $f)
                                            <a class="dropdown-item"
                                               href="">
                                               Carbon::parse($f->datetime)->format('j M, Y g:ia')

                                            </a>
                                        @endforeach
                                    </div>
                                </div> --}}

                            </div>

                        </div>
                    </div>
                    @isset($active_version)
                    <div class="row d-flex">
                        <div class="col-2">
                            {{Carbon::parse($active_version->datetime)->format('j M, Y g:ia')}}

                        </div>
                        <div class="col-2">
                            <button type="button" class="btn delete-version">Delete Version</button>
                        </div>
                    </div>
                    @endisset
                </div>


                <div class="row">
                    <div class="col-md-12 my-3">
                        @csrf
                        @method('PUT')

                        @if(isset($active_version))
                        <div class="form-group">
                            <textarea name="code" id="code" cols="30" rows="50" class="form-control">{{$active_version->code}}</textarea>
                        </div>
                        @else
                        <div class="form-group">
                            <textarea name="code" id="code" cols="30" rows="50" class="form-control">{{$file->code}}</textarea>
                        </div>
                        @endif

                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="modal-preview" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Preview</h5>
                </div>
                <div class="modal-body">
                    <iframe src="" frameborder="0" id="iframe-preview"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@stop

@push('scripts')

    <script src="/springcms/admin/codemirror-5.65.2/lib/codemirror.js"></script>
    <script src="/springcms/admin/codemirror-5.65.2/mode/htmlmixed/htmlmixed.js"></script>
    <script src="/springcms/admin/codemirror-5.65.2/mode/xml/xml.js"></script>
    <script src="/springcms/admin/codemirror-5.65.2/mode/javascript/javascript.js"></script>
    <script src="/springcms/admin/codemirror-5.65.2/mode/css/css.js"></script>
    <script src="/springcms/admin/codemirror-5.65.2/mode/clike/clike.js"></script>
    <script src="/springcms/admin/codemirror-5.65.2/mode/php/php.js"></script>
    <script src="/springcms/admin/codemirror-5.65.2/mode/php/php.js"></script>
    <script src="/springcms/admin/codemirror-5.65.2/addon/fold/foldcode.js"></script>
    <script src="/springcms/admin/codemirror-5.65.2/addon/fold/xml-fold.js"></script>
    <script src="/springcms/admin/codemirror-5.65.2/addon/fold/foldgutter.js"></script>
{{--    <script src="/springcms/admin/codemirror-5.65.2/addon/fold/brace-fold.js"></script>--}}
    <script src="/springcms/admin/codemirror-5.65.2/addon/edit/matchbrackets.js"></script>
    <script src="/springcms/admin/codemirror-5.65.2/addon/edit/matchtags.js"></script>
    <script src="/springcms/admin/codemirror-5.65.2/addon/scroll/simplescrollbars.js"></script>
    <script>
        var codeMirror = CodeMirror.fromTextArea(document.getElementById("code"), {
            lineNumbers: true,
            mode: "php",
            // theme: 'monokai',
            foldGutter: true,
            matchTags: {bothTags: true},
            gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"],
            extraKeys: {"Ctrl-Q": function(cm){ cm.foldCode(cm.getCursor()); }},
        });

        $('.btn-delete').click(function () {
            if(window.confirm('Delete this file?')) {
                DynamicForm.create(route('river.template-pages.destroy', "{{$file->id}}"), 'DELETE')
                .addCsrf()
                .submit();
            }
        });

        $('.delete-all-version').click(function () {
            if(window.confirm('Delete this file?')) {
                DynamicForm.create(route('river.template-pages-version-delete', "{{$file->filename}}"), 'DELETE')
                .addCsrf()
                .submit();
            }
        });

        @isset($active_version)

                $('.delete-version').click(function () {
                    if(window.confirm('Delete this file?')) {
                        DynamicForm.create(route('river.template-pages-delete-version', "{{$active_version->id}}"), 'DELETE')
                        .addCsrf()
                        .submit();
                    }
                });
        @endisset




        //show preview
        $('.btn-preview').click(function () {
            fetchDataAndDisplayInIframe()
        });
        function fetchDataAndDisplayInIframe() {
            var code = codeMirror.getValue();
            var postData = {
                content: code
            };

            $.ajax({
                url: '/admin/template-pages/preview',
                method: 'POST',
                dataType: 'html',
                data: postData, // Include the data to be sent in the request
                success: function(htmlString) {
                    // Get the iframe element by its ID
                    var iframe = document.getElementById('iframe-preview');

                    // Access the document of the iframe
                    var iframeDocument = iframe.contentDocument || iframe.contentWindow.document;

                    // Write the HTML string into the iframe document
                    iframeDocument.open();
                    iframeDocument.write(htmlString);
                    iframeDocument.close();
                    $("#modal-preview").modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }
    </script>

@endpush
