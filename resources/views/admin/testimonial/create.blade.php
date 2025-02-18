@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop


@section('page-header')
    <x:river::header>
            <x-slot:title>
            Add Testimonial
            </x-slot>

            <x-slot:breads>
                <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{route('river.testimonial.index')}}">Testimonials</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="">Add Testimonial</a></li>
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
                                <form action="{{ route('river.testimonial.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label required">Name</label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    {{-- <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label ">Image</label>
                                        <div class="col">
                                            <input type="file" class="form-control" name="image">
                                        </div>
                                    </div> --}}


                                    <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label ">Designation</label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="designation" value="{{ old('designation') }}" >
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label required">Message</label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="message" value="{{ old('message') }}">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label ">Sort Order</label>
                                        <div class="col">
                                            <input type="number" class="form-control" name="sort_order"
                                            value="{{ old('sort_order') }}">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <div class="form-group">
                                            <label class="from-control col-form-label">Image <small class="text-warning"></small></label>
                                            @include('river::admin.components.image-picker', ['name' => 'image', 'default' => river_settings('image')])

                                        </div>
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
                                                    id="is_published">
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
