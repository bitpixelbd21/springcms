@extends('river::admin.layouts.master')
@section('settings') active @stop

@section('page-header')
<x:river::header>
    <x-slot:title>
        Site Backup
        </x-slot>

        <x-slot:breads>
            <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Site Backup</a></li>
        </x-slot:breads>

        <x-slot:buttons>
            <!-- <a class="btn btn-primary d-none d-sm-inline-block" id="btn-add-new">
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
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center mb-3">
                    <!-- <h4 class="mb-0">Site Backup</h4> -->
                    <a class="btn btn-primary" href="{{ route('river.site-backup-store') }}">Download backup</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Restore backup</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('river.backup.restore') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="backup_file" class="form-label">Backup File</label>
                                <input class="form-control" type="file" id="backup_file" name="backup_file" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Upload Backup</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@push('scripts')
<script></script>
@endpush