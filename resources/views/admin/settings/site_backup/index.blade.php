@extends('river::admin.layouts.master')
@section('settings') active @stop

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center ">
                        <h4 class="mb-0">Site Backup</h4>
                        <a class="btn btn-primary mx-3" href="{{ route('river.site-backup-store') }}">Download backup</a>
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
