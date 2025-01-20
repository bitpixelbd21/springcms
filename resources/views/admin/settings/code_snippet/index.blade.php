@extends('river::admin.layouts.master')
@section('settings') active @stop

@section('page-header')
<x:river::header>
    <x-slot:title>
    Code Snippets
        </x-slot>

        <x-slot:breads>
            <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Code Snippets</a></li>
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
            <!-- <h2 class="pb-4"> Code Snippets</h2> -->
            <form method="post" action="{{route('river.store-settings')}}">
                @csrf
                <div class="col-12">
                    <h3> Header Code</h3>
                    <div class="page-title-box d-flex align-items-center ">
                        <textarea class="form-control" id="floatingTextarea"
                            name="header_code"> {{ river_settings('header_code') }} </textarea>
                    </div>
                </div>

                <div class="col-12 mt-5">
                    <h3> Footer Code</h3>
                    <div class="page-title-box d-flex align-items-center ">
                        <textarea class="form-control" id="floatingTextarea"
                            name="footer_code">{{ river_settings('footer_code') }}</textarea>
                    </div>
                </div>

                <div class="col-12 mt-5">

                    <div class="page-title-box d-flex align-items-center ">
                        <input type="submit" class="btn btn-primary" />
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

@stop

@push('scripts')
<script>



</script>
@endpush