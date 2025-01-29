@extends('river::admin.layouts.master')

@section('page-header')
<x:river::header>
    <x-slot:title>
        Edit {{ $title}}
        </x-slot>

        <x-slot:breads>
            <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{route('river.comments.index')}}">{{ $title}}</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="">Edit {{ $title}}</a></li>
        </x-slot:breads>

        <x-slot:buttons>
            <a href="{{route('river.comments.index')}}" class="btn">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12l14 0" />
                    <path d="M5 12l6 6" />
                    <path d="M5 12l6 -6" />
                </svg>
                Back
            </a>
        </x-slot:buttons>

</x:river::header>
@stop

@section('content')
<div class="single-comment">
    <form action="{{ route('river.comments.update', $comment->id) }}" method="POST">

        @csrf
        @method('PUT')
        <div class="row row-cards">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Author</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label class="col-3 col-form-label required">Full Name</label>
                            <div class="col">
                                <input type="text" name="name" class="form-control" placeholder="Enter name" value="{{ $comment->name ?? 'N/A' }}" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3 col-form-label required">Email address</label>
                            <div class="col">
                                <input type="email" name="email" class="form-control" value="{{ $comment->email ?? 'N/A' }}" placeholder="Enter email" />

                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3 col-form-label required">Comment</label>
                            <div class="col">
                                <textarea class="form-control" name="content" rows="6" placeholder="Content.." style="height: 139px;">
                                {{ $comment->content ?? 'N/A' }}
                                </textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3 col-form-label required">Status</label>
                            <div class="col">
                                <!-- <input type="text" name="status" class="form-control" value="{{ $comment->status ?? 'N/A' }}" placeholder="" /> -->
                                <div class="col-form-label text-uppercase">{{ $comment->status ?? 'N/A' }}</div>
                                <!-- <img src="{{ $comment->river_customers->image ?? 'https://templates.joomla-monster.com/joomla30/jm-news-portal/components/com_djclassifieds/assets/images/default_profile.png' }}" style="width: 200px" /> -->

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Status</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="btn btn-primary text-black mb-3"><a href="#" class="text-white text-decoration-none">View Post</a></div>
                                    <div>
                                        <label class="form-check">
                                            <input class="form-check-input" type="radio" name="" />
                                            <span class="form-check-label">Approve</span>
                                        </label>
                                        <label class="form-check">
                                            <input class="form-check-input" type="radio" name="" />
                                            <span class="form-check-label">Pending</span>
                                        </label>
                                        <label class="form-check">
                                            <input class="form-check-input" type="radio" />
                                            <span class="form-check-label">Spam</span>
                                        </label>
                                        <label class="form-check">
                                            <input class="form-check-input" type="radio" />
                                            <span class="form-check-label">Delete</span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label ">Published date :</label>
                                    <div class="col-9">
                                        @php
                                        $dateformat = $comment->created_at ? $comment->created_at->format('jS F Y') : '';
                                        @endphp
                                        <!-- <span class="display-flex justify-content-center align-item-center">{{ $dateformat }}</span>
                                        <label class=" ">12 jul 2025</label> -->
                                        <input type="text" name="created_at" class="form-control" value="{{ $dateformat }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-1 row row-cards">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


@stop



@push('scripts')
<!-- <script>
    $(document).ready(function() {
        $('.article-editor').ckeditor({
            height: 400,
            filebrowserImageBrowseUrl: window.hp_route_prefix + '?type=Images',
            filebrowserImageUploadUrl: window.hp_route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: window.hp_route_prefix + '?type=Files',
            filebrowserUploadUrl: window.hp_route_prefix + '/upload?type=Files&_token={{csrf_token()}}',
            extraAllowedContent: 'code(*)'
        });
    });

    $(function() {
        $('#contentType').change(function() {
            $('.content').hide();
            $('#' + $(this).val()).show();
        });
    });
</script> -->
@endpush