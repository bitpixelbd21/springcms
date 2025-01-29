@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('page-header')
<x:river::header>
    <x-slot:title>
        Banners
        </x-slot>

        <x-slot:breads>
            <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Banners</a></li>
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
    <div class="row row-cards">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-block">
                    <div class="dt-responsive table-responsive">
                        <table id="alt-pg-dt" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Alt Text</th>
                                    <th> Slug</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($banners as $data)
                                <tr>
                                    <td><img src="{{asset($data->image)}}" width="100px" height="50px"></td>
                                    <td>{{$data->alt_text}}</td>
                                    <td> {{ $data->slug }}</td>
                                    <td class="">
                                        <div class="btn-list flex-nowrap">
                                            <a class="mr-3 btn btn-sm btn-warning" href="{{ route('river.banners.edit', $data->id) }}">
                                                Edit
                                            </a>
                                            <a class="btn btn-sm btn-danger confirm-delete" href="{{ route('river.banners.destroy', $data->id) }}"
                                                data-href="{{ route('river.banners.destroy', $data->id) }}">
                                                Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('river.banners.store') }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <div class="form-label" for="alt_text">Alt text</div>
                            <input type="text" class="form-control generate-slug" data-slug-field="slug" id="alt_text" name="alt_text" value="{{ old('alt_text') }}" />
                        </div>
                        <div class="form-group mb-3">
                            <div class="form-label" for="alt_text">Slug</div>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" />
                        </div>
                        <div class="form-group mb-3">
                            <div class="form-label" for="alt_text">Title</div>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" />
                        </div>
                        <div class="form-group mb-3">
                            <div class="form-label" for="alt_text">Subtitle</div>
                            <input type="text" class="form-control" id="Subtitle" name="Subtitle" value="{{ old('Subtitle') }}" />
                        </div>
                        <div class="form-group mb-3">
                            <div class="form-label" for="alt_text">Button One Text</div>
                            <input type="text" class="form-control" id="button_one_text" name="button_one_text" value="{{ old('button_one_text') }}" />
                        </div>
                        <div class="form-group mb-3">
                            <div class="form-label" for="alt_text">Button One Url</div>
                            <input type="text" class="form-control" id="button_one_url" name="button_one_url" value="{{ old('button_one_url') }}" />
                        </div>
                        <div class="form-group mb-3">
                            <div class="form-label" for="alt_text">Button Two Text</div>
                            <input type="text" class="form-control" id="button_two_text" name="button_two_text" value="{{ old('button_two_text') }}" />
                        </div>
                        <div class="form-group mb-3">
                            <div class="form-label" for="alt_text">Button Two Url</div>
                            <input type="text" class="form-control" id="button_two_url" name="button_two_url" value="{{ old('button_two_url') }}" />
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label>Image <small class="text-warning"></small></label>
                                @include('river::admin.components.image-picker', ['name' => 'image', 'default' => river_settings('image')])
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="d-flex align-items-center flex-wrap">
                                <span class="pip d-none">
                                    <img class="imageThumb" id="ImgPreview1" src="" style="height: 200px;">
                                    <span class="remove btn btn-sm btn-danger" id="removeImage1" onclick="removeSingleImage('ImgPreview1','image')">
                                        Remove
                                    </span>
                                </span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script>
    $('body').on('change', "#statusChange", function() {
        var id = $(this).attr('data-id');

        if (this.checked) {
            var status = 1;
        } else {
            var status = 0;
        }
        $.ajax({
            url: "/backpanel/slider-status/" + id + '/' + status,
            method: "GET",
            success: function(done) {
                console.log(done);
                toastr.success(done.message, '');
            }
        });
    })
</script>

<script>
    $('.confirm-delete').click(function(e) {
        var $this = $(this);
        e.preventDefault();
        if (confirm('Are you sure you want to delete this item?')) {
            DynamicForm.create($this.attr('href'), "DELETE")
                .addCsrf()
                .submit();
        }
    });

    $('.lfm-picker').filemanager('image', {
        prefix: window.hp_route_prefix
    });
</script>

@endpush