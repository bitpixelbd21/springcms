@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('page-header')
<x:river::header>
    <x-slot:title>
        Portfolios
        </x-slot>

        <x-slot:breads>
            <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Portfolios</a></li>
        </x-slot:breads>

        <x-slot:buttons>
            <a href="{{route('river.testimonial.create')}}" class="btn btn-primary d-none d-sm-inline-block">
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
                <!--  search option start-->
                <div class="card-body border-bottom py-3">
                    <div class="d-flex">
                        <!-- count area start -->
                        {{-- <div class="text-secondary">
                            <a href="{{ route('river.blog.index') }}" class="text-black mr-2 text-decoration-none">All <span>({{ $blogCount    }})</span></a><span class="mr-2"> |</span>
                        <a href="{{ route('river.blog.index', ['published' => 1]) }}" class="mr-2  text-decoration-none text-green">
                            Published <span class="ml-2">({{ $publishedCount }})</span>
                        </a>
                        <span class="mr-2"> |</span>
                        <a href="{{ route('river.blog.index', ['draft' => 0]) }}" class="mr-2  text-decoration-none ">
                            Draft <span class="ml-2">({{ $draftCount }})</span>
                        </a>
                        <span class="mr-2"> |</span>
                        <a href="#" class="mr-2 text-decoration-none text-red">Trashed <Span>(1)</Span></a>
                    </div> --}}
                    <!-- count area end -->

                    <!-- search area start -->
                    <div class="ms-auto text-secondary">
                        <div class="d-flex justify-content-between align-items-center ">
                            <form method="GET" action="{{ route('river.testimonial.index') }}" class="d-flex">
                                <input
                                    type="text"
                                    name="query"
                                    class="form-control form-control-sm"
                                    placeholder="Search Testimonial"
                                    value="{{ request('query') }}" />
                                <button type="submit" class="btn btn-primary btn-sm ms-2">Search</button>
                            </form>
                        </div>
                    </div>
                    <!-- search area end -->
                </div>
            </div>
            <!-- search option end -->

            @if($all->count() == 0)
            @include('river::admin.partials.nodata', ['link' => route('river.testimonial.create') ])
            @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th> sort_order</th>
                        <th> is Active</th>
                        <th> Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all as $key=>$a)
                    <tr>
                        <td>{{ $a->title }} </td>
                        <td> {{$a->slug }}</td>
                        <td> {{$a->sort_order }}</td>
                        <td>
                            @if($a->is_published == 1)
                            <span class="badge bg-green text-green-fg px-2">Active</span>
                            @else
                            <span class="badge bg-blue text-blue-fg ">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-start">
                                <div>
                                    <a class="btn btn-sm btn-secondary  px-3 py-1 rounded"
                                        href="{{ route('river.testimonial.edit',$a->id) }}"> Edit</a>
                                </div>
                                <div class="mx-1">
                                    <a class="btn btn-sm btn-danger confirm-delete  px-3 py-1 rounded" href="{{ route('river.testimonial.destroy',$a->id) }}"
                                        data-href="{{ route('river.testimonial.destroy',$a->id) }}">
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
                {{ $all->appends(['query' => request('query')])->links('pagination::bootstrap-5') }}
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
    //     var filename = window.prompt('Enter Name');

    //     if (filename) {
    //         DynamicForm.create(route('river.testimonial.store'), "POST")
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