@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('page-header')
<x:river::header>
    <x-slot:title>
        Settings
        </x-slot>

        <x-slot:breads>
            <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Settings</a></li>
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
        <div class="col-md-12 ">
            <div class="card">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-general-1" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab" tabindex="-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-2">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                                    </svg>
                                    Genarel</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-social-1" class="nav-link " data-bs-toggle="tab" aria-selected="false" role="tab">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 icon icon-tabler icons-tabler-outline icon-tabler-cube">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M21 16.008v-8.018a1.98 1.98 0 0 0 -1 -1.717l-7 -4.008a2.016 2.016 0 0 0 -2 0l-7 4.008c-.619 .355 -1 1.01 -1 1.718v8.018c0 .709 .381 1.363 1 1.717l7 4.008a2.016 2.016 0 0 0 2 0l7 -4.008c.619 -.355 1 -1.01 1 -1.718z" />
                                        <path d="M12 22v-10" />
                                        <path d="M12 12l8.73 -5.04" />
                                        <path d="M3.27 6.96l8.73 5.04" />
                                    </svg>
                                    Social Links</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-icon-1" class="nav-link " data-bs-toggle="tab" aria-selected="false" role="tab">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-movie">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                        <path d="M8 4l0 16" />
                                        <path d="M16 4l0 16" />
                                        <path d="M4 8l4 0" />
                                        <path d="M4 16l4 0" />
                                        <path d="M4 12l16 0" />
                                        <path d="M16 8l4 0" />
                                        <path d="M16 16l4 0" />
                                    </svg>
                                    Logo</a>
                            </li>
                            <li class="nav-item ms-auto" role="presentation">
                                <a href="#tabs-settings-1" class="nav-link" title="Settings" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/settings -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-2 icon">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path
                                            d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path>
                                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content ">
                            <div class="tab-pane active show" id="tabs-general-1" role="tabpanel">
                                <form class="custom-validation" action="{{route('river.store-settings')}}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3 row">
                                        <label class="col-md-4">Website Name</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="name"
                                                value=" {{ river_settings('name') }}">
                                        </div>
                                        <div class="col-md-2">
                                            <button data-url="@{{river_settings('name')}}" class="btn btn-icon btn-copy" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copied">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                                    <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label class="col-md-4">Notice</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="notice"
                                                value="{{ river_settings('notice') }}">
                                        </div>
                                        <div class="col-md-2">
                                            <button data-url="@{{river_settings('notice')}}" class="btn btn-icon btn-copy" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copied">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                                    <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-md-4">Address</label>
                                        <div class="col-md-6">
                                            <textarea rows="2" class="form-control" id="example-text-input"
                                                name="address">{{ river_settings('address') }}</textarea>
                                        </div>

                                        <div class="col-md-2">
                                            <button data-url="@{{river_settings('address')}}" class="btn btn-icon btn-copy" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copied">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                                    <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                                </svg>
                                            </button>
                                        </div>


                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-md-4">Email</label>
                                        <div class="col-md-6">
                                            <input type="email" class="form-control" name="email"
                                                value="{{ river_settings('email') }}">
                                        </div>

                                        <div class="col-md-2">
                                            <button data-url="@{{river_settings('email')}}" class="btn btn-icon btn-copy" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copied">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                                    <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-md-4">Phone</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="phone"
                                                value="{{ river_settings('phone') }}">
                                        </div>
                                        <div class="col-md-2">
                                            <button data-url="@{{river_settings('phone')}}" class="btn btn-icon btn-copy" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copied">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                                    <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-md-4">iMO/Whats'up</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="imo_whatsup"
                                                value="{{ river_settings('imo_whatsup') }}">
                                        </div>

                                        <div class="col-md-2">
                                            <button data-url="@{{river_settings('imo_whatsup')}}" class="btn btn-icon btn-copy" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copied">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                                    <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-md-4">Open Hour</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="open_hour"
                                                value="{{ river_settings('open_hour') }}">
                                        </div>
                                        <div class="col-md-2">
                                            <button data-url="@{{river_settings('open_hour')}}" class="btn btn-icon btn-copy" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copied">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                                    <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-md-4">FB Client Id</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="facebook_client_id"
                                                value="{{ river_settings('facebook_client_id') }}">
                                        </div>
                                        <div class="col-md-2">
                                            <button data-url="@{{river_settings('facebook_client_id')}}" class="btn btn-icon btn-copy" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copied">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                                    <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-md-4">FB Client Secrete</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="facebook_client_secret"
                                                value="{{ river_settings('facebook_client_secret') }}">
                                        </div>

                                        <div class="col-md-2">
                                            <button data-url="@{{river_settings('facebook_client_secret')}}" class="btn btn-icon btn-copy" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copied">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                                    <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-md-4">Google Client Id</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="google_client_id"
                                                value="{{ river_settings('google_client_id') }}">
                                        </div>
                                        <div class="col-md-2">
                                            <button data-url="@{{river_settings('google_client_id')}}" class="btn btn-icon btn-copy" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copied">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                                    <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-md-4">Google Client Secrete</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="google_client_secret"
                                                value="{{ river_settings('google_client_secret') }}">
                                        </div>

                                        <div class="col-md-2">
                                            <button data-url="@{{river_settings('google_client_secret')}}" class="btn btn-icon btn-copy" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copied">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                                    <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0 float-right">
                                        <div class="col-md-8">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane " id="tabs-social-1" role="tabpanel">
                                <form class="custom-validation" action="{{route('river.store-settings')}}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3 row">
                                        <label class="col-md-4">Facebook link</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="facebook"
                                                value=" {{ river_settings('facebook') }}">
                                        </div>
                                        <div class="col-md-2">
                                            <button data-url="@{{river_settings('facebook')}}" class="btn btn-icon btn-copy" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copied">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                                    <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label class="col-md-4">Twitter link</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="twitter"
                                                value="{{ river_settings('twitter') }}">
                                        </div>
                                        <div class="col-md-2">
                                            <button data-url="@{{river_settings('twitter')}}" class="btn btn-icon btn-copy" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copied">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                                    <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-md-4">Instagram link</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="instagram"
                                                value="{{ river_settings('instagram') }}">
                                        </div>
                                        <div class="col-md-2">
                                            <button data-url="@{{river_settings('instagram')}}" class="btn btn-icon btn-copy" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copied">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                                    <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-md-4">Youtube Link</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="youtube"
                                                value="{{ river_settings('youtube') }}">
                                        </div>

                                        <div class="col-md-2">
                                            <button data-url="@{{river_settings('youtube')}}" class="btn btn-icon btn-copy" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copied">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                                    <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>


                                    <div class="form-group row mb-3">
                                        <label class="col-md-4">Google Map lat</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="google_map_lat"
                                                value="{{ river_settings('google_map_lat') }}">
                                        </div>

                                        <div class="col-md-2">
                                            <button data-url="@{{river_settings('google_map_lat')}}" class="btn btn-icon btn-copy" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copied">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                                    <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                                </svg>
                                            </button>
                                        </div>

                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-md-4">Google Map lon</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="google_map_lon"
                                                value="{{ river_settings('google_map_lon') }}">
                                        </div>
                                        <div class="col-md-2">
                                            <button data-url="@{{river_settings('google_map_lon')}}" class="btn btn-icon btn-copy" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copied">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                                    <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    {{-- <div class="form-group row mb-0 float-right">
                                        <div class="col-md-8">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                            Update
                                        </button>
                                    </div>
                                    </div> --}}

                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                            Update
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="tabs-icon-1" role="tabpanel">
                                <form action="{{route('river.store-settings')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row pb-4">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Site Favicon <small class="text-warning">(size 80 x 80)</small></label>
                                                @include('river::admin.components.image-picker', ['name' => 'favicon', 'default' => river_settings('favicon')])

                                            </div>
                                            <div class="col-md-2 my-2">
                                                <button data-url="@{{river_settings('favicon')}}" class="btn btn-icon btn-copy">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                                        <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group ">
                                                <label>Site Logo <small class="text-warning">( size 200px x 50px )</small></label>
                                                @include('river::admin.components.image-picker', ['name' => 'header_logo', 'default' => river_settings('header_logo')])


                                                <div class="col-md-2 my-2">
                                                    <button data-url="@{{river_settings('header_logo')}}" class="btn btn-icon btn-copy">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                                            <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Footer Logo <small class="text-warning">( size 170 x 70 )</small></label>
                                                @include('river::admin.components.image-picker', ['name' => 'footer_logo', 'default' => river_settings('footer_logo')])

                                                <div class="col-md-2 my-2">
                                                    <button data-url="@{{river_settings('footer_logo')}}" class="btn btn-icon btn-copy">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                                            <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Theme color</label>
                                                <div class="">
                                                    <div class="file-input">
                                                        <input type="color" class="form-control" name="theme_color"
                                                            value="{{river_settings('theme_color', '#2233aa')}}" />
                                                    </div>
                                                    <div class="d-flex align-items-center flex-wrap">
                                                    </div>
                                                    <div class="col-md-2 my-2">
                                                        <button data-url="@{{river_settings('theme_color')}}" class="btn btn-icon btn-copy">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                                                <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                                            </svg>
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0 float-right">
                                        <div class="col-md-8">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="tabs-settings-1" role="tabpanel">
                                <h4>Settings tab</h4>
                                <div>Donec ac vitae diam amet vel leo egestas consequat rhoncus in luctus amet, facilisi sit mauris accumsan nibh habitant senectus</div>
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
        $(document).ready(function() {
            $('.dropify').dropify();
        });

        $('.btn-copy').on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            var url = $this.data('url');
            navigator.clipboard.writeText(url);
        });

        $('.lfm-picker').filemanager('image', {
            prefix: window.hp_route_prefix
        });
    </script>
    @endpush