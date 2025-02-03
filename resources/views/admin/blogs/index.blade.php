@extends('river::admin.layouts.master')

@section('page-header')
<x:river::header>
    <x-slot:title>
        Blogs
        </x-slot>

        <x-slot:breads>
            <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href="{{ route('river.blog.index') }}">Blogs</a></li>
        </x-slot:breads>

        <x-slot:buttons>
            <a href="{{route('river.blog.create')}}" class="btn btn-primary d-none d-sm-inline-block">
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

@section('content')
<div class="container-xl">
    <div class="row row-cards">
        <div class="col-md-12">
            <div class="card">

                <!--  search option start-->
                <div class="card-body border-bottom pt-3">
                    <form method="GET" id="handler-search">
                        <div class="d-flex">
                            <div>
                                <label class="form-check form-check-inline mb-0">
                                    <input class="form-check-input form-type " type="radio" name="status" value="all" {{ $queryStatus == "all" ? 'checked' : '' }} />
                                    <span class="form-check-label">All ({{ $blogCount}})</span>
                                </label>
                                <label class="form-check form-check-inline mb-0">
                                    <input class="form-check-input form-type" type="radio" name="status" value="published" {{ $queryStatus == "published" ? 'checked' : '' }} />
                                    <span class="form-check-label">Published ({{ $publishedCount }})</span>
                                </label>
                                <label class="form-check form-check-inline mb-0">
                                    <input class="form-check-input form-type" type="radio" name="status" value="draft" {{ $queryStatus == "draft" ? 'checked' : '' }} />
                                    <span class="form-check-label">Draft ({{ $draftCount }})</span>
                                </label>
                            </div>


                            <div class="ms-auto text-secondary">
                                <div class="d-flex justify-content-between align-items-center mb-3 ">
                                    <div class="d-flex">
                                        <input
                                            type="text"
                                            name="query"
                                            class="form-control form-control-sm"
                                            placeholder="Search blogs"
                                            value="{{ request('query') }}" />
                                        <button type="submit" class="btn btn-primary btn-sm ms-2">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- search option end -->

                @if($all->count() == 0)
                @include('river::admin.partials.nodata', ['link' => route('river.blog.create') ])
                @else
                <table class="table">
                    <thead>
                        <tr>
                            <th class="w-50" style="font-size: 12px;">Title</th>
                            <th style="font-size: 12px;">Category</th>
                            <th style="font-size: 12px;">Author</th>
                            <th style="font-size: 12px;">Is Published</th>
                            <th style="font-size: 12px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all as $key => $a)
                        <tr>
                            <td> <a class="text-decoration-none text-black" href="{{ route('river.blog.show', $a->slug) }}" data-href="{{ route('river.blog.show', $a->slug) }}" target="_blank" rel="noopener noreferrer">{{ Str::limit($a->title, '120')  }}</a></td>
                            <!-- <td>
                                <img src="/river/assets/{{ $a->image }}" style="width: 150px" />
                            </td> -->
                            <td>{{ $a->blogcategory ? $a->blogcategory->name : 'N/A' }}</td>

                            <td>{{ $a->admin->name }}</td>
                            <td>
                                @if($a->is_published == 1)
                                <span class="badge bg-green text-green-fg ">Published</span>
                                @else
                                <span class="badge bg-blue text-blue-fg px-2">Drafted</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-start">
                                    <div>
                                        <a class="btn btn-sm btn-secondary px-3 py-1 rounded"
                                            href="{{ route('river.blog.edit', $a->id) }}">Edit</a>
                                    </div>
                                    <div class="mx-2">
                                        <a class="btn btn-sm btn-danger confirm-delete px-3 py-1 rounded" href="{{ route('river.blog.destroy', $a->id) }}"
                                            data-href="{{ route('river.blog.destroy', $a->id) }}">
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
    //     var filename = window.prompt('Enter name');

    //     if (filename) {
    //         DynamicForm.create(route('river.contact-form.store'), "POST")
    //             .addField("name", filename)
    //             .addCsrf()
    //             .submit();
    //     }
    // });

    $(".form-type").on('change', function(event) {
        console.log('ok');
        $('#handler-search').submit();
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