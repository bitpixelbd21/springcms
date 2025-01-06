@extends('river::admin.layouts.master')

@section('page-header')
    <x:river::header>
            <x-slot:title>
            Edit blog
            </x-slot>

            <x-slot:breads>
                <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{route('river.blog.index')}}">Blogs</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="">Edit blog</a></li>
            </x-slot:breads>

            <x-slot:buttons>
                <a href="{{route('river.blog.index')}}" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0"/><path d="M5 12l6 6"/><path d="M5 12l6 -6"/></svg>
                    Back
                </a>
            </x-slot:buttons>

    </x:river::header>
@stop

@section('content')
{{-- <div class="container-xl">
    <div class="row row-cards">
        <div class="col-md-12">
            <div class="">
                <ul class="nav nav-tabs" data-bs-toggle="tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('river.blog.index') }}" class="btn btn-primary">back</a>
                    </li>

                </ul>

            </div>
        </div>
    </div>
</div> --}}


<div class="container-xl pt-3">
    <div class="row row-cards">
        <div class="col-md-12">
            <div class="">
                <div class="card-body row">
                    <div class=" col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('river.blog.update', $type->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mb-3 ">
                                        <label class="form-label required"> Title</label>
                                        <div>
                                            <input type="text" class="form-control generate-slug" data-slug-field="slug" name="title" value="{{ $type->title }}">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 ">
                                        <label class="form-label required"> Slug</label>
                                        <div>
                                            <input type="text" class="form-control" name="slug" value="{{ $type->slug }}">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 ">
                                        <label class="form-label required"> Content</label>
                                        <div>
                                            <textarea class="form-control article-editor" id="content_type" name="content">
                                                    {{ $type->content }}
                                                </textarea>

                                        </div>
                                    </div>

                                    <div class="form-group mb-3 ">
                                        <label class="form-label ">Excerpt</label>

                                        <div>
                                            <input type="text" class="form-control"  name="excerpt" value="{{ $type->excerpt }}">
                                        </div>
                                    </div>

                            </div>
                        </div>

                        <div class="col card mt-4">
                            <div class="card">
                                <div class="card-header">
                                  <h3> SEO</h3>
                                </div>
                                <div class="card-body">
                                  <div class="form-group mb-3 ">
                                      <label class="form-label "> Meta Title</label>
                                      <div>
                                          <input type="text" class="form-control" name="meta_title" value="{{ $type->meta_title}}">
                                      </div>
                                  </div>

                                  <div class="form-group mb-3 ">
                                    <label class="form-label "> Meta Keywords</label>
                                    <div>
                                        <input type="text" class="form-control" name="meta_keywords" value="{{ $type->meta_keywords  }}">
                                    </div>
                                </div>

                                  <div class="form-group mb-3 ">
                                      <label class="form-label "> Meta Description</label>
                                      <div>
                                          <input type="text" class="form-control" name="meta_description" value="{{ $type->meta_description  }}">
                                      </div>
                                  </div>

                                  <div class="form-group">

                                      <label class="form-label ">Meta  Image <small class="text-warning"></small></label>
                                      @include('river::admin.components.image-picker', ['name' => 'meta_image', 'default' =>$type->meta_image ])
                                  </div>


                                </div>
                              </div>
                        </div>
                    </div>

                    <div class="col-md-4">

                        <div class="form-group mb-3 ">
                            <div class="card">
                                <div class="card-header">
                                    <label class="form-label">Category</label>
                                </div>
                                <div class="card-body">
                                    <select class="form-select js-example-basic-single" name="category_id" aria-label="Default select example">
                                    <option value="0" disabled>Select Category</option>
                                    @foreach($all_cat as $a)
                                    <option value="{{$a->id}}" @if($a->id==$type->category_id) selected @endif >{{
                                        $a->name }}</option>
                                    @endforeach
                                    </select>
                                </div>

                            </div>

                        </div>

                        <div class="form-group mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        @include('river::admin.components.image-picker', ['name' => 'image', 'default'
                                        => $type->image ])
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="form-group mb-3 ">
                            <label class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_published" value="1"
                                    {{$type->is_published == 1 ? 'checked' : ''}}>
                                <span class="form-check-label">Is Published</span>
                            </label>
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>

                </form>

                </div>
            </div>
        </div>
    </div>
</div>
@stop



@push('scripts')
<script>
    $(document).ready(function() {
        $('.article-editor').ckeditor({
            height: 400,
            filebrowserImageBrowseUrl: window.hp_route_prefix + '?type=Images',
            filebrowserImageUploadUrl: window.hp_route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: window.hp_route_prefix + '?type=Files',
            filebrowserUploadUrl: window.hp_route_prefix + '/upload?type=Files&_token={{csrf_token()}}',
            extraAllowedContent: 'code(*)'
        });
    });

    $(function() {
        $('#contentType').change(function(){
            $('.content').hide();
            $('#' + $(this).val()).show();
        });
    });

</script>
@endpush
