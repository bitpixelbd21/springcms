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

<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
      <div class="container-xl">
        <div class="row g-2 align-items-center">
          <div class="col">
            <h2 class="page-title">
              Account Settings
            </h2>
          </div>
        </div>
      </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="row g-0">
            <div class="col-3 d-none d-md-block border-end">

              <div class="card-body">
                <h4 class="subheader">Business settings</h4>

                <div class="list-group list-group-transparent">
                  <a href="" class="list-group-item list-group-item-action d-flex align-items-center active" id="buttonA">My Account</a>
                  <a href="" class="list-group-item list-group-item-action d-flex align-items-center " id="buttonB">Change Password</a>
                </div>
              </div>

            </div>

            <div class="col d-flex flex-column" id="divAccount">
              <div class="card-body">
                <h2 class="mb-4">My Account</h2>
                <h3 class="card-title">Profile Details</h3>
                <form method="post" action="{{ route('river.admin-update', $data->id) }}" enctype="multipart/form-data">
                  @csrf

                  {{-- Image field --}}
                  <div class="form-group mb-3 row">
                      <div class="form-group">
                          <label>Image <small class="text-warning"></small></label>
                          @include('river::admin.components.image-picker', ['name' => 'image', 'default' => $data->image])
                      </div>
                  </div>

                  {{-- Name field --}}
                  <div class="row g-3">
                      <div class="col-md">
                          <div class="form-label">Name</div>
                          <input type="text" class="form-control" name="name" value="{{ $data->name }}">
                      </div>
                  </div>

                  {{-- Email field --}}
                  <div class="row mt-3">
                      <div class="col-md">
                          <div class="form-label">Email</div>
                          <input type="text" name="email" class="form-control" value="{{ $data->email }}">
                      </div>
                  </div>

                  {{-- Bio field --}}
                  <div class="row mt-3">
                      <div class="col-md">
                          <div class="form-label">Bio</div>
                          <textarea name="bio" class="form-control">{{ $data->bio }}</textarea>
                      </div>
                  </div>

                  {{-- Social Media Links --}}
                  <div class="row mt-3">
                      <div class="col-md">
                          <div class="form-label">Facebook</div>
                          <input type="url" name="facebook" class="form-control" value="{{ $data->facebook }}">
                      </div>
                      <div class="col-md">
                          <div class="form-label">Instagram</div>
                          <input type="url" name="instagram" class="form-control" value="{{ $data->instagram }}">
                      </div>
                  </div>

                  <div class="row mt-3">
                      <div class="col-md">
                          <div class="form-label">LinkedIn</div>
                          <input type="url" name="linkedin" class="form-control" value="{{ $data->linkedin }}">
                      </div>
                      <div class="col-md">
                          <div class="form-label">YouTube</div>
                          <input type="url" name="youtube" class="form-control" value="{{ $data->youtube }}">
                      </div>
                  </div>

                  <div class="row mt-3">
                      <div class="col-md">
                          <div class="form-label">Twitter</div>
                          <input type="url" name="twitter" class="form-control" value="{{ $data->twitter }}">
                      </div>
                  </div>

                  {{-- Submit and Cancel buttons --}}
                  <div class="card-footer bg-transparent mt-auto">
                      <div class="btn-list justify-content-end">
                          <a href="{{ route('river.admin-settings') }}" class="btn">
                              Cancel
                          </a>
                          <button type="submit" class="btn btn-primary">
                              Submit
                          </button>
                      </div>
                  </div>
              </form>


            </div>
          </div>



        <div class="col d-none flex-column" id="divPassword" >
            <div class="card-body">
              <h2 class="mb-4">Change Password</h2>

                <div>
                  <div class="row">
                    <form method="post" action="{{ route('river.admin-password-update',$data->id) }}">
                      @csrf
                        <div class="col-12 col-sm-6 mb-3">
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <label>Current Password</label>
                                  <input class="form-control" name="password" type="password" placeholder="••••••" required>

                                </div>

                              </div>
                            </div>
                            <div class="row my-3">
                              <div class="col">
                                <div class="form-group">
                                  <label>New Password</label>
                                  <input class="form-control" name="new_password" type="password" placeholder="••••••" required>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <label>Confirm <span class="d-none d-xl-inline">Password</span></label>
                                  <input class="form-control" name="confirm_password" type="password" placeholder="••••••" required></div>
                              </div>
                            </div>
                            <div class="card-footer bg-transparent mt-auto">
                              <div class="btn-list justify-content-end">
                                <a href="#" class="btn">
                                  Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                  Submit
                                </button>
                              </div>
                            </div>
                          </div>

                    </form>

                  </div>
                <div>
            </div>
          </div>
         </div>


        </div>
      </div>
    </div>

  </div>

  <script>
    // Get references to the buttons and divs
    var buttonA = document.getElementById("buttonA");
    var buttonB = document.getElementById("buttonB");
    var div1 = document.getElementById("divAccount");
    var div2 = document.getElementById("divPassword");

    // Attach click event handler for Button A
    buttonA.addEventListener("click", function (event) {
        event.preventDefault()
        buttonA.classList.add("active")
        buttonB.classList.remove("active")
        div1.classList.remove("d-none")
        div1.classList.add("d-flex")
        div2.classList.remove("d-flex")
        div2.classList.add("d-none")

        // div2.classList.add("d-none")
    });

    // Attach click event handler for Button B
    buttonB.addEventListener("click", function (event) {
        event.preventDefault()
        buttonA.classList.remove("active")
        buttonB.classList.add("active")
        div1.classList.remove("d-flex")
        div1.classList.add("d-none")
        div2.classList.remove("d-none")
        div2.classList.add("d-flex")
    });

</script>
@endsection


@push('scripts')
<script>
    $('.lfm-picker').filemanager('image', {prefix: window.hp_route_prefix});
</script>
@endpush
