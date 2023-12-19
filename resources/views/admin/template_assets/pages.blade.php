@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')
@stop

@section('content')

    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-md-5">
                <div class="list-group">
                    <h3> Css Files</h3>
                    @foreach($pages as $file)
                      @if($file->type==1)
                      <a class="list-group-item" href="{{route('river.template-assets.edit', $file->id)}}">{{$file->filename}}</a>
                      @endif
                        
                    @endforeach
                </div>
                <div class="list-group mt-3">
                    <h3> Js Files</h3>
                    @foreach($pages as $file)
                    @if($file->type==2)
                      <a class="list-group-item" href="{{route('river.template-assets.edit', $file->id)}}">{{$file->filename}}</a>
                      @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        $('#btn-add-new').click(function (e) {
            e.preventDefault();
            var filename = window.prompt('Enter file name');

            DynamicForm.create(route('river.template-assets.store'), "POST")
                .addField("filename", filename)
                .addCsrf()
                .submit();
        })
    </script>
@endpush
