@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')
    <link rel="stylesheet" href="/river/admin/codemirror-5.65.2/lib/codemirror.css" />
    <link rel="stylesheet" href="/river/admin/codemirror-5.65.2/theme/monokai.css" />
    <style>
        .CodeMirror {
            height: 400px;
        }
        .content{
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body row">
                       <div class="col-md-8">
                           <form action="{{route('river.blog.store')}}" method="POST">
                               @csrf
                               <div class="form-group mb-3 ">
                                   <label class="form-label required"> Title</label>
                                   <div>
                                       <input type="text" class="form-control"  name="title" value="{{ old('title') }}">
                                   </div>
                               </div>

                               <div class="form-group mb-3 ">
                                    <label class="form-label required"> Content</label>
                                    <div>
                                        <textarea class="form-control" name="content"  >

                                        </textarea>
                                    
                                    </div>
                                </div>

                            <div class="form-group mb-3 ">
                                <label class="form-label required">Category</label>
                                <div>
                                    <input type="text" class="form-control"  name="category_id" value="{{ old('category_id') }}">
                                </div>
                            </div>
                               
                               
                               <div class="form-group mb-3 ">
                                   <label class="form-check">
                                       <input class="form-check-input" type="checkbox" name="is_published" value="1">
                                       <span class="form-check-label">Is Published</span>
                                   </label>
                               </div>

                               <div class="form-footer">
                                   <button type="submit" class="btn btn-success">Save</button>
                               </div>
                           </form>
                       </div>
                    </div>
                </div>
            </div>
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
    <script>
        var code = CodeMirror.fromTextArea(document.getElementById("code"), {
            lineNumbers: true,
            mode: "php",
            theme: 'monokai'
        });
        tinymce.init({
            selector: '#content_type',
        })
        $(function() {
            $('#contentType').change(function(){
                $('.content').hide();
                $('#' + $(this).val()).show();
            });
        });
    </script>
@endpush
