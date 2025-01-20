@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('content')
<div class="container-xl">
    <div class="row row-cards">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Genarel</h4>
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
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{route('river.store-settings')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row my-4">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <div class="form-label">Social Login</div>
                                    <div>
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" name="social_login" {{river_settings('social_login') == true ? 'checked' : ''}}>
                                            <span class="form-check-label">Active</span>
                                        </label>
                                    </div>
                                </div>
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
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Social Links</h4>
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
            </div>
            <div class="card">
                <div class="card-body">
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