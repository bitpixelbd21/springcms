@extends('river::admin.layouts.master')

@section('page-header')
<x:river::header>
    <x-slot:title>
        Comments
        </x-slot>

        <x-slot:breads>
            <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Comments</a></li>
        </x-slot:breads>

        <x-slot:buttons>
            <!-- <a href="#" class="btn btn-primary d-none d-sm-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Add new
            </a> -->
        </x-slot:buttons>

</x:river::header>
@stop

@section('content')
<div class="container-xl">
    <div class="row row-cards">
        <div class="col-md-12">
            <div class="card">
                @if($comments->count() == 0)
                @include('river::admin.partials.nodata', ['link' => route('river.comments.create') ])
                @else
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices" /></th>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Comment</th>
                                <th>Status</th>
                                <th>Published</th>
                                <th>In Response To</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comments as $key=>$comment)
                            <tr>
                                <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice" /></td>
                                <td><a href="invoice.html" class="text-decoration-none text-reset" tabindex="-1">{{ $comment->name ?? 'N/A' }}</a></td>
                                <td>
                                    <a href="invoice.html" class="text-decoration-none text-reset" tabindex="-1">{{ $comment->email ?? 'N/A' }}</a>
                                </td>
                                <td><span href="invoice.html" class="text-reset" tabindex="-1">{{ Str::limit($comment->content, 30)}}</span></td>
                                <td>
                                    @if($comment->status == 'approve')
                                    <span class="badge bg-green text-green-fg px-2 py-2">Approved</span>
                                    @elseif($comment->status == 'pending')
                                    <span class="badge bg-blue text-blue-fg px-2 py-2">Pending</span>
                                    @else
                                    <span class="badge bg-danger text-danger-fg px-2 py-2">Trashed</span>
                                    @endif

                                </td>
                                @php
                                $dateformat = $comment->created_at ? $comment->created_at->format('jS F Y') : '';
                                @endphp
                                <td>
                                    {{ $dateformat  }}
                                </td>
                                <td>

                                    <h4><a href="#" class="text-decoration-none text-black">{{ Str::limit('Blog Name', 30)}}</a></h4>
                                </td>
                                <td class="">
                                    @if($comment->status == 'pending')
                                    <form action="{{ route('river.comments-approve.approves') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="approve">
                                        <input type="hidden" name="id" value="{{ $comment->id }}">
                                        <button type="submit" class="text-decoration-none badge bg-green text-green-fg px-2 py-2 me-1">
                                            Approve
                                        </button>
                                    </form>
                                    @else($comment->status == 'approve')
                                    <form action="{{ route('river.comments-pending.pending') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="pending">
                                        <input type="hidden" name="id" value="{{ $comment->id }}">
                                        <button type="submit" class="text-decoration-none badge bg-orange text-orange-fg px-2 py-2 me-1">
                                            Disapprove
                                        </button>
                                    </form>
                                    @endif


                                    <a href="{{ route('river.comments.edit', $comment->id) }}" class="text-decoration-none badge bg-secondary px-2 py-2 me-1">Edit</a>
                                    <form class="d-inline" action="{{ route('river.comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="badge bg-danger px-2 py-2 me-1">Trash</button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
                <div class="card-body">
                    {{ $comments->links('pagination::bootstrap-5') }}
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

    // const approveButton = document.getElementById('approveButton').addEventListener('click', function(e) {
    //     e.preventDefault();
    //     if (confirm('Are you sure you want to approve this item?')) {
    //         DynamicForm.create(this.getAttribute('href'), "POST")
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Select the approve button
        document.querySelectorAll("#approveButton").forEach(button => {

            button.addEventListener("click", function() {
                const commentId = this.getAttribute("data-id");

                // Make an AJAX request to update the is_active column
                fetch(`/approve-comment/${commentId}`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                        },
                        body: JSON.stringify({
                            is_active: 1
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Comment approved successfully!");
                        } else {
                            alert("Failed to approve the comment.");
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("An error occurred.");
                    });
            });
        });
    });
</script>

@endpush