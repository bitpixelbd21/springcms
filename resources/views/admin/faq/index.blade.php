@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop


@section('page-header')
    <x:river::header>
        <x-slot:title>
            Faqs
        </x-slot>

        <x-slot:breads>
            <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Faqs</a></li>
        </x-slot:breads>

        <x-slot:buttons>
            <a class="btn btn-primary d-none d-sm-inline-block" id="btn-add-new" href="#">
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
                    <div class="card-body">

                        @if($all->count() == 0)
                            @include('river::admin.partials.nodata', ['link' => route('river.faq.create')])
                        @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>SL. </td>
                                    <td> Question</td>
                                    <td> Answer</td>
                                    <td> sort_order</td>
                                    <td> Type</td>
                                    <td> is Active</td>
                                    <td> Action</td>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($all as $key=>$a)
                            <tr>
                                <td>{{ ++$key }} </td>
                                <td>{{ $a->question }} </td>
                                <td> {{$a->answer  }}</td>
                                <td> {{$a->sort_order  }}</td>
                                <td> {{$a->type  }}</td>
                                <td>{{ ($a->is_active==1)? 'Active':'Inactive' }} </td>
                                <td>
                                    <div class="d-flex justify-content-end">
                                        <div>
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('river.faq.edit',$a->id) }}"> Edit</a>
                                        </div>
                                        <div class="mx-1">
                                            <form method="POST" action={{ route('river.faq.destroy',$a->id)}}>
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-sm btn-danger"> Delete </button>
                                            </form>
                                        </div>
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
        $('#btn-add-new').click(function (e) {
            e.preventDefault();
            var filename = window.prompt('Enter Question');

            if (filename) {
                DynamicForm.create(route('river.faq.store'), "POST")
                    .addField("question", filename)
                    .addCsrf()
                    .submit();
            }
        });



        $('.confirm-delete').click(function (e) {
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
