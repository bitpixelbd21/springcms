@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')
@stop

@section('content')

<div class="container-xl">
    <div class="row row-cards">

        <div class="col-12">
            <div class="card">
                @if($data->count() == 0)
                @include('river::admin.partials.nodata', ['link' => null ])
                @else
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable" id="myTable">
                        <thead>
                            <tr>

                                <th scope="col"> Name</th>
                                <th scope="col"> Email</th>
                                <th scope="col"> Subject</th>
                                <th scope="col"> Phone Number</th>
                                <th scope="col"> Message</th>

                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key=>$item)
                            <tr>


                                <td>
                                    <p><a>{{ $item->name }} </a></p>

                                </td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->subject }}</td>
                                <td>{{ $item->phone_number }}</td>
                                <td>{{ $item->message }}</td>


                                <td class="">

                                    <div class="d-flex">


                                        <form method="POST" action="{{ route('river.contact-delete', $item->id) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-danger delete-user" onClick="return confirm('Are you sure?')"> <i class="fas fa-trash"></i> </button>
                                            </div>
                                        </form>

                                    </div>

                                </td>



                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>


                <div class="card-footer d-flex align-items-center">

                    <p class="m-0 text-muted">Showing <span>{{($data->currentpage()-1)*$data->perpage()+1}}</span> to <span>{{$data->currentpage()*$data->perpage()}}</span> of <span>{{$data->total()}}</span> entries</p>

                    {!! $data->links() !!}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection