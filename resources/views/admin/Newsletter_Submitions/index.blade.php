@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')
@stop

@section('content')

<div class="container-xl">
    <h2> Newsletter Emails:</h2>
    <div class="row row-cards">
        <div class="col-md-12">
            <div class="card">

                @if($value->count() == 0)
                @include('river::admin.partials.nodata', ['link' => null ])
                @else
                <table class="table">
                    <thead>
                        <tr>
                            <th> SL</th>
                            <th>Email</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($value as $key=>$file)
                        <tr>
                            <td>
                                <p class="list-group-item mt-3">{{++$key}}</p>
                            </td>
                            <td>
                                <p class="list-group-item mt-3">{{$file->email}}</p>
                            </td>
                            <td>
                                <p class="list-group-item mt-3">{{$file->date}}</p>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
                <div class="card-body">
                    {{ $value->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop