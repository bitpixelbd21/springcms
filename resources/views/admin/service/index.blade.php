@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop


@section('page-header')
<x:river::header>
    <x-slot:title>
        Services
        </x-slot>

        <x-slot:breads>
            <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Services</a></li>
        </x-slot:breads>

        <x-slot:buttons>
            <a href="{{route('river.service.create')}}" class="btn btn-primary d-none d-sm-inline-block">
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
    <div class="row row-cards">
        <div class="col-md-12">
            <div class="card">
                @if($all->count() == 0)
                @include('river::admin.partials.nodata', ['link' => route('river.service.create') ])
                @else
                <table class="table">
                    <thead>
                        <tr>
                            <th> Title</th>
                            <th> slug </th>
                            <th> Service Category</th>
                            <th> Sort Order</th>
                            <th> Is Published</th>
                            <th> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all as $key=>$a)

                        <tr>
                            <td>{{ $a->title }} </td>
                            <td> {{ $a->slug }} </td>

                            <td> {{ $a->servicecategory ? $a->servicecategory->name : '' }}</td>

                            <td> {{ $a->sort_order}} </td>

                            <td>
                                @if($a->is_published==1)
                                <button class="btn btn-primary"> Yes</button>
                                @else
                                <button class="btn btn-danger"> No</button>
                                @endif
                            </td>

                            <td>
                                <div class="d-flex justify-content-end">
                                    <div>
                                        <a class="btn btn-sm btn-primary"
                                            href="{{ route('river.service.edit',$a->id) }}"> Edit</a>
                                    </div>
                                    <div class="mx-1">

                                        <a class="btn btn-sm btn-danger confirm-delete"
                                            href="{{ route('river.service.destroy',$a->id) }}"
                                            data-href="{{ route('river.service.destroy',$a->id) }}">
                                            Delete
                                        </a>
                                    </div>
                                </div>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script>
    // $('#btn-add-new').click(function (e) {
    //     e.preventDefault();
    //     var filename = window.prompt('Enter name');

    //     if (filename) {
    //         DynamicForm.create(route('river.contact-form.store'), "POST")
    //             .addField("name", filename)
    //             .addCsrf()
    //             .submit();
    //     }
    // });

    $('.confirm-delete').click(function(e) {
        var $this = $(this);
        e.preventDefault();
        if (confirm('Are you sure you want to delete this item?')) {
            DynamicForm.create($this.attr('href'), "DELETE")
                .addCsrf()
                .submit();
        }
    });
</script>
@endpush