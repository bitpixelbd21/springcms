@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('page-header')
<x:river::header>
    <x-slot:title>
        Data Types
        </x-slot>

        <x-slot:breads>
            <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Data Types</a></li>
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

@section('css')
@stop

@section('content')
<div class="container-xl">
    <div class="row row-cards">
        <div class="col-md-12">
            <div class="card">
                @if($all->count() == 0)
                @include('river::admin.partials.nodata', ['link' => null])
                @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Slug</th>
                            <th scope="col" style="width: 5%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all as $a)
                        <tr>
                            <td>
                                {{$a->singular}}
                            </td>
                            <td>
                                {{$a->slug}}
                            </td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <a href="{{route('river.datatypes.edit', $a->id)}}" class="btn btn-sm btn-info">
                                        Edit
                                    </a>
                                    <a class="btn btn-sm btn-danger confirm-delete" href="{{ route('river.datatypes.destroy', $a->id) }}"
                                        data-href="{{ route('river.datatypes.destroy', $a->id) }}">
                                        Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
                <div class="card-body">
                    {{ $all->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script>
    $('#btn-add-new').click(function(e) {
        e.preventDefault();
        var filename = window.prompt('Enter name');

        if (filename) {
            DynamicForm.create(route('river.datatypes.store'), "POST")
                .addField("name", filename)
                .addCsrf()
                .submit();
        }
    });

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