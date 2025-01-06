@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('page-header')
<x:river::header>
    <x-slot:title>
        Users
        </x-slot>

        <x-slot:breads>
            <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Users</a></li>
        </x-slot:breads>

        <x-slot:buttons>
            <a href="{{route('river.users.create')}}" class="btn btn-primary d-none d-sm-inline-block">
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

@endsection

@section('content')
<div class="container-xl">
    <div class="row row-cards">
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    @if($users->count() == 0)
                        @include('river::admin.partials.nodata', ['link' => route('river.users.create')])
                    @else
                        <table class="table table-vcenter table-mobile-md card-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    {{-- <th>Developer</th> --}}
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $item)
                                <tr>
                                    <td data-label="Name">
                                        <div class="d-flex py-1 align-items-center">
                                            <span class="avatar me-2" style="background-image: url(./static/avatars/010m.jpg)"></span>
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{$item->name}}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Title">
                                        <div>{{$item->email}}</div>
                                    </td>
                                    <td class="text-muted" data-label="Role">
                                        @if($item->role_id==1)
                                        Developer
                                        @elseif($item->role_id==2)
                                        Site Admin
                                        @elseif($item->role_id==3)
                                        Writer
                                        @endif
                                    </td>
                                    {{-- <td class="text-muted" data-label="Role">
                                            @if($item->is_developer == 1)
                                                <span class="text-success">Yes</span>
                                            @else
                                                <span class="text-danger">No</span>
                                            @endif
                                        </td> --}}
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a href="{{route('river.users.edit',$item->id)}}" class="btn btn-sm btn-info">
                                                Edit
                                            </a>

                                            <a class="btn btn-sm btn-danger confirm-delete" href="javascript:void(0);" onclick="deleteTable({{$item->id}})">
                                                Delete
                                            </a>
                                            <form id="delete-form-{{$item->id}}"
                                                action="{{ route('river.users.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script>
    function deleteTable(id) {
        if (confirm("Do you want to delete this item?")) {
            document.getElementById('delete-form-' + id).submit();
            toastr.success('Deleted!', "")
        }
    }
</script>
@endpush