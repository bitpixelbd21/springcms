@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('page-header')
    <x:river::header>
        <x-slot:title>
            Template Assets
        </x-slot>

        <x-slot:breads>
            <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Template Assets</a></li>
        </x-slot:breads>

        <x-slot:buttons>
            <a href="{{route('river.template-assets.create')}}" class="btn btn-primary d-none d-sm-inline-block">
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

@section('css')
@stop

@section('content')

    <div class="container-xl">
        <div class="row card row-cards">
            <h3>CSS Files</h3>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-vcenter">
                      <thead>
                        <tr>
                          <th>File Name</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($css_file_name as $key=>$file)
                        <tr>
                            <td>{{$file}}</td>
                            <td>
                                <a href="#" class="btn btn-icon btn-copy-clipboard mx-3" aria-label="Button" data-url="/river/assets/{{$file}}" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copied">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" /><path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" /></svg>
                                </a>
                                <a class="btn btn-icon btn-delete" data-route="{{ route('river.template-assets.destroy',$file ) }}"> <i class="fas fa-trash-alt text-danger" ></i> </a>
                            </td>
                          </tr>
                        @endforeach

                      </tbody>
                    </table>
                  </div>

            </div>

        </div>

        <div class="row card row-cards mt-5">

            <h3>JS Files</h3>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-vcenter">
                      <thead>
                        <tr>
                          <th>File Name</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($js_file_name as $key=>$file)
                        <tr>
                            <td>{{$file}}</td>
                            <td>
                                <a href="#" class="btn btn-icon btn-copy-clipboard mx-3" aria-label="Button" data-url="/river/assets/{{$file}}" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copied">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" /><path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" /></svg>
                                </a>
                                <a class="btn btn-icon btn-delete" data-route="{{ route('river.template-assets.destroy',$file ) }}"> <i class="fas fa-trash-alt text-danger" ></i> </a>

                            </td>
                          </tr>
                        @endforeach

                      </tbody>
                    </table>
                  </div>

            </div>

        </div>

        <div class="row card row-cards mt-5">

            <h3>Image Files</h3>
            <div class="col-md-12">
                {{-- <div class="table-responsive">
                    <table class="table table-vcenter">
                      <thead>
                        <tr>
                          <th>File Name</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($image_file_name as $key=>$file)
                        <tr>
                            <td> <img style="width:100px" src="/river/assets/{{ $file }}" /> {{$file}}</td>
                            <td>
                                <a href="#" class="btn btn-icon btn-copy-clipboard mx-3 "  data-url="/river/assets/{{$file}}" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copied">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" /><path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" /></svg>
                                </a>
                                <a class="btn btn-icon btn-delete" data-route="{{ route('river.template-assets.destroy',$file ) }}"> <i class="fas fa-trash-alt text-danger" ></i> </a>
                            </td>
                          </tr>
                        @endforeach


                      </tbody>
                    </table>
                  </div> --}}


                  <div>
                    <div class="row">
                      @foreach($image_file_name as $key=>$file)
                      <div class="card mx-2 col-2 mt-5  ">
                         <div class="card-body d-flex  align-content-between flex-wrap">

                            <div class="mt-t " >
                              <a> <img style="width:100px" src="/uploads/assets/{{ $file }}" /> {{$file}}</a>

                            </div>
                            <div class="mt-2">
                                <a href="#" class="btn btn-icon btn-copy-clipboard mx-3 "  data-url="/uploads/assets/{{$file}}" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copied">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" /><path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" /></svg>
                              </a>
                              <a class="btn btn-icon btn-delete" data-route="{{ route('river.template-assets.destroy',$file ) }}"> <i class="fas fa-trash-alt text-danger" ></i> </a>

                            </div>

                         </div>
                      </div>
                      @endforeach
                    </div>
                  </div>




            </div>

        </div>



    </div>
@stop

@push('scripts')
     <script>
         $('.btn-copy-clipboard').on('click', function (e) {
             e.preventDefault();
             var $this = $(this);
             var url = $this.data('url');
             navigator.clipboard.writeText(url);
         });

         $('.btn-delete').click(function (e) {
             e.preventDefault();
            if(window.confirm('Delete this file?')) {
                var $this = $(this);
                var route = $this.data('route')
                DynamicForm.create(route, 'DELETE')
                .addCsrf()
                .submit();
            }
        });


    </script>
@endpush
