@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('page-header')
<x:river::header>
    <x-slot:title>
        Email Settings
        </x-slot>

        <x-slot:breads>
            <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Email Settings</a></li>
        </x-slot:breads>

        <x-slot:buttons>
            <a class="btn btn-primary d-none d-sm-inline-block" id="btn-add-new">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Add new
            </a>
        </x-slot:buttons>

</x:river::header>
@stop

@section('content')
<div class="container-xl">
    <div class="row row-cards">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Email Seetings</h4>
                    <form class="custom-validation" action="{{route('river.store-settings')}}" method="POST">
                        @csrf
                        <div class="form-group mb-3 row">
                            <label class="col-md-4">Gmail user name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="gmail_name"
                                    value=" {{ river_settings('gmail_name') }}">
                            </div>

                            <div class="col-md-2">
                                <button data-url="@{{river_settings('gmail_name')}}" class="btn btn-icon btn-copy" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copied">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                        <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-4">Gmail app Password</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="gmail_password"
                                    value="{{ river_settings('gmail_password') }}">
                            </div>

                            <div class="col-md-2">
                                <button data-url="@{{river_settings('gmail_password')}}" class="btn btn-icon btn-copy" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copied">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                        <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-4">Newletter Submission</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="newsletter_submission"
                                    value="{{ river_settings('newsletter_submission') }}">
                            </div>

                            <div class="col-md-2">
                                <button data-url="@{{river_settings('newsletter_submission')}}" class="btn btn-icon btn-copy" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copied">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                        <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                    </svg>
                                </button>
                            </div>


                        </div>

                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                Update
                            </button>
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