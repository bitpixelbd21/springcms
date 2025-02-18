@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop


@section('page-header')
    <x:river::header>
            <x-slot:title>
            Edit Testimonial
            </x-slot>

            <x-slot:breads>
                <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{route('river.testimonial.index')}}">Testimonials</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="">Edit Testimonial</a></li>
            </x-slot:breads>

            <x-slot:buttons>
                <a href="{{route('river.testimonial.index')}}" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0"/><path d="M5 12l6 6"/><path d="M5 12l6 -6"/></svg>
                    Back
                </a>
            </x-slot:buttons>

    </x:river::header>
@stop

@section('css')

@endsection

@section('content')
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active show p-5" id="general" role="tabpanel">
                                <form action="{{ route('river.testimonial.update',$type->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label required">Name</label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="name" value="{{ $type->name }}">
                                        </div>
                                    </div>
                                    {{-- <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label ">Image</label>
                                        <div class="col">
                                            <input type="file" class="form-control" name="image" value="{{ $type->image }}">
                                        </div>
                                    </div> --}}



                                    <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label ">Designation</label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="designation" value="{{ $type->designation }}">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label required">Message</label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="message"
                                                   value="{{ $type->message }}">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label ">Sort Order</label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="sort_order"
                                                   value="{{ $type->sort_order }}">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label ">Image</label>
                                        <div class="col">
                                            @include('river::admin.components.image-picker', ['name' => 'image', 'default' => $type->image ])
                                        </div>

                                        {{--<div class="col">
                                            <input type="text" class="form-control" name="sort_order"
                                                   value="{{ $type->sort_order }}">
                                        </div>--}}
                                        {{--<div class="form-group">
                                            <label>Image <small class="text-warning"></small></label>
                                            @include('river::admin.components.image-picker', ['name' => 'image', 'default' => $type->image ])

                                        </div>
                                        <div class="col-md-2 my-2">
                                            <button data-url="@{{river_settings('image')}}" class="btn btn-icon btn-copy">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" /><path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" /></svg>
                                            </button>
                                        </div>--}}
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label"></label>
                                        <div class="col d-flex">
                                            <div class="form-check">
                                                <input 
                                                    class="form-check-input" 
                                                    type="checkbox" 
                                                    value="1" 
                                                    name="is_published" 
                                                    id="is_published"
                                                    @if($type->is_published == 1) checked @endif>
                                                <label class="form-check-label" for="is_published">
                                                    Published
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
<script>
$('.lfm-picker').filemanager('image', {prefix: window.hp_route_prefix});
</script>



@endpush
