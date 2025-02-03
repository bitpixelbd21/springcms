@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop


@section('page-header')
<x:river::header>
    <x-slot:title>
        {{ $title }}
        </x-slot>

        <x-slot:breads>
            <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{route('river.api.index')}}">API Access Token</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="">{{ $title }}</a></li>
        </x-slot:breads>

        <x-slot:buttons>
            <a href="{{route('river.testimonial.index')}}" class="btn">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12l14 0" />
                    <path d="M5 12l6 6" />
                    <path d="M5 12l6 -6" />
                </svg>
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
                            <form action="{{ route('river.api.update',$type->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-3 row">
                                    <label class="col-3 col-form-label required">Name</label>
                                    <div class="col">
                                        <input type="text" class="form-control" name="name" value="{{ $type->name }}">
                                    </div>
                                </div>

                                <div class="form-group mb-3 row">
                                    <label class="col-3 col-form-label ">Created Date</label>
                                    <div class="col">
                                        <input type="datetime-local" class="form-control" name="created_at" value="{{ $type->created_at }}">
                                    </div>
                                </div>

                                <div class="form-group mb-3 row">
                                    <label class="col-3 col-form-label required">Expires date</label>
                                    <div class="col">
                                        <input type="datetime-local" class="form-control" name="expires_at" value="{{ $type->expires_at }}">
                                    </div>
                                </div>

                                <div class="form-group mb-3 row">
                                    <label class="col-3 col-form-label ">Is Active</label>
                                    <div class="col d-flex ">

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="1" name="is_active" @if($type->is_active==1) checked @endif>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Active
                                            </label>
                                        </div>
                                        <div class="form-check mx-2">
                                            <input class="form-check-input" type="radio" value="0" name="is_active" @if($type->is_active==0) checked @endif>
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Inactive
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3 row">
                                    <label class="col-3 col-form-label ">Is Only Read</label>
                                    <div class="col d-flex ">

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="1" name="is_read_only" @if($type->is_read_only==1) checked @endif >
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Read Only
                                            </label>
                                        </div>
                                        <div class="form-check mx-2">
                                            <input class="form-check-input" type="radio" value="0" name="is_read_only" @if($type->is_read_only==0) checked @endif>
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Not Read
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
    $('.lfm-picker').filemanager('image', {
        prefix: window.hp_route_prefix
    });
</script>



@endpush